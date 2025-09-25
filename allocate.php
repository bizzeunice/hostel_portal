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
    <link rel="stylesheet" href="include/allocate.css">
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
                <h2>Manual Hostel Allocation</h2>
                <p class="mb-0"></p>
            </div>
            <span>
                <a href="dashboard.php" class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to
                    Dashboard</a>
            </span>
        </div>

        <!-- Alerts removed (no server-side processing in this PHP-free file) -->

        <!-- Allocation Form -->
        <div class="Container-fliud">
            <div class="allocation-form">
                <h3 class="section-title">Allocation Details</h3>

                <div class="form-section">
                    <h5>Step 1: Select Student</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search by name or matric number"
                                    id="studentSearch">
                                <button class="btn btn-delsu" type="button">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="card student-card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5>John Doe</h5>
                                    <p class="mb-1">Matric No: DELSU/CSC/2021/1234</p>
                                    <p class="mb-1">Department: Computer Science</p>
                                    <p class="mb-1">Level: 300</p>
                                    <p class="mb-0">Gender: Male</p>
                                </div>
                                <div class="col-md-4 text-end">
                                    <span class="badge bg-success">Eligible</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h5>Step 2: Select Hostel & Room</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="hostelSelect" class="form-label">Select Hostel</label>
                            <select class="form-select" id="hostelSelect">
                                <option selected>Choose hostel...</option>
                                <option value="1">Queen's Hall (Female)</option>
                                <option value="2">Warrior Towers (Male)</option>
                                <option value="3">Niger Hall (Male)</option>
                                <option value="4">Benue Hall (Female)</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="roomSelect" class="form-label">Select Room</label>
                            <select class="form-select" id="roomSelect">
                                <option selected>Choose room...</option>
                                <option value="1">Room 101 (4-Bed Space)</option>
                                <option value="2">Room 102 (4-Bed Space)</option>
                                <option value="3">Room 103 (6-Bed Space)</option>
                                <option value="4">Room 104 (6-Bed Space)</option>
                            </select>
                        </div>
                    </div>

                    <div class="card hostel-card">
                        <div class="card-body">
                            <h5>Room 101 - Warrior Towers</h5>
                            <p class="mb-1">Room Type: 4-Bed Space</p>
                            <p class="mb-1">Available Beds: 2 of 4</p>
                            <p class="mb-0">Gender: Male</p>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h5>Step 3: Select Bedspace</h5>
                    <p>Available bedspaces in Room 101:</p>

                    <div class="bedspace-grid">
                        <!-- <div class="bedspace-item occupied">
                            <div class="bedspace-icon text-danger">
                                <i class="fas fa-bed"></i>
                            </div>
                            <h6>Bed 1</h6>
                            <p class="mb-0 text-danger">Occupied</p>
                        </div> -->

                        <div class="bedspace-item available">
                            <div class="bedspace-icon text-success">
                                <i class="fas fa-bed"></i>
                            </div>
                            <h6>Bed 2</h6>
                            <p class="mb-0 text-success">Available</p>
                        </div>

                        <!-- <div class="bedspace-item occupied">
                            <div class="bedspace-icon text-danger">
                                <i class="fas fa-bed"></i>
                            </div>
                            <h6>Bed 3</h6>
                            <p class="mb-0 text-danger">Occupied</p>
                        </div> -->

                        <div class="bedspace-item available">
                            <div class="bedspace-icon text-success">
                                <i class="fas fa-bed"></i>
                            </div>
                            <h6>Bed 4</h6>
                            <p class="mb-0 text-success">Available</p>
                        </div>
                    </div>
                </div>

                <div class="form-section">
                    <h5>Step 4: Confirm Allocation</h5>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> Please review the allocation details before confirming.
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h6>Allocation Summary</h6>
                            <p class="mb-1"><strong>Student:</strong> John Doe (DELSU/CSC/2021/1234)</p>
                            <p class="mb-1"><strong>Hostel:</strong> Warrior Towers</p>
                            <p class="mb-1"><strong>Room:</strong> 101 (4-Bed Space)</p>
                            <p class="mb-0"><strong>Bedspace:</strong> Bed 2</p>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <button class="btn btn-delsu btn-lg">Confirm Allocation</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="include/dash.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Bedspace selection functionality
            const bedspaceItems = document.querySelectorAll('.bedspace-item.available');
            bedspaceItems.forEach(item => {
                item.addEventListener('click', function () {
                    // Remove selected class from all items
                    bedspaceItems.forEach(i => i.classList.remove('selected'));
                    // Add selected class to clicked item
                    this.classList.add('selected');
                });
            });

            // Hostel selection functionality
            const hostelSelect = document.getElementById('hostelSelect');
            hostelSelect.addEventListener('change', function () {
                // In a real application, this would load available rooms for the selected hostel
                console.log('Hostel selected:', this.value);
            });

            // Room selection functionality
            const roomSelect = document.getElementById('roomSelect');
            roomSelect.addEventListener('change', function () {
                // In a real application, this would load available bedspaces for the selected room
                console.log('Room selected:', this.value);
            });

            // Student search functionality
            const studentSearch = document.getElementById('studentSearch');
            studentSearch.addEventListener('keyup', function () {
                // In a real application, this would search for students
                console.log('Searching for:', this.value);
            });
        });
    </script>
</body>

</html>