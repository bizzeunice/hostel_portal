<?php
session_start();
require_once 'include/db_connect.php';

// Check if user is logged in and is superadmin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superadmin') {
    header("Location: index.php");
    exit();
}

// Initialize variables
$success_message = '';
$error_message = '';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create_role'])) {
        // Create new role
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $permissions = $_POST['permissions'] ?? [];
        
        try {
            // Check if role already exists
            $stmt = $conn->prepare("SELECT id FROM roles WHERE name = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->fetch_assoc()) {
                throw new Exception("Role name already exists");
            }
            
            // Insert new role
            $stmt = $conn->prepare("INSERT INTO roles (name, description) VALUES (?, ?)");
            $stmt->bind_param("ss", $name, $description);
            $stmt->execute();
            $role_id = $conn->insert_id;
            
            // Assign permissions
            if (!empty($permissions)) {
                $stmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission_key) VALUES (?, ?)");
                foreach ($permissions as $permission_key) {
                    $stmt->bind_param("is", $role_id, $permission_key);
                    $stmt->execute();
                }
            }
            
            $success_message = "Role created successfully!";
            
        } catch (Exception $e) {
            $error_message = "Error creating role: " . $e->getMessage();
        }
    }
    elseif (isset($_POST['update_role'])) {
        // Update existing role
        $role_id = $_POST['role_id'];
        $name = trim($_POST['name']);
        $description = trim($_POST['description']);
        $permissions = $_POST['permissions'] ?? [];
        
        try {
            // Check if role name conflicts (excluding current role)
            $stmt = $conn->prepare("SELECT id FROM roles WHERE name = ? AND id != ?");
            $stmt->bind_param("si", $name, $role_id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->fetch_assoc()) {
                throw new Exception("Role name already exists");
            }
            
            // Update role
            $stmt = $conn->prepare("UPDATE roles SET name = ?, description = ? WHERE id = ?");
            $stmt->bind_param("ssi", $name, $description, $role_id);
            $stmt->execute();
            
            // Update permissions
            $stmt = $conn->prepare("DELETE FROM role_permissions WHERE role_id = ?");
            $stmt->bind_param("i", $role_id);
            $stmt->execute();
            
            if (!empty($permissions)) {
                $stmt = $conn->prepare("INSERT INTO role_permissions (role_id, permission_key) VALUES (?, ?)");
                foreach ($permissions as $permission_key) {
                    $stmt->bind_param("is", $role_id, $permission_key);
                    $stmt->execute();
                }
            }
            
            $success_message = "Role updated successfully!";
            
        } catch (Exception $e) {
            $error_message = "Error updating role: " . $e->getMessage();
        }
    }
    elseif (isset($_POST['delete_role'])) {
        // Delete role
        $role_id = $_POST['role_id'];
        
        try {
            // Check if role has users
            $stmt = $conn->prepare("SELECT COUNT(*) as count FROM users WHERE role_id = ?");
            $stmt->bind_param("i", $role_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user_count = $result->fetch_assoc()['count'];
            
            if ($user_count > 0) {
                throw new Exception("Cannot delete role that has users assigned");
            }
            
            // Delete role permissions first
            $stmt = $conn->prepare("DELETE FROM role_permissions WHERE role_id = ?");
            $stmt->bind_param("i", $role_id);
            $stmt->execute();
            
            // Delete role
            $stmt = $conn->prepare("DELETE FROM roles WHERE id = ?");
            $stmt->bind_param("i", $role_id);
            $stmt->execute();
            
            $success_message = "Role deleted successfully!";
            
        } catch (Exception $e) {
            $error_message = "Error deleting role: " . $e->getMessage();
        }
    }
}

// Get all roles with user counts
$result = $conn->query("
    SELECT r.*, COUNT(u.id) as user_count 
    FROM roles r 
    LEFT JOIN users u ON r.id = u.role_id 
    GROUP BY r.id 
    ORDER BY r.name
");
$roles = $result->fetch_all(MYSQLI_ASSOC);

// Get permissions for each role
foreach ($roles as &$role) {
    $stmt = $conn->prepare("SELECT permission_key FROM role_permissions WHERE role_id = ?");
    $stmt->bind_param("i", $role['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    $role['permissions'] = $result->fetch_all(MYSQLI_ASSOC);
    $role['permissions'] = array_column($role['permissions'], 'permission_key');
    $role['permission_count'] = count($role['permissions']);
}

// Define available permissions based on sidebar menu
$available_permissions = [
    'view_dashboard' => 'Dashboard',
    'add_sessions' => 'Add Sessions',
    'add_campus' => 'Add Campus',
    'add_hostel' => 'Add New Hostel',
    'add_rooms' => 'Add Rooms',
    'manage_rooms_beds' => 'Room/Bed Management',
    'create_eligibility' => 'Create Eligibility Rule',
    'manage_eligibility' => 'Manage Eligibility Rules',
    'view_reservations' => 'View Reservations',
    'dellocation_history' => 'Dellocation/History',
    'view_payments' => 'View Payments',
    'manage_admins' => 'Manage Admins',
    'general_settings' => 'General Settings',
    'roles_permissions' => 'Roles & Permissions'
];

// Get total stats
$result = $conn->query("SELECT COUNT(*) as count FROM roles");
$total_roles = $result->fetch_array(MYSQLI_NUM)[0];
$total_permission_types = count($available_permissions);
$result = $conn->query("SELECT COUNT(*) as count FROM roles WHERE name LIKE '%admin%'");
$total_admin_groups = $result->fetch_array(MYSQLI_NUM)[0];
$result = $conn->query("SELECT COUNT(*) as count FROM role_permissions");
$total_permissions = $result->fetch_array(MYSQLI_NUM)[0];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles Management - DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/role.css">
    <link rel="stylesheet" href="include/dashboard.css">
</head>

<body>
    <?php include 'include/sidebar.php'; ?>

    <div id="content">
        <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-shield-alt me-2"></i>Roles Management</h1>
                    <p class="mb-0">Manage user roles and permissions for the DELSU Hostel Portal</p>
                </div>
                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                    <i class="fas fa-plus-circle me-2"></i>Add New Role
                </button>
            </div>
        </div>

        <!-- Alert Messages -->
        <?php if ($success_message): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?php echo $error_message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-number"><?php echo $total_roles; ?></div>
                    <div class="stats-label">Total Roles</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-number"><?php echo $total_roles; ?></div>
                    <div class="stats-label">Active Roles</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-number"><?php echo $total_permission_types; ?></div>
                    <div class="stats-label">Permission Types</div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card stats-card">
                    <div class="stats-number"><?php echo $total_permissions; ?></div>
                    <div class="stats-label">Total Permissions</div>
                </div>
            </div>
        </div>

        <!-- Roles Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list me-2"></i>System Roles</span>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="searchRoles" placeholder="Search roles..." style="width: 200px;">
                    <button class="btn btn-light"><i class="fas fa-filter me-2"></i>Filter</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>Users</th>
                                <th>Permissions</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($roles as $role): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?php echo htmlspecialchars($role['name']); ?></div>
                                    <span class="role-badge badge-<?php echo getRoleBadgeClass($role['name']); ?>">
                                        <?php echo htmlspecialchars($role['name']); ?>
                                    </span>
                                </td>
                                <td><?php echo htmlspecialchars($role['description']); ?></td>
                                <td><?php echo $role['user_count']; ?></td>
                                <td>
                                    <?php if ($role['permission_count'] > 0): ?>
                                        <?php echo $role['permission_count']; ?> Permissions
                                    <?php else: ?>
                                        No Permissions
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary edit-role-btn" 
                                            data-role-id="<?php echo $role['id']; ?>"
                                            data-role-name="<?php echo htmlspecialchars($role['name']); ?>"
                                            data-role-description="<?php echo htmlspecialchars($role['description']); ?>"
                                            data-bs-toggle="modal" data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <?php if ($role['name'] !== 'super_admin' && $role['user_count'] == 0): ?>
                                        <button class="btn btn-sm btn-outline-danger delete-role-btn" 
                                                data-role-id="<?php echo $role['id']; ?>"
                                                data-role-name="<?php echo htmlspecialchars($role['name']); ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-outline-danger" disabled 
                                                title="<?php echo $role['name'] === 'super_admin' ? 'System roles cannot be deleted' : 'Role has users assigned'; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" name="name" placeholder="Enter role name" required>
                        </div>
                        <div class="mb-3">
                            <label for="roleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="roleDescription" name="description" rows="3" placeholder="Describe this role" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <?php foreach ($available_permissions as $perm_key => $perm_name): ?>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" name="permissions[]" value="<?php echo $perm_key; ?>" id="perm_<?php echo $perm_key; ?>">
                                <label for="perm_<?php echo $perm_key; ?>" class="mb-0"><?php echo $perm_name; ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="create_role" class="btn btn-primary">Create Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="">
                    <input type="hidden" id="editRoleId" name="role_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoleModalLabel">Edit Role: <span id="editRoleTitle"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editRoleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="editRoleName" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="editRoleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editRoleDescription" name="description" rows="3" required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <?php foreach ($available_permissions as $perm_key => $perm_name): ?>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox edit-permission" name="permissions[]" 
                                       value="<?php echo $perm_key; ?>" id="edit_perm_<?php echo $perm_key; ?>">
                                <label for="edit_perm_<?php echo $perm_key; ?>" class="mb-0"><?php echo $perm_name; ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_role" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <input type="hidden" id="deleteRoleId" name="role_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteRoleModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the role "<strong id="deleteRoleName"></strong>"?</p>
                        <p class="text-danger">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_role" class="btn btn-danger">Delete Role</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="include/dash.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit role button handler
            $('.edit-role-btn').on('click', function() {
                const roleId = $(this).data('role-id');
                const roleName = $(this).data('role-name');
                const roleDescription = $(this).data('role-description');
                
                $('#editRoleId').val(roleId);
                $('#editRoleName').val(roleName);
                $('#editRoleDescription').val(roleDescription);
                $('#editRoleTitle').text(roleName);
                
                // Load role permissions via AJAX
                $.get('get_role_permissions.php?role_id=' + roleId, function(data) {
                    $('.edit-permission').prop('checked', false);
                    if (data.permissions) {
                        data.permissions.forEach(function(permKey) {
                            $('#edit_perm_' + permKey).prop('checked', true);
                        });
                    }
                });
            });
            
            // Delete role button handler
            $('.delete-role-btn').on('click', function() {
                const roleId = $(this).data('role-id');
                const roleName = $(this).data('role-name');
                
                $('#deleteRoleId').val(roleId);
                $('#deleteRoleName').text(roleName);
                $('#deleteRoleModal').modal('show');
            });
            
            // Search functionality
            $('#searchRoles').on('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('table tbody tr');
                
                rows.forEach(row => {
                    const roleName = row.querySelector('.fw-bold').textContent.toLowerCase();
                    const roleDescription = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    
                    if (roleName.includes(searchTerm) || roleDescription.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>
</html>

<?php
// Helper function to get badge class for roles
function getRoleBadgeClass($roleName) {
    $roleName = strtolower($roleName);
    if (strpos($roleName, 'super') !== false) {
        return 'superadmin';
    } elseif (strpos($roleName, 'admin') !== false) {
        return 'admin';
    } elseif (strpos($roleName, 'staff') !== false) {
        return 'staff';
    } elseif (strpos($roleName, 'student') !== false) {
        return 'student';
    } else {
        return 'admin';
    }
}
?>