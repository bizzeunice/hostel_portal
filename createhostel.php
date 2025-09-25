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
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=random" width="40" class="rounded-circle me-3" alt="User">
                <div>
                    <div>Superadmin</div>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>

    <div class="campus-banner">
        <div class="campus-text">
            <h2>Create Hostel</h2>
            <p class="mb-0">Add a new hostel and auto-generate rooms and beds</p>
        </div>
        <span>
            <a href="dashboard.php" class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to Dashboard</a>
        </span>
    </div>

    <!-- Alerts removed (no server-side processing in this PHP-free file) -->

    <div class="form-section bg-white">
        <h3><i class="fas fa-plus-circle me-2"></i>Add New Hostel</h3>
        <p class="text-muted">Enter details for a new hostel</p>

        <form id="hostelForm" method="post" action="">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="hostel_name" class="form-label">Hostel Name</label>
                    <input type="text" class="form-control" id="hostel_name" name="hostel_name" value="" placeholder="e.g., Queen Amina Hall" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="campus_id" class="form-label">Campus</label>
                    <select name="campus_id" id="campus_id" class="form-select" required>
                        <option value="" selected>Select Campus</option>
                        <!-- Populate campuses dynamically via JS if needed -->
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="hostel_type" class="form-label">Type</label>
                    <select class="form-select" id="hostel_type" name="hostel_type" required>
                        <option value="" disabled selected>Select type</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Mixed">Mixed</option>
                        <option value="Staff">Staff</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="hostel_status" class="form-label">Status</label>
                    <select class="form-select" name="hostel_status" id="hostel_status" required>
                        <option value="" disabled selected>Select status</option>
                        <option value="Available">Available</option>
                        <option value="Under Maintenance">Under Maintenance</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <div class="col-12 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Optional details about the hostel."></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-outline me-2">Clear Form</button>
                <button type="submit" class="btn btn-primary">Add Hostel</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="include/dash.js"></script>
</body>
</html>
