<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Management - DELSU Hostel Portal</title>
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
                <img src="https://ui-avatars.com/api/?name=Super+Admin&background=random" width="40"
                    class="rounded-circle me-3" alt="User">
                <div>
                    <div>Superadmin</div>
                    <small class="text-muted">Admin</small>
                </div>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="campus-banner">
            <div class="campus-text">
                <h2>View Hostels</h2>
                <p class="mb-0">Manage university campuses and their details?</p>
            </div>
            <button class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to Dashboard</button>

        </div>



        <!-- Existing Campuses Table -->
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Existing Hostels</h5>
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
                                <th>Campus</th>
                                <th>Type</th>
                                <th>Rooms</th>
                                <th>Beds/Room</th>
                                <th>Price (₦)</th>
                                <th>Occupancy</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Unity Hall</td>
                                <td>Main Campus</td>
                                <td>Male</td>
                                <td>60</td>
                                <td>4</td>
                                <td>25,000</td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 95%;"></div>
                                    </div>
                                    <small>95% occupied</small>
                                </td>
                                <td><span class="badge badge-full">Full</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteHostelModal" data-hostel-name="Unity Hall"><i
                                            class="fas fa-trash"></i></button>
                                    <button class="btn btn-sm btn-info"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Peace Hall</td>
                                <td>Main Campus</td>
                                <td>Female</td>
                                <td>50</td>
                                <td>3</td>
                                <td>30,000</td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 80%;"></div>
                                    </div>
                                    <small>80% occupied</small>
                                </td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-hostel-btn" data-bs-toggle="modal"
                                        data-bs-target="#editHostelModal" data-hostel="Peace Hall"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger delete-hostel-btn" data-hostel="Peace Hall"><i
                                            class="fas fa-trash"></i></button>
                                    <a href="createrooms.php"><button class="btn btn-sm btn-info view-hostel-btn"
                                            data-hostel="Peace Hall"><i class="fas fa-eye"></i></button></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Progress Hall</td>
                                <td>Anwai Campus</td>
                                <td>Mixed</td>
                                <td>40</td>
                                <td>2</td>
                                <td>40,000</td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 65%;"></div>
                                    </div>
                                    <small>65% occupied</small>
                                </td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-hostel-btn" data-bs-toggle="modal"
                                        data-bs-target="#editHostelModal" data-hostel="Progress Hall"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger delete-hostel-btn"
                                        data-hostel="Progress Hall"><i class="fas fa-trash"></i></button>
                                    <button class="btn btn-sm btn-info view-hostel-btn" data-hostel="Progress Hall"><i
                                            class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Engineering Hostel</td>
                                <td>Engineering Campus</td>
                                <td>Male</td>
                                <td>30</td>
                                <td>4</td>
                                <td>22,000</td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 45%;"></div>
                                    </div>
                                    <small>45% occupied</small>
                                </td>
                                <td><span class="badge badge-maintenance">Maintenance</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-hostel-btn" data-bs-toggle="modal"
                                        data-bs-target="#editHostelModal" data-hostel="Engineering Hostel"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger delete-hostel-btn"
                                        data-hostel="Engineering Hostel"><i class="fas fa-trash"></i></button>
                                    <button class="btn btn-sm btn-info view-hostel-btn"
                                        data-hostel="Engineering Hostel"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>Medical Hostel</td>
                                <td>Medical Campus</td>
                                <td>Female</td>
                                <td>35</td>
                                <td>3</td>
                                <td>35,000</td>
                                <td>
                                    <div class="progress" style="height: 8px;">
                                        <div class="progress-bar" style="width: 90%;"></div>
                                    </div>
                                    <small>90% occupied</small>
                                </td>
                                <td><span class="badge badge-available">Available</span></td>
                                <td class="action-buttons">
                                    <button class="btn btn-sm btn-primary edit-hostel-btn" data-bs-toggle="modal"
                                        data-bs-target="#editHostelModal" data-hostel="Medical Hostel"><i
                                            class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-danger delete-hostel-btn"
                                        data-hostel="Medical Hostel"><i class="fas fa-trash"></i></button>
                                    <button class="btn btn-sm btn-info view-hostel-btn" data-hostel="Medical Hostel"><i
                                            class="fas fa-eye"></i></button>
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
                            <div class="col-md-4 mb-3">
                                <label for="editHostelType" class="form-label">Hostel Type</label>
                                <select class="form-select" id="editHostelType">
                                    <option value="male" selected>Male Hostel</option>
                                    <option value="female">Female Hostel</option>
                                    <option value="mixed">Mixed Hostel</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="editTotalRooms" class="form-label">Number of Rooms</label>
                                <input type="number" class="form-control" id="editTotalRooms" value="60">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="editBedsPerRoom" class="form-label">Beds per Room</label>
                                <input type="number" class="form-control" id="editBedsPerRoom" value="4">
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

                        <div class="mb-3">
                            <label for="editHostelDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editHostelDescription"
                                rows="3">Main male hostel with 60 rooms, each containing 4 beds. Facilities include common rooms, WiFi, and 24/7 security.</textarea>
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
                    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2 text-warning"></i>Delete Hostel
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-trash-alt fa-3x text-danger mb-3"></i>
                        <h6>Are you sure you want to delete this hostel?</h6>
                        <p class="text-muted mb-0">This action cannot be undone. All associated data will be permanently
                            removed.</p>
                    </div>
                    <div class="alert alert-warning">
                        <strong>Hostel:</strong> <span id="deleteHostelName"></span><br>
                        <strong>Warning:</strong> This will remove all room assignments and student records associated
                        with this hostel.
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
    <script src="include/viwhost.js"></script>

    <script>

    </script>
</body>

</html>