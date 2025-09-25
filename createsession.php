<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Session Management - DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/campman.css">
    <link rel="stylesheet" href="include/dashboard.css">
</head>

<body>
    <!-- Sidebar -->
    <?php
    include 'include/sidebar.php';
    ?>

    <div id="content">
        <!-- Top Bar -->
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
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=random" width="40" class="rounded-circle me-3" alt="User">
                <div>
                    <div>Superadmin</div>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="campus-banner">
            <div class="campus-text">
                <h2>Create Session</h2>
                <p class="mb-0">Manage sessions and their details?</p>
            </div>
            <button class="btn btn-light" onclick="window.location.href='dashboard.php'"><i
                    class="fas fa-arrow-left"></i> &nbsp; Go back to Dashboard</button>

        </div>

        <!-- Statistics Row -->


        <!-- Message Display -->


        <!-- Add Campus Section -->
        <div class="form-section bg-white">
            <h3><i class="fas fa-plus-circle me-2"></i>Add New Session</h3>
            <p class="text-muted">Fill the form below to add a new session</p>

            <form id="sessionForm" method="POST" action="">
                <div class="col-md-12 mb-3">
                    <label for="sessionName" class="form-label">Session Name (e.g 2024/2025)</label>
                    <input type="text" class="form-control" id="sessionName" name="session_name"
                        placeholder="Enter session name" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="startDate" class="form-label">Start Date</label>
                    <input type="datetime" class="form-control" id="startDate" name="start_date" required>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="endDate" class="form-label">End Date</label>
                    <input type="datetime" class="form-control" id="endDate" name="end_date" required>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-outline me-2">Clear Form</button>
                    <button type="submit" name="create" class="btn btn-primary">Add Session</button>
                </div>
            </form>
        </div>
        <div class="card bg-white">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Existing Sessions</h5>
                <div class="d-flex">
                    <input type="text" class="form-control form-control-sm me-2" placeholder="Search sessions...">
                    <button class="btn btn-sm btn-outline"><i class="fas fa-download me-1"></i>Export</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Session Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024/2025</td>
                                <td>01/01/2024</td>
                                <td>31/12/2024</td>
                                <td>Active</td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                        data-bs-target="#editSessionModal"><i class="fas fa-edit me-1"></i>Edit</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteSessionModal"><i
                                            class="fas fa-trash me-1"></i>Delete</button>
                                </td>

                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
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

    <!-- Edit Session Modal -->
    <div class="modal fade" id="editSessionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Session</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSessionForm" method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" id="editSessionId" name="session_id">
                        <div class="mb-3">
                            <label for="editSessionName" class="form-label">Session Name</label>
                            <input type="text" class="form-control" id="editSessionName" name="edit_session_name"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editStartDate" class="form-label">Start Date</label>
                            <input type="datetime-local" class="form-control" id="editStartDate" name="edit_start_date"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="editEndDate" class="form-label">End Date</label>
                            <input type="datetime-local" class="form-control" id="editEndDate" name="edit_end_date"
                                required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="update" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteSessionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2 text-danger"></i>Confirm Delete
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the session "<span id="deleteSessionName"></span>"?</p>
                    <p class="text-danger"><small><i class="fas fa-warning me-1"></i>This action cannot be
                            undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteSessionForm" method="POST" action="" style="display: inline;">
                        <input type="hidden" id="deleteSessionId" name="session_id">
                        <button type="submit" name="delete" class="btn btn-danger">Delete Session</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="include/dash.js"></script>
    <script src="include/campus.js"></script>

    <script>
        // Handle Edit Button Click
        document.addEventListener('DOMContentLoaded', function () {
            // Edit functionality
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const sessionId = this.getAttribute('data-id');
                    const sessionName = this.getAttribute('data-name');
                    const startDate = this.getAttribute('data-start');
                    const endDate = this.getAttribute('data-end');

                    // Populate the edit modal with data
                    document.getElementById('editSessionId').value = sessionId;
                    document.getElementById('editSessionName').value = sessionName;
                    document.getElementById('editStartDate').value = startDate;
                    document.getElementById('editEndDate').value = endDate;
                });
            });

            // Delete functionality
            const deleteButtons = document.querySelectorAll('.delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const sessionId = this.getAttribute('data-id');
                    const sessionName = this.getAttribute('data-name');

                    // Populate the delete modal with data
                    document.getElementById('deleteSessionId').value = sessionId;
                    document.getElementById('deleteSessionName').textContent = sessionName;

                    // Show the delete modal
                    const deleteModal = new bootstrap.Modal(document.getElementById('deleteSessionModal'));
                    deleteModal.show();
                });
            });

            // Form validation for edit modal
            const editForm = document.getElementById('editSessionForm');
            editForm.addEventListener('submit', function (e) {
                const startDate = new Date(document.getElementById('editStartDate').value);
                const endDate = new Date(document.getElementById('editEndDate').value);

                if (endDate <= startDate) {
                    e.preventDefault();
                    alert('End date must be after start date.');
                    return false;
                }
            });

            // Form validation for create form
            const createForm = document.getElementById('sessionForm');
            createForm.addEventListener('submit', function (e) {
                const startDate = new Date(document.getElementById('startDate').value);
                const endDate = new Date(document.getElementById('endDate').value);

                if (endDate <= startDate) {
                    e.preventDefault();
                    alert('End date must be after start date.');
                    return false;
                }
            });
        });
    </script>
</body>

</html>