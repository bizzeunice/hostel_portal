<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Management - DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="include/bedspace.css">
    <link rel="stylesheet" href="include/dashboard.css">
</head>

<body>
    <!-- Sidebar -->
    <?php
    include 'include/sidebar.php';
    ?>

    <div id="content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="d-flex align-items-center">
                <button id="sidebarToggle" class="d-md-none me-3 hamburger-btn" aria-label="Toggle navigation"
                    aria-expanded="false">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
                <div class="date-display">
                    <i class="fas fa-calendar-alt me-2"></i> Monday, 11 September 2023
                </div>
            </div>
            <div class="user-info">
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=random" alt="User">
                <div>
                    <div>Superadmin</div>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="campus-banner">
            <div class="campus-text">
                <h2>Manage BedSpace and Rooms</h2>
                <p class="mb-0">Manage Hostel Bedpace and Rooms and their details?</p>
            </div>
            <button class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to Dashboard</button>

        </div>



        <!-- Existing Campuses Table -->
        <div class="hostel-details">
            <div class="row">
                <div class="col-md-6">
                    <h3><i class="fas fa-info-circle me-2"></i>Hostel Information</h3>
                    <table class="table table-borderless">
                        <tr>
                            <th width="120">Name:</th>
                            <td>Abraka Hall</td>
                        </tr>
                        <tr>
                            <th>Campus:</th>
                            <td>Abraka Campus</td>
                        </tr>
                        <tr>
                            <th>Type:</th>
                            <td>Male Hostel</td>
                        </tr>
                        <tr>
                            <th>Rooms:</th>
                            <td>40</td>
                        </tr>
                        <tr>
                            <th>Bedspaces:</th>
                            <td>120 (3 per room)</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h3><i class="fas fa-align-left me-2"></i>Description</h3>
                    <p>Abraka Hall is one of the premium male hostels on Abraka Campus. It features 24/7 security, WiFi
                        access, common study rooms, and a recreational area. Each room has an ensuite bathroom and is
                        equipped with a bed, study table, and wardrobe for each student.</p>
                    <p class="mb-0"><strong>Facilities:</strong> WiFi, 24/7 Security, Common Room, Laundry, Study Area
                    </p>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-section">
            <h3><i class="fas fa-search me-2"></i>Search and Hostel </h3>
            <div class="row">
                <div class="col-md-8 mb-3">
                    <input type="text" class="form-control"
                        placeholder="Search by room number, status, or student name">
                </div>
                <div class="col-md-4 mb-3">
                    <div class="d-flex">
                        <select class="form-select me-2">
                            <option selected>Filter by Status</option>
                            <option>Available</option>
                            <option>Occupied</option>
                            <option>Reserved</option>
                        </select>
                        <button class="btn btn-primary"><i class="fas fa-search me-1"></i>Search</button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-outline"><i class="fas fa-sync-alt me-1"></i>Reset Filters</button>
            </div>
        </div>

        <!-- Rooms and Bedspaces Grid -->

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-door-open me-2"></i>Rooms and Bedspaces</h5>
                <div class="d-flex">
                    <button class="btn btn-sm btn-outline me-2"><i class="fas fa-print me-1"></i>Print Report</button>
                    <button class="btn btn-sm btn-primary"><i class="fas fa-download me-1"></i>Export</button>
                </div>
            </div>
            <div class="card-body">
                <div class="room-grid">
                    <!-- Room 1 -->
                    <div class="room-card">
                        <div class="d-flex">
                            <span>
                                <h5>Room 101</h5>
                                <p class="text-muted">Ground Floor - Block A</p>
                            </span>
                            <button class=""><i class="fas fa-info-circle"></i>Reserved</button>
                        </div>
                        <div class="bedspace-grid">
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace available" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Available</small>
                            </div>
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Occupied</small>
                            </div>
                        </div>
                    </div>

                    <!-- Room 2 -->
                    <div class="room-card">
                        <h5>Room 102</h5>
                        <p class="text-muted">Ground Floor - Block A</p>
                        <div class="bedspace-grid">
                            <div class="bedspace available" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Available</small>
                            </div>
                            <div class="bedspace available" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Available</small>
                            </div>
                            <div class="bedspace reserved" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Reserved</small>
                            </div>
                        </div>
                    </div>

                    <!-- Room 3 -->
                    <div class="room-card">
                        <h5>Room 103</h5>
                        <p class="text-muted">Ground Floor - Block A</p>
                        <div class="bedspace-grid">
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Occupied</small>
                            </div>
                        </div>
                    </div>

                    <!-- Room 4 -->
                    <div class="room-card">
                        <h5>Room 104</h5>
                        <p class="text-muted">Ground Floor - Block A</p>
                        <div class="bedspace-grid">
                            <div class="bedspace available" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Available</small>
                            </div>
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace available" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Available</small>
                            </div>
                        </div>
                    </div>

                    <!-- Room 5 -->
                    <div class="room-card">
                        <h5>Room 105</h5>
                        <p class="text-muted">Ground Floor - Block A</p>
                        <div class="bedspace-grid">
                            <div class="bedspace reserved" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Reserved</small>
                            </div>
                            <div class="bedspace reserved" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Reserved</small>
                            </div>
                            <div class="bedspace available" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Available</small>
                            </div>
                        </div>
                    </div>

                    <!-- Room 6 -->
                    <div class="room-card">
                        <h5>Room 106</h5>
                        <p class="text-muted">Ground Floor - Block A</p>
                        <div class="bedspace-grid">
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace occupied" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Occupied</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
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

    <!-- Bedspace Details Modal -->

    <div class="modal fade" id="bedspaceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-bed me-2"></i>Bedspace Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="availableBedspace" class="bedspace-detail">
                        <h4 class="text-success">Bedspace Available</h4>
                        <p>This bedspace is currently available for assignment.</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignModal">
                                <i class="fas fa-user-plus me-2"></i>Assign Student
                            </button>
                            <button class="btn btn-outline">
                                <i class="fas fa-lock me-2"></i>Reserve Bedspace
                            </button>
                        </div>
                    </div>

                    <div id="occupiedBedspace" class="bedspace-detail d-none">
                        <h4 class="text-dark">Bedspace Occupied</h4>
                        <div class="student-info">
                            <div class="text-center mb-3">
                                <i class="fas fa-user-circle fa-3x text-primary"></i>
                            </div>
                            <table class="table table-borderless">
                                <tr>
                                    <th>Student:</th>
                                    <td>John Okoro</td>
                                </tr>
                                <tr>
                                    <th>ID:</th>
                                    <td>DELSU/2019/1234</td>
                                </tr>
                                <tr>
                                    <th>Faculty:</th>
                                    <td>Social Sciences</td>
                                </tr>
                                <tr>
                                    <th>Department:</th>
                                    <td>Economics</td>
                                </tr>
                                <tr>
                                    <th>Level:</th>
                                    <td>300</td>
                                </tr>
                                <tr>
                                    <th>Date Assigned:</th>
                                    <td>15 Jan 2023</td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline">
                                <i class="fas fa-eye me-2"></i>View Student Profile
                            </button>
                            <button class="btn btn-outline">
                                <i class="fas fa-exchange-alt me-2"></i>Transfer Student
                            </button>
                            <button class="btn btn-outline text-danger">
                                <i class="fas fa-times me-2"></i>Vacate Bedspace
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Student Modal -->
    <div class="modal fade" id="assignModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Assign Student to Bedspace</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="studentSearch" class="form-label">Search Student</label>
                            <input type="text" class="form-control" id="studentSearch"
                                placeholder="Enter student name or ID">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Or select from list</label>
                            <select class="form-select">
                                <option selected>Select a student</option>
                                <option>John Okoro (DELSU/2019/1234)</option>
                                <option>Chioma Nwosu (DELSU/2020/5678)</option>
                                <option>Emeka Onah (DELSU/2019/9012)</option>
                                <option>Fatima Ahmed (DELSU/2021/3456)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assignmentDate" class="form-label">Assignment Date</label>
                            <input type="date" class="form-control" id="assignmentDate">
                        </div>
                        <div class="mb-3">
                            <label for="duration" class="form-label">Duration</label>
                            <select class="form-select" id="duration">
                                <option selected>Full Academic Session</option>
                                <option>First Semester Only</option>
                                <option>Second Semester Only</option>
                                <option>Custom Period</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Assign Student</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="include/dash.js"></script>
    <script src="include/viwhost.js"></script>

    <script>

    </script>
</body>

</html>