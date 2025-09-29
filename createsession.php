<?php
session_start();
// Check if user is logged in and is superadmin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superadmin') {
    header("Location: index.php");
    exit();
}

include 'include/db_connect.php';

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['create'])) {
        // Create new session
        $name = $conn->real_escape_string($_POST['name']);
        $programmes_id = $conn->real_escape_string($_POST['programmes_id']);
        $open_date = $conn->real_escape_string($_POST['open_date']);
        $close_date = $conn->real_escape_string($_POST['close_date']);
        
        $sql = "INSERT INTO sessions (name, programmes_id, open_date, close_date, is_active, created_at) 
                VALUES ('$name', '$programmes_id', '$open_date', '$close_date', 0, NOW())";
        
        if ($conn->query($sql)) {
            $message = "Session created successfully!";
            $message_type = "success";
        } else {
            $message = "Error creating session: " . $conn->error;
            $message_type = "danger";
        }
    }
    
    if (isset($_POST['update'])) {
        // Update session
        $session_id = $conn->real_escape_string($_POST['session_id']);
        $name = $conn->real_escape_string($_POST['edit_session_name']);
        $programmes_id = $conn->real_escape_string($_POST['edit_programme_id']);
        $open_date = $conn->real_escape_string($_POST['edit_start_date']);
        $close_date = $conn->real_escape_string($_POST['edit_end_date']);
        
        $sql = "UPDATE sessions SET name='$name', programmes_id='$programmes_id', open_date='$open_date', close_date='$close_date'
                WHERE id='$session_id'";
        
        if ($conn->query($sql)) {
            $message = "Session updated successfully!";
            $message_type = "success";
        } else {
            $message = "Error updating session: " . $conn->error;
            $message_type = "danger";
        }
    }
    
    if (isset($_POST['delete'])) {
        // Delete session
        $session_id = $conn->real_escape_string($_POST['session_id']);
        
        $sql = "DELETE FROM sessions WHERE id='$session_id'";
        
        if ($conn->query($sql)) {
            $message = "Session deleted successfully!";
            $message_type = "success";
        } else {
            $message = "Error deleting session: " . $conn->error;
            $message_type = "danger";
        }
    }
    
    if (isset($_POST['toggle_status'])) {
        // Toggle session status
        $session_id = $conn->real_escape_string($_POST['session_id']);
        
        // Get current status
        $check_sql = "SELECT is_active FROM sessions WHERE id='$session_id'";
        $result = $conn->query($check_sql);
        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $new_status = $row['is_active'] ? 0 : 1;
            
            // If activating this session, deactivate all others
            if ($new_status == 1) {
                $deactivate_sql = "UPDATE sessions SET is_active=0 WHERE id != '$session_id'";
                $conn->query($deactivate_sql);
            }
            
            $sql = "UPDATE sessions SET is_active='$new_status' WHERE id='$session_id'";
            
            if ($conn->query($sql)) {
                $message = "Session status updated successfully!";
                $message_type = "success";
                
                // Redirect to avoid form resubmission
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            } else {
                $message = "Error updating session status: " . $conn->error;
                $message_type = "danger";
            }
        }
    }
}

// Fetch all sessions
$sessions_sql = "SELECT s.*, p.name as programme_name 
                 FROM sessions s 
                 LEFT JOIN programmes p ON s.programmes_id = p.id 
                 ORDER BY s.created_at DESC";
$sessions_result = $conn->query($sessions_sql);
?>
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
    <?php include 'include/sidebar.php'; ?>

    <div id="content">
        <!-- Top Bar -->
        <div class="top-bar bg-white d-flex justify-content-between p-3 shadow rounded mb-3">
            <div class="d-flex align-items-center">
                <button id="sidebarToggle" class="d-md-none me-3 hamburger-btn" aria-label="Toggle navigation"
                    aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <div class="date-display">
                    <i class="fas fa-calendar-alt me-2"></i> <?php echo date('l, j F Y'); ?>
                </div>
            </div>
            <div class="user-info d-flex align-items-center">
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
                <h2>Session Management</h2>
                <p class="mb-0">Manage academic sessions and their details</p>
            </div>
            <button class="btn btn-light" onclick="window.location.href='dashboard.php'">
                <i class="fas fa-arrow-left"></i> &nbsp; Go back to Dashboard
            </button>
        </div>

        <!-- Message Display -->
        <?php if (isset($message)): ?>
            <div class="alert alert-<?php echo $message_type; ?> alert-dismissible fade show" role="alert">
                <?php echo $message; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Add Session Section -->
        <div class="form-section bg-white mb-4">
            <h3><i class="fas fa-plus-circle me-2"></i>Add New Session</h3>
            <p class="text-muted">Fill the form below to add a new academic session</p>

            <form id="sessionForm" method="POST" action="">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sessionName" class="form-label">Session Name *</label>
                        <input type="text" class="form-control" id="sessionName" name="name"
                            placeholder="e.g., 2024/2025" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="programme" class="form-label">Programme *</label>
                        <select name="programmes_id" class="form-select" required>
                            <option value="">Select Programme</option>
                            <?php
                            $sql = "SELECT * FROM programmes";
                            $result = $conn->query($sql);
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="startDate" class="form-label">Start Date *</label>
                        <input type="datetime-local" class="form-control" id="startDate" name="open_date" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="endDate" class="form-label">End Date *</label>
                        <input type="datetime-local" class="form-control" id="endDate" name="close_date" required>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-outline-secondary me-2">Clear Form</button>
                    <button type="submit" name="create" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Add Session
                    </button>
                </div>
            </form>
        </div>

        <!-- Existing Sessions Table -->
        <div class="card bg-white">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Existing Sessions</h5>
                <div class="d-flex">
                    <input type="text" class="form-control form-control-sm me-2" id="searchInput" placeholder="Search sessions...">
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-download me-1"></i>Export
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Session Name</th>
                                <th>Programme</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($sessions_result && $sessions_result->num_rows > 0): ?>
                                <?php while ($session = $sessions_result->fetch_assoc()): ?>
                                    <?php 
                                    $is_active = $session['is_active'] == 1;
                                    $status_text = $is_active ? 'Active' : 'Inactive';
                                    ?>
                                    <tr>
                                        <td class="fw-bold"><?php echo htmlspecialchars($session['name']); ?></td>
                                        <td><?php echo htmlspecialchars($session['programme_name'] ?? 'N/A'); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($session['open_date'])); ?></td>
                                        <td><?php echo date('d/m/Y', strtotime($session['close_date'])); ?></td>
                                        <td>
                                            <span class="status-badge <?php echo $is_active ? 'status-active' : 'status-inactive'; ?>">
                                                <?php echo $status_text; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!-- Toggle Switch -->
                                                <form method="POST" action="" class="me-2">
                                                    <input type="hidden" name="session_id" value="<?php echo $session['id']; ?>">
                                                    <input type="hidden" name="toggle_status" value="1">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" 
                                                               role="switch" 
                                                               <?php echo $is_active ? 'checked' : ''; ?>
                                                               onchange="this.form.submit()">
                                                    </div>
                                                </form>
                                                
                                                <!-- Edit Button -->
                                                <button class="btn btn-sm btn-primary btn-action edit-btn" 
                                                        data-bs-toggle="modal" data-bs-target="#editSessionModal"
                                                        data-id="<?php echo $session['id']; ?>"
                                                        data-name="<?php echo htmlspecialchars($session['name']); ?>"
                                                        data-programme="<?php echo $session['programmes_id']; ?>"
                                                        data-start="<?php echo date('Y-m-d\TH:i', strtotime($session['open_date'])); ?>"
                                                        data-end="<?php echo date('Y-m-d\TH:i', strtotime($session['close_date'])); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                
                                                <!-- Delete Button -->
                                                <button class="btn btn-sm btn-danger btn-action delete-btn" 
                                                        data-bs-toggle="modal" data-bs-target="#deleteSessionModal"
                                                        data-id="<?php echo $session['id']; ?>"
                                                        data-name="<?php echo htmlspecialchars($session['name']); ?>">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                        <p class="text-muted">No sessions found. Create your first session above.</p>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Session Modal -->
    <div class="modal fade" id="editSessionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Session</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editSessionForm" method="POST" action="">
                    <div class="modal-body">
                        <input type="hidden" id="editSessionId" name="session_id">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editSessionName" class="form-label">Session Name *</label>
                                <input type="text" class="form-control" id="editSessionName" name="edit_session_name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editProgramme" class="form-label">Programme *</label>
                                <select name="edit_programme_id" class="form-select" id="editProgramme" required>
                                    <option value="">Select Programme</option>
                                    <?php
                                    $sql = "SELECT * FROM programmes";
                                    $result = $conn->query($sql);
                                    if ($result) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="editStartDate" class="form-label">Start Date *</label>
                                <input type="datetime-local" class="form-control" id="editStartDate" name="edit_start_date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="editEndDate" class="form-label">End Date *</label>
                                <input type="datetime-local" class="form-control" id="editEndDate" name="edit_end_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Cancel
                        </button>
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteSessionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Confirm Delete</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                        <h5>Are you sure you want to delete this session?</h5>
                    </div>
                    <p class="text-center">You are about to delete the session: <strong id="deleteSessionName"></strong></p>
                    <p class="text-danger text-center">
                        <small><i class="fas fa-warning me-1"></i>This action cannot be undone and will permanently remove the session.</small>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Cancel
                    </button>
                    <form id="deleteSessionForm" method="POST" action="" style="display: inline;">
                        <input type="hidden" id="deleteSessionId" name="session_id">
                        <button type="submit" name="delete" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Delete Session
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Handle Edit Button Click
        document.addEventListener('DOMContentLoaded', function () {
            // Edit functionality
            const editButtons = document.querySelectorAll('.edit-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const sessionId = this.getAttribute('data-id');
                    const sessionName = this.getAttribute('data-name');
                    const programmeId = this.getAttribute('data-programme');
                    const startDate = this.getAttribute('data-start');
                    const endDate = this.getAttribute('data-end');

                    document.getElementById('editSessionId').value = sessionId;
                    document.getElementById('editSessionName').value = sessionName;
                    document.getElementById('editProgramme').value = programmeId;
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

                    document.getElementById('deleteSessionId').value = sessionId;
                    document.getElementById('deleteSessionName').textContent = sessionName;
                });
            });

            // Search functionality
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const filter = this.value.toLowerCase();
                    const rows = document.querySelectorAll('tbody tr');
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(filter) ? '' : 'none';
                    });
                });
            }

            // Form validation for create form
            const createForm = document.getElementById('sessionForm');
            if (createForm) {
                createForm.addEventListener('submit', function (e) {
                    const startDate = new Date(document.getElementById('startDate').value);
                    const endDate = new Date(document.getElementById('endDate').value);

                    if (endDate <= startDate) {
                        e.preventDefault();
                        alert('End date must be after start date.');
                        return false;
                    }
                });
            }

            // Form validation for edit form
            const editForm = document.getElementById('editSessionForm');
            if (editForm) {
                editForm.addEventListener('submit', function (e) {
                    const startDate = new Date(document.getElementById('editStartDate').value);
                    const endDate = new Date(document.getElementById('editEndDate').value);

                    if (endDate <= startDate) {
                        e.preventDefault();
                        alert('End date must be after start date.');
                        return false;
                    }
                });
            }
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>