<?php
session_start();
include 'include/db_connect.php';

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
    if (isset($_POST['create_user'])) {
        // Create new user
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $role_id = $_POST['role_id'];
        $status = $_POST['status'];
        $password_hash = password_hash($_POST['password_hash'], PASSWORD_DEFAULT);
        
        try {
            // Check if username already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                throw new Exception("Username already exists");
            }

            // Check if email already exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                throw new Exception("Email already exists");
            }

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (username, password_hash, email, phone, role_id, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssis", $username, $password_hash, $email, $phone, $role_id, $status);
            if (!$stmt->execute()) {
                throw new Exception("Failed to create user: " . $stmt->error);
            }
            
            $success_message = "User created successfully!";
            
        } catch (Exception $e) {
            $error_message = "Error creating user: " . $e->getMessage();
        }
    }
    elseif (isset($_POST['update_user'])) {
        // Update existing user
        $user_id = $_POST['user_id'];
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $role_id = $_POST['role_id'];
        $status = $_POST['status'];
        
        try {
            // Check if username conflicts (excluding current user)
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
            $stmt->bind_param("si", $username, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                throw new Exception("Username already exists");
            }

            // Check if email conflicts (excluding current user)
            $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
            $stmt->bind_param("si", $email, $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                throw new Exception("Email already exists");
            }

            // Update user
            $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, phone = ?, role_id = ?, status = ? WHERE id = ?");
            $stmt->bind_param("sssisi", $username, $email, $phone, $role_id, $status, $user_id);
            if (!$stmt->execute()) {
                throw new Exception("Failed to update user: " . $stmt->error);
            }

            // Handle password reset if requested
            if (isset($_POST['reset_password']) && $_POST['reset_password'] === '1') {
                $new_password_hash = password_hash('password123', PASSWORD_DEFAULT); // Default password
                $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
                $stmt->bind_param("si", $new_password_hash, $user_id);
                if (!$stmt->execute()) {
                    throw new Exception("Failed to reset password: " . $stmt->error);
                }
            }

            $success_message = "User updated successfully!";

        } catch (Exception $e) {
            $error_message = "Error updating user: " . $e->getMessage();
        }
    }
    elseif (isset($_POST['delete_user'])) {
        // Delete user
        $user_id = $_POST['user_id'];

        try {
            // Prevent deleting own account
            if ($user_id == $_SESSION['user_id']) {
                throw new Exception("You cannot delete your own account");
            }

            // Delete user
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            if (!$stmt->execute()) {
                throw new Exception("Failed to delete user: " . $stmt->error);
            }

            $success_message = "User deleted successfully!";

        } catch (Exception $e) {
            $error_message = "Error deleting user: " . $e->getMessage();
        }
    }
}

// Get all users with role information
$sql = "
    SELECT u.*, r.name as role_name, r.description as role_description
    FROM users u
    LEFT JOIN roles r ON u.role_id = r.id
    ORDER BY u.created_at DESC
";
$result = $conn->query($sql);
$users = [];
if ($result) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
}

// Get all roles for dropdown
$roles_result = $conn->query("SELECT id, name, description FROM roles ORDER BY name");
$roles = [];
if ($roles_result) {
    $roles = $roles_result->fetch_all(MYSQLI_ASSOC);
}

// Get user statistics
$total_users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$total_students = $conn->query("SELECT COUNT(*) as total FROM users u JOIN roles r ON u.role_id = r.id WHERE r.name LIKE '%student%'")->fetch_assoc()['total'];
$total_staff = $conn->query("SELECT COUNT(*) as total FROM users u JOIN roles r ON u.role_id = r.id WHERE r.name LIKE '%admin%' OR r.name LIKE '%staff%'")->fetch_assoc()['total'];
$total_pending = $conn->query("SELECT COUNT(*) as total FROM users WHERE status = 'pending'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/campman.css">
    <link rel="stylesheet" href="include/dashboard.css">
    <link rel="stylesheet" href="include/userrole.css">
</head>

<body>
    <?php include 'include/sidebar.php'; ?>

    <div id="content">
        <!-- Top Bar -->
        <div class="top-bar bg-white d-flex justify-content-between p-3 shadow rounded mb-3">
            <div class="d-flex align-items-center">
                <button id="sidebarToggle" class="d-md-none me-3 hamburger-btn" aria-label="Toggle navigation" aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <div class="date-display">
                    <i class="fas fa-calendar-alt me-2"></i> <?php echo date('l, j F Y'); ?>
                </div>
            </div>
            <div class="user-info d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($_SESSION['username'] ?? 'Admin'); ?>&background=random" width="40" class="rounded-circle me-3" alt="User">
                <div>
                    <div><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></div>
                    <small class="text-muted"><?php echo htmlspecialchars($_SESSION['role'] ?? 'User'); ?></small>
                </div>
            </div>
        </div>

        <div class="campus-banner">
            <div class="campus-text">
                <h2>User Management</h2>
                <p class="mb-0">Manage system users and their permissions</p>
            </div>
            <span>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <button class="btn btn-delsu" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-user-plus me-2"></i>Add New User
                    </button>
                </div>
            </span>
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

        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title"><?php echo $total_users; ?></h3>
                        <p class="card-text">Total Users</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title"><?php echo $total_students; ?></h3>
                        <p class="card-text">Students</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title"><?php echo $total_staff; ?></h3>
                        <p class="card-text">Staff/Admins</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title"><?php echo $total_pending; ?></h3>
                        <p class="card-text">Pending Activation</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Search -->
        <div class="dashboard-card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="form-control" id="searchUsers" placeholder="Search users by name, email, or ID...">
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <div class="dropdown filter-dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-2"></i>Role
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-role="all">All Roles</a></li>
                                <li><a class="dropdown-item" href="#" data-role="student">Students</a></li>
                                <li><a class="dropdown-item" href="#" data-role="staff">Staff</a></li>
                                <li><a class="dropdown-item" href="#" data-role="admin">Admins</a></li>
                            </ul>
                        </div>
                        <div class="dropdown filter-dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-filter me-2"></i>Status
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" data-status="all">All Status</a></li>
                                <li><a class="dropdown-item" href="#" data-status="active">Active</a></li>
                                <li><a class="dropdown-item" href="#" data-status="inactive">Inactive</a></li>
                                <li><a class="dropdown-item" href="#" data-status="pending">Pending</a></li>
                            </ul>
                        </div>
                        <button class="btn btn-outline-secondary" onclick="location.reload()">
                            <i class="fas fa-sync-alt me-2"></i>Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Table -->
        <div class="dashboard-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-users me-2"></i>System Users</span>
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="showInactiveUsers">
                    <label class="form-check-label text-white" for="showInactiveUsers">Show Inactive</label>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table users-table">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Last Login</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr class="user-row" data-role="<?php echo strtolower($user['role_name']); ?>" data-status="<?php echo $user['status']; ?>">
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($user['username']); ?>&background=0072BC&color=fff" class="user-avatar me-3" alt="<?php echo htmlspecialchars($user['username']); ?>">
                                        <div>
                                            <div class="fw-bold"><?php echo htmlspecialchars($user['username']); ?></div>
                                            <small class="text-muted">ID: <?php echo $user['id']; ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td><?php echo htmlspecialchars($user['phone'] ?? 'N/A'); ?></td>
                                <td>
                                    <span class="role-badge role-<?php echo getRoleBadgeClass($user['role_name']); ?>">
                                        <?php echo htmlspecialchars($user['role_name']); ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="status-badge status-<?php echo $user['status']; ?>">
                                        <?php echo ucfirst($user['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($user['last_login_at']): ?>
                                        <?php echo date('M j, Y g:i A', strtotime($user['last_login_at'])); ?>
                                    <?php else: ?>
                                        Never
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-delsu me-1 edit-user-btn" 
                                            data-user-id="<?php echo $user['id']; ?>"
                                            data-username="<?php echo htmlspecialchars($user['username']); ?>"
                                            data-email="<?php echo htmlspecialchars($user['email']); ?>"
                                            data-phone="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>"
                                            data-role-id="<?php echo $user['role_id']; ?>"
                                            data-status="<?php echo $user['status']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#editUserModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    
                                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                        <button class="btn btn-sm btn-outline-danger delete-user-btn" 
                                                data-user-id="<?php echo $user['id']; ?>"
                                                data-username="<?php echo htmlspecialchars($user['username']); ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    <?php else: ?>
                                        <button class="btn btn-sm btn-outline-danger" disabled title="You cannot delete your own account">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="User pagination">
                    <ul class="pagination justify-content-center mt-4">
                        <li class="page-item disabled">
                            <a class="page-link" href="#">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g 08012345678" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="userRole" class="form-label">User Role</label>
                                <select class="form-select" id="userRole" name="role_id" required>
                                    <option value="">Select Role</option>
                                    <?php foreach ($roles as $role): ?>
                                    <option value="<?php echo $role['id']; ?>"><?php echo htmlspecialchars($role['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="userStatus" class="form-label">Status</label>
                                <select class="form-select" id="userStatus" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password_hash" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password_hash" name="password_hash" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="create_user" class="btn btn-delsu">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="">
                    <input type="hidden" id="editUserId" name="user_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User: <span id="editUserTitle"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="editUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="editUsername" name="username" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="editEmail" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="editPhone" name="phone" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editUserRole" class="form-label">User Role</label>
                                <select class="form-select" id="editUserRole" name="role_id" required>
                                    <?php foreach ($roles as $role): ?>
                                    <option value="<?php echo $role['id']; ?>"><?php echo htmlspecialchars($role['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editUserStatus" class="form-label">Status</label>
                                <select class="form-select" id="editUserStatus" name="status" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                    <option value="pending">Pending</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Reset Password</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="resetPassword" name="reset_password" value="1">
                                <label class="form-check-label" for="resetPassword">
                                    Reset user password to default (password123)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update_user" class="btn btn-delsu">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="">
                    <input type="hidden" id="deleteUserId" name="user_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteUserModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the user "<strong id="deleteUserName"></strong>"?</p>
                        <p class="text-danger">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="delete_user" class="btn btn-danger">Delete User</button>
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
            // Edit user button handler
            $('.edit-user-btn').on('click', function() {
                const userId = $(this).data('user-id');
                const username = $(this).data('username');
                const email = $(this).data('email');
                const phone = $(this).data('phone');
                const roleId = $(this).data('role-id');
                const status = $(this).data('status');
                
                $('#editUserId').val(userId);
                $('#editUsername').val(username);
                $('#editEmail').val(email);
                $('#editPhone').val(phone);
                $('#editUserRole').val(roleId);
                $('#editUserStatus').val(status);
                $('#editUserTitle').text(username);
                $('#resetPassword').prop('checked', false);
            });
            
            // Delete user button handler
            $('.delete-user-btn').on('click', function() {
                const userId = $(this).data('user-id');
                const username = $(this).data('username');
                
                $('#deleteUserId').val(userId);
                $('#deleteUserName').text(username);
                $('#deleteUserModal').modal('show');
            });
            
            // Search functionality
            $('#searchUsers').on('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('.users-table tbody tr');
                
                rows.forEach(row => {
                    const username = row.querySelector('.fw-bold').textContent.toLowerCase();
                    const email = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
                    const userId = row.querySelector('small').textContent.toLowerCase();
                    
                    if (username.includes(searchTerm) || email.includes(searchTerm) || userId.includes(searchTerm)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Role filter
            $('.dropdown-menu a[data-role]').on('click', function(e) {
                e.preventDefault();
                const role = $(this).data('role');
                const rows = document.querySelectorAll('.user-row');
                
                rows.forEach(row => {
                    if (role === 'all' || row.dataset.role.includes(role)) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Status filter
            $('.dropdown-menu a[data-status]').on('click', function(e) {
                e.preventDefault();
                const status = $(this).data('status');
                const rows = document.querySelectorAll('.user-row');
                
                rows.forEach(row => {
                    if (status === 'all' || row.dataset.status === status) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
            
            // Toggle inactive users
            const showInactiveToggle = document.getElementById('showInactiveUsers');
            showInactiveToggle.addEventListener('change', function() {
                const inactiveRows = document.querySelectorAll('.status-inactive, .status-pending');
                
                inactiveRows.forEach(row => {
                    if (this.checked) {
                        row.closest('tr').style.display = '';
                    } else {
                        row.closest('tr').style.display = 'none';
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