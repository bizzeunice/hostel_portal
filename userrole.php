<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Hostel - DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/campman.css">
    <link rel="stylesheet" href="include/dashboard.css">
    <link rel="stylesheet" href="include/userrole.css">
</head>

<body>
    <!-- Sidebar include removed to keep this file PHP-free -->
    <?php include 'include/sidebar.php'; ?>

    <div id="content">
        <div class="top-bar bg-white d-flex justify-content-between p-3 shadow rounded mb-3">
            <div class="d-flex align-items-center ">
                <button id="sidebarToggle" class="d-md-none me-3 hamburger-btn" aria-label="Toggle navigation"
                    aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <div class="date-display">
                    <i class="fas fa-calendar-alt me-2"></i> Monday, 11 September 2023
                </div>
            </div>
            <div class="user-info d-flex align-items-center ">
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=random" width="40"
                    class="rounded-circle me-3" alt="User">
                <div>
                    <div>Superadmin</div>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>

        <div class="campus-banner">
            <div class="campus-text">
                <h2>User Role Permission</h2>
                <p class="mb-0">Manage user roles and permissions</p>
            </div>
            <span>
                <a href="dashboard.php" class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to
                    Dashboard</a>
            </span>
        </div>

        <!-- Alerts removed (no server-side processing in this PHP-free file) -->

        <!-- Stats Overview -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title">5</h3>
                        <p class="card-text">Total Roles</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title">12</h3>
                        <p class="card-text">Permission Types</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title">4</h3>
                        <p class="card-text">Admin Groups</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card">
                    <div class="card-body text-center">
                        <h3 class="card-title">28</h3>
                        <p class="card-text">Total Permissions</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Roles Table -->
        <div class="dashboard-card">
            <div class="card-header">
                <i class="fas fa-shield-alt me-2"></i>System Roles & Permissions
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table roles-table">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Description</th>
                                <th>Permissions</th>
                                <th>Users</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Super Admin</td>
                                <td>Full system access with all permissions</td>
                                <td>
                                    <span class="permission-badge permission-view">View All</span>
                                    <span class="permission-badge permission-create">Create All</span>
                                    <span class="permission-badge permission-edit">Edit All</span>
                                    <span class="permission-badge permission-delete">Delete All</span>
                                    <span class="permission-badge">+8 more</span>
                                </td>
                                <td>1</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-delsu me-1" data-bs-toggle="modal"
                                        data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" disabled>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Hostel Manager</td>
                                <td>Manage hostels, rooms, and allocations</td>
                                <td>
                                    <span class="permission-badge permission-view">View Hostels</span>
                                    <span class="permission-badge permission-create">Create Hostels</span>
                                    <span class="permission-badge permission-edit">Edit Hostels</span>
                                    <span class="permission-badge">+5 more</span>
                                </td>
                                <td>3</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-delsu me-1" data-bs-toggle="modal"
                                        data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Finance Admin</td>
                                <td>Manage payments and financial reports</td>
                                <td>
                                    <span class="permission-badge permission-view">View Payments</span>
                                    <span class="permission-badge permission-edit">Edit Payments</span>
                                    <span class="permission-badge">+3 more</span>
                                </td>
                                <td>2</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-delsu me-1" data-bs-toggle="modal"
                                        data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Support Admin</td>
                                <td>Manage student inquiries and support tickets</td>
                                <td>
                                    <span class="permission-badge permission-view">View Tickets</span>
                                    <span class="permission-badge permission-edit">Edit Tickets</span>
                                    <span class="permission-badge">+2 more</span>
                                </td>
                                <td>4</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-delsu me-1" data-bs-toggle="modal"
                                        data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>Reporting Admin</td>
                                <td>Generate and view system reports</td>
                                <td>
                                    <span class="permission-badge permission-view">View Reports</span>
                                    <span class="permission-badge permission-create">Generate Reports</span>
                                </td>
                                <td>2</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-delsu me-1" data-bs-toggle="modal"
                                        data-bs-target="#editRoleModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Create New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="roleName" class="form-label">Username</label>
                                <input type="text" class="form-control" id="roleName"
                                    placeholder="e.g., Allocation Manager" required>
                            </div>
                            <div class="col-md-6">
                                <label for="roleName" class="form-label">Password</label>
                                <input type="password" class="form-control" id="roleName"
                                    placeholder="Password" required>
                            </div>
                            <div class="col-md-6">
                                <label for="roleUsers" class="form-label">Users with this Role</label>
                                <input type="number" class="form-control" id="roleUsers" value="0" min="0" required>
                            </div>
                        </div>

                        <!-- <div class="mb-3">
                            <label for="roleDescription" class="form-label">Role Description</label>
                            <textarea class="form-control" id="roleDescription" rows="2"
                                placeholder="Describe this role's responsibilities..." required></textarea>
                        </div> -->

                        <div class="mb-3">
                            <label class="form-label">Role Permissions</label>

                            <!-- Hostel Management Permissions -->
                            <div class="permission-group">
                                <div class="module-header">
                                    <i class="fas fa-bed me-2"></i>Hostel Management
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="manageHostels">
                                        <label class="form-check-label" for="manageHostels">
                                            Manage Hostels (Create, Edit, Delete)
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="viewHostels">
                                        <label class="form-check-label" for="viewHostels">
                                            View Hostels
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="manageRooms">
                                        <label class="form-check-label" for="manageRooms">
                                            Manage Rooms & Bedspaces
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Management Permissions -->
                            <div class="permission-group">
                                <div class="module-header">
                                    <i class="fas fa-users me-2"></i>Student Management
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="viewStudents">
                                        <label class="form-check-label" for="viewStudents">
                                            View Students
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="manageStudents">
                                        <label class="form-check-label" for="manageStudents">
                                            Manage Students (Edit, Delete)
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="manualAllocation">
                                        <label class="form-check-label" for="manualAllocation">
                                            Manual Allocation
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Management Permissions -->
                            <div class="permission-group">
                                <div class="module-header">
                                    <i class="fas fa-money-bill-wave me-2"></i>Payment Management
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="viewPayments">
                                        <label class="form-check-label" for="viewPayments">
                                            View Payments
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="managePayments">
                                        <label class="form-check-label" for="managePayments">
                                            Manage Payments (Edit, Refund)
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- System Management Permissions -->
                            <div class="permission-group">
                                <div class="module-header">
                                    <i class="fas fa-cogs me-2"></i>System Management
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="viewReports">
                                        <label class="form-check-label" for="viewReports">
                                            View Reports
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="generateReports">
                                        <label class="form-check-label" for="generateReports">
                                            Generate Reports
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="systemSettings">
                                        <label class="form-check-label" for="systemSettings">
                                            System Settings
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-delsu">Create Role</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRoleModalLabel">Edit Role: Hostel Manager</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editRoleName" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="editRoleName" value="Hostel Manager"
                                    required>
                            </div>
                            <div class="col-md-6">
                                <label for="editRoleUsers" class="form-label">Users with this Role</label>
                                <input type="number" class="form-control" id="editRoleUsers" value="3" min="0" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="editRoleDescription" class="form-label">Role Description</label>
                            <textarea class="form-control" id="editRoleDescription" rows="2"
                                required>Manage hostels, rooms, and allocations</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role Permissions</label>

                            <!-- Hostel Management Permissions -->
                            <div class="permission-group">
                                <div class="module-header">
                                    <i class="fas fa-bed me-2"></i>Hostel Management
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editManageHostels" checked>
                                        <label class="form-check-label" for="editManageHostels">
                                            Manage Hostels (Create, Edit, Delete)
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editViewHostels" checked>
                                        <label class="form-check-label" for="editViewHostels">
                                            View Hostels
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editManageRooms" checked>
                                        <label class="form-check-label" for="editManageRooms">
                                            Manage Rooms & Bedspaces
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Student Management Permissions -->
                            <div class="permission-group">
                                <div class="module-header">
                                    <i class="fas fa-users me-2"></i>Student Management
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editViewStudents" checked>
                                        <label class="form-check-label" for="editViewStudents">
                                            View Students
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editManageStudents">
                                        <label class="form-check-label" for="editManageStudents">
                                            Manage Students (Edit, Delete)
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editManualAllocation"
                                            checked>
                                        <label class="form-check-label" for="editManualAllocation">
                                            Manual Allocation
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Management Permissions -->
                            <div class="permission-group">
                                <div class="module-header">
                                    <i class="fas fa-money-bill-wave me-2"></i>Payment Management
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editViewPayments">
                                        <label class="form-check-label" for="editViewPayments">
                                            View Payments
                                        </label>
                                    </div>
                                </div>
                                <div class="permission-item">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="editManagePayments">
                                        <label class="form-check-label" for="editManagePayments">
                                            Manage Payments (Edit, Refund)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-delsu">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="include/dash.js"></script>
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Functionality for the roles management page
            const deleteButtons = document.querySelectorAll('.btn-outline-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    if (!this.disabled) {
                        const roleName = this.closest('tr').querySelector('td').textContent;
                        if (confirm(`Are you sure you want to delete the "${roleName}" role?`)) {
                            // In a real application, this would send a request to delete the role
                            alert(`"${roleName}" role has been deleted.`);
                        }
                    }
                });
            });
            
            // Form validation for modals
            const createRoleForm = document.querySelector('#addRoleModal form');
            const createRoleBtn = document.querySelector('#addRoleModal .btn-delsu');
            
            createRoleBtn.addEventListener('click', function() {
                let isValid = true;
                
                // Simple validation
                const inputs = createRoleForm.querySelectorAll('input[required], textarea[required]');
                inputs.forEach(input => {
                    if (!input.value) {
                        isValid = false;
                        input.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                    }
                });
                
                if (isValid) {
                    // In a real application, this would submit the form
                    alert('New role created successfully!');
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addRoleModal'));
                    modal.hide();
                }
            });
        });
    </script>
</body>

</html>