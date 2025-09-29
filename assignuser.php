 <?php
session_start();
// Check if user is logged in and is superadmin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superadmin') {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Hostel - DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/role.css">
    <link rel="stylesheet" href="include/dashboard.css">
</head>

<body>
    <!-- Sidebar include removed to keep this file PHP-free -->
    <?php include 'include/sidebar.php'; ?>

    <div id="content">
         

                <div class="header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1><i class="fas fa-user-shield me-2"></i>Hostel Warden Assignment</h1>
                    <p class="mb-0">Assign wardens to manage DELSU hostels and student accommodations</p>
                </div>
               <a href="userroles.php"> <button class="btn btn-light" >
                    <i class="fas fa-user-plus me-2"></i>Add New Warden
                </button></a>
            </div>
        </div>



        <div class="row">
            <!-- Left Column - Hostel Selection -->
            <div class="col-md-6">
                <!-- Current Assignment Details -->
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-info-circle me-2"></i>Current Assignment Details
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img src="https://ui-avatars.com/api/?name=Dr+Sarah+Johnson&background=0072BC&color=fff" class="warden-avatar mb-3" alt="Warden">
                            <h4>Dr. Sarah Johnson</h4>
                            <p class="text-muted">Current Warden - Queen's Hall</p>
                            <p><strong>Email Address:</strong> sarah.j@delsu.edu.ng</p>
                            <p><strong>Phone:</strong> +234 801 234 5678</p>
                            <p><strong>Assigned Since:</strong> January 15, 2023</p>
                        </div>
                        
                    </div>
                </div>
            </div>

            <!-- Right Column - Warden Assignment -->
            <div class="col-md-6">
                <div class="card mt-4">
                    <div class="card-header">
                        <i class="fas fa-user-tie me-2"></i>Assign Warden to Queen's Hall
                    </div>
                    <div class="card-body">
                        <div class="assignment-form">
                            <div class="form-section">
                                <h5 class="section-title">Select Warden</h5>
                                <div class="mb-3">
                                    <label class="form-label">Available Wardens</label>
                                    <select class="form-select" name="user_id" id="wardenSelect">
                                        <option value="">Select a warden...</option>
                                        
                                    </select>
                                </div>
                                
                                <!-- Warden Preview -->
                                <div id="wardenPreview" class="mt-4 p-3 border rounded" style="display: none;">
                                    <div class="d-flex align-items-center">
                                        <img src="" class="warden-avatar me-3" id="previewAvatar" alt="Warden">
                                        <div>
                                            <h6 id="previewName" class="mb-1"></h6>
                                            <p class="text-muted mb-1" id="previewEmail"></p>
                                            <p class="mb-0" id="previewPhone"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-section">
                                <h5 class="section-title">Assignment Details</h5>
                                <div class="mb-3">
                                    <select name="hostel_id"  class="form-select" id="">
                                        <option value="">Select Hostel ....</option>
                                    </select>
                                </div>
                                
                               
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>Save Assignment
                                </button>
                                <button class="btn btn-outline-primary">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assignment History -->
                
            </div>
        </div>
        <div class="card ">
                    <div class="card-header">
                        <i class="fas fa-history me-2"></i>Current Warden Assignments
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="">
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Hostel Assigned</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>sarah.j</td>
                                        <td>sarah.j@delsu.edu.ng</td>
                                        <td>Queen's Hall</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1 edit-btn" data-username="sarah.j" data-email="sarah.j@delsu.edu.ng" data-hostel="Queen's Hall"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-username="sarah.j" data-hostel="Queen's Hall"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>mike.a</td>
                                        <td>mike.a@delsu.edu.ng</td>
                                        <td>Warrior Towers</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1 edit-btn" data-username="mike.a" data-email="mike.a@delsu.edu.ng" data-hostel="Warrior Towers"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-username="mike.a" data-hostel="Warrior Towers"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>linda.k</td>
                                        <td>linda.k@delsu.edu.ng</td>
                                        <td>Peace Hall</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1 edit-btn" data-username="linda.k" data-email="linda.k@delsu.edu.ng" data-hostel="Peace Hall"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-username="linda.k" data-hostel="Peace Hall"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>john.d</td>
                                        <td>john.d@delsu.edu.ng</td>
                                        <td>Progress Hall</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary me-1 edit-btn" data-username="john.d" data-email="john.d@delsu.edu.ng" data-hostel="Progress Hall"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-sm btn-danger delete-btn" data-username="john.d" data-hostel="Progress Hall"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>



    </div>

    <!-- Add Warden Modal -->
    <div class="modal fade" id="addWardenModal" tabindex="-1" aria-labelledby="addWardenModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addWardenModalLabel">Add New Warden</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addWardenForm">
                        <div class="mb-3">
                            <label for="wardenUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="wardenUsername" required>
                        </div>
                        <div class="mb-3">
                            <label for="wardenEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="wardenEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="wardenPhone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="wardenPhone">
                        </div>
                        <div class="mb-3">
                            <label for="assignHostel" class="form-label">Assign to Hostel</label>
                            <select class="form-select" id="assignHostel" required>
                                <option value="">Select Hostel</option>
                                <option value="Queen's Hall">Queen's Hall</option>
                                <option value="Warrior Towers">Warrior Towers</option>
                                <option value="Peace Hall">Peace Hall</option>
                                <option value="Progress Hall">Progress Hall</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveWardenBtn">Add Warden</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Add User Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleModalLabel">Add New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="roleName" placeholder="Enter role name">
                        </div>
                        <div class="mb-3">
                            <label for="roleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="roleDescription" rows="3" placeholder="Describe this role"></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="perm1">
                                <label for="perm1" class="mb-0">View Dashboard</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="perm2">
                                <label for="perm2" class="mb-0">Manage Hostels</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="perm3">
                                <label for="perm3" class="mb-0">Manage Students</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="perm4">
                                <label for="perm4" class="mb-0">View Payments</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="perm5">
                                <label for="perm5" class="mb-0">Manage Payments</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="perm6">
                                <label for="perm6" class="mb-0">Generate Reports</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Create Role</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Assignment Modal -->
    <div class="modal fade" id="editAssignmentModal" tabindex="-1" aria-labelledby="editAssignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAssignmentModalLabel">Edit Warden Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editAssignmentForm">
                        <div class="mb-3">
                            <label for="editUsername" class="form-label">Username</label>
                            <input type="text" class="form-control" id="editUsername" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editHostel" class="form-label">Assigned Hostel</label>
                            <select class="form-select" id="editHostel">
                                <option value="Queen's Hall">Queen's Hall</option>
                                <option value="Warrior Towers">Warrior Towers</option>
                                <option value="Peace Hall">Peace Hall</option>
                                <option value="Progress Hall">Progress Hall</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Assignment Modal -->
    <div class="modal fade" id="deleteAssignmentModal" tabindex="-1" aria-labelledby="deleteAssignmentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAssignmentModalLabel">Delete Warden Assignment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the assignment for <strong id="deleteUsername"></strong> from <strong id="deleteHostel"></strong>?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete Assignment</button>
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
                        <div class="mb-3">
                            <label for="editRoleName" class="form-label">Role Name</label>
                            <input type="text" class="form-control" id="editRoleName" value="Hostel Manager">
                        </div>
                        <div class="mb-3">
                            <label for="editRoleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editRoleDescription" rows="3">Manage hostels, rooms, and allocations</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Permissions</label>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="editPerm1" checked>
                                <label for="editPerm1" class="mb-0">View Dashboard</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="editPerm2" checked>
                                <label for="editPerm2" class="mb-0">Manage Hostels</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="editPerm3" checked>
                                <label for="editPerm3" class="mb-0">Manage Students</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="editPerm4">
                                <label for="editPerm4" class="mb-0">View Payments</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="editPerm5">
                                <label for="editPerm5" class="mb-0">Manage Payments</label>
                            </div>
                            <div class="permission-item">
                                <input type="checkbox" class="permission-checkbox" id="editPerm6">
                                <label for="editPerm6" class="mb-0">Generate Reports</label>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="include/dash.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Edit Assignment Modal Functionality
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const username = this.getAttribute('data-username');
                    const email = this.getAttribute('data-email');
                    const hostel = this.getAttribute('data-hostel');

                    document.getElementById('editUsername').value = username;
                    document.getElementById('editEmail').value = email;
                    document.getElementById('editHostel').value = hostel;

                    const editModal = new bootstrap.Modal(document.getElementById('editAssignmentModal'));
                    editModal.show();
                });
            });

            // Save Edit Changes
            document.getElementById('saveEditBtn').addEventListener('click', function() {
                const username = document.getElementById('editUsername').value;
                const newHostel = document.getElementById('editHostel').value;

                // Find the row and update the hostel cell
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const rowUsername = row.querySelector('td:first-child').textContent.trim();
                    if (rowUsername === username) {
                        row.querySelector('td:nth-child(3)').textContent = newHostel;
                        // Update data attributes if needed
                        const editBtn = row.querySelector('.edit-btn');
                        const deleteBtn = row.querySelector('.delete-btn');
                        if (editBtn) editBtn.setAttribute('data-hostel', newHostel);
                        if (deleteBtn) deleteBtn.setAttribute('data-hostel', newHostel);
                    }
                });

                alert('Assignment updated successfully!');
                const editModal = bootstrap.Modal.getInstance(document.getElementById('editAssignmentModal'));
                editModal.hide();
            });

            // Delete Assignment Modal Functionality
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const username = this.getAttribute('data-username');
                    const hostel = this.getAttribute('data-hostel');

                    document.getElementById('deleteUsername').textContent = username;
                    document.getElementById('deleteHostel').textContent = hostel;

                    const deleteModal = new bootstrap.Modal(document.getElementById('deleteAssignmentModal'));
                    deleteModal.show();
                });
            });

            // Confirm Delete - Fixed selector for vanilla JS
            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                const username = document.getElementById('deleteUsername').textContent.trim();
                const rows = document.querySelectorAll('tbody tr');
                let rowToRemove = null;
                rows.forEach(row => {
                    const rowUsername = row.querySelector('td:first-child').textContent.trim();
                    if (rowUsername === username) {
                        rowToRemove = row;
                    }
                });
                if (rowToRemove) {
                    rowToRemove.remove();
                }

                alert('Assignment deleted successfully!');
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteAssignmentModal'));
                deleteModal.hide();
            });
        });
    </script>

    
</body>

</html>