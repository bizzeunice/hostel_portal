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
    <?php include 'include/sidebar.php'; ?>

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
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=random" width="40"
                    class="rounded-circle me-3" alt="User">
                <div>
                    <div>Superadmin</div>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>

        <!-- Banner -->
        <div class="campus-banner">
            <div class="campus-text">
                <h2>Create Rooms</h2>
                <p class="mb-0">Add a new rooms and beds</p>
            </div>
            <span>
                <a href="dashboard.php" class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to
                    Dashboard</a>
            </span>
        </div>

        <!-- Alerts -->
        <div class="container-fluid px-0">


            <!-- Create Hostel Form -->
            <div class="form-section bg-white">
                <h3><i class="fas fa-plus-circle me-2"></i>Add New Room</h3>
                <p class="text-muted">Enter details for a new hostel</p>

                <form id="hostelForm" method="post" action="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="campus_id" class="form-label">Select Hostel</label>
                            <select name="hostel_id" id="hostel_id" class="form-select" required>
                                <option value="">Select Hostel</option>


                                <option value="" disabled>No campuses found</option>

                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="room_number" class="form-label">Room Number</label>
                            <input type="text" class="form-control" id="room_number" name="room_number" value=""
                                placeholder="e.g., Queen Amina Hall" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="price_per_room" class="form-label">Price Per Room</label>
                            <input type="text" class="form-control" id="price_per_room" name="price_per_room" value=""
                                placeholder="e.g., Queen Amina Hall" required>
                        </div>



                        <div class="col-md-6 mb-3">
                            <label for="hostel_status" class="form-label">Status</label>
                            <select class="form-select" name="hostel_status" id="hostel_status" required>


                            </select>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-outline me-2">Clear Form</button>
                        <button type="submit" class="btn btn-primary">Add Rooms</button>
                    </div>
                </form>
            </div>


            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-list me-2"></i>Existing Rooms</h5>
                    <div class="d-flex">
                        <input type="text" class="form-control form-control-sm me-2" placeholder="Search hostels...">
                        <button class="btn btn-sm btn-outline"><i class="fas fa-download me-1"></i>Export</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Hostel Name</th>
                                    <th>Room number</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Queen Amina Hall</td>
                                    <td>Room 1</td>
                                    <td>25,000</td>

                                    <td><span class="badge bg-success">Available</span></td>
                                     <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-hostel-btn" data-bs-toggle="modal" data-bs-target="#editHostelModal" data-hostel="Peace Hall"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteHostelModal" data-hostel-name="Unity Hall"><i class="fas fa-trash"></i></button>
                                    <a href="createbed.php"><button class="btn btn-sm btn-info view-hostel-btn" data-hostel="Peace Hall"><i class="fas fa-eye"></i></button></a>
                                </td>
                                    
                                </tr>
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

        <!-- Edit Campus Modal -->
        <div class="modal fade" id="editHostelModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Hostel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="editHostelName" class="form-label">Hostel Name</label>
                                    <input type="text" class="form-control" id="editHostelName" value="Unity Hall">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="editCampusLocation" class="form-label">Campus Location</label>
                                    <select class="form-select" id="editCampusLocation">
                                        <option value="main" selected>Main Campus (Abraka)</option>
                                        <option value="anwai">Anwai Campus (Asaba)</option>
                                        <option value="engineering">Engineering Campus</option>
                                        <option value="medical">Medical Campus (Oleh)</option>
                                        <option value="law">Law Campus</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="editPricePerBed" class="form-label">Price per Bed (₦)</label>
                                    <input type="number" class="form-control" id="editPricePerBed" value="25000">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="editHostelStatus" class="form-label">Status</label>
                                    <select class="form-select" id="editHostelStatus">
                                        <option value="available">Available</option>
                                        <option value="full" selected>Full</option>
                                        <option value="maintenance">Under Maintenance</option>
                                    </select>
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
        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteHostelModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Delete
                            Hostel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                            <h6>Are you sure you want to delete this hostel?</h6>
                            <p class="text-muted mb-0">This action cannot be undone. All associated data will be
                                permanently removed.</p>
                        </div>
                        <div class="alert alert-warning">
                            <strong>Hostel:</strong> <span id="deleteHostelName"></span><br>
                            <strong>Warning:</strong> This will remove all room assignments and student records
                            associated with this hostel.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                            <i class="fas fa-trash me-1"></i>Delete Hostel
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="include/dash.js"></script>
</body>

</html>