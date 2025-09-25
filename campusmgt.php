 
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
                <h2>Campus Management</h2>
                <p class="mb-0">Manage university campuses and their details?</p>
            </div>
            <button class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to Dashboard</button>

        </div>

        <!-- Statistics Row -->
          <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">5</div>
                    <div class="stat-title">Total Campuses</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">12</div>
                    <div class="stat-title">Hostels</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">83%</div>
                    <div class="stat-title">Average Occupancy</div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="dashboard-card">
                    <div class="stat-number">42</div>
                    <div class="stat-title">Maintenance Requests</div>
                </div>
            </div>
        </div>

        <!-- Add Campus Section -->
           <div class="form-section bg-white">
            <h3><i class="fas fa-plus-circle me-2"></i>Add New Campus</h3>
            <p class="text-muted">Enter details for a new campus</p>
            
            <form id="campusForm">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="campusName" class="form-label">Campus Name</label>
                        <input type="text" class="form-control" id="campusName" placeholder="Enter campus name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="campusLocation" class="form-label">Location</label>
                        <input type="text" class="form-control" id="campusLocation" placeholder="Enter campus location" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="campusDescription" class="form-label">Description</label>
                    <textarea class="form-control" id="campusDescription" rows="3" placeholder="Enter campus description"></textarea>
                </div>
                
               
                
                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-outline me-2">Clear Form</button>
                    <button type="submit" class="btn btn-primary">Add Campus</button>
                </div>
            </form>
        </div>
        <div class="card bg-white">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Existing Campuses</h5>
                <div class="d-flex">
                    <input type="text" class="form-control form-control-sm me-2" placeholder="Search campuses...">
                    <button class="btn btn-sm btn-outline"><i class="fas fa-download me-1"></i>Export</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Campus Name</th>
                                <th>Location</th>
                                <th>Hostels</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>University of Lagos</td>
                                <td>Lagos, Nigeria</td>
                                <td>10</td>
                                <td ><span class="badge-pill badge-active">active</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary me-2" data-bs-toggle="modal"
                                        data-bs-target="#editCampusModal"><i class="fas fa-edit me-1"></i>Edit</button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteCampusModal"><i
                                            class="fas fa-trash me-1"></i>Delete</button>
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
    <div class="modal fade" id="editCampusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Campus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="editCampusName" class="form-label">Campus Name</label>
                            <input type="text" class="form-control" id="editCampusName" value="Main Campus">
                        </div>
                        <div class="mb-3">
                            <label for="editCampusLocation" class="form-label">Location</label>
                            <input type="text" class="form-control" id="editCampusLocation" value="Abraka">
                        </div>
                        <div class="mb-3">
                            <label for="editCampusDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editCampusDescription" rows="3">Main campus of Delta State University</textarea>
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
    <script src="include/bedspace.js"></script>

    
    <script>
      
    </script>
</body>
</html>