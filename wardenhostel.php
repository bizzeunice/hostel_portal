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
    <style>
    /* Occupied bedspaces are not clickable; reserved ones are clickable so they can be unreserved */
    .bedspace.occupied {
        cursor: not-allowed;
    }
    .bedspace.occupied:hover i::before {
        content: "\f05e" !important;
    }
    /* Indicate reserved bedspaces are actionable */
    .bedspace.reserved {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <?php
    include 'include/sidebar.php';
    ?>

    <div id="content">


        <!-- Welcome Banner -->
        <div class="campus-banner">
            <div class="campus-text">
                <h2>Manage BedSpace and Rooms</h2>
                <p class="mb-0">Manage Hostel Bedpace and Rooms and their details?</p>
            </div>
            <button class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to Dashboard</button>

        </div>



        <!-- Existing Campuses Table -->


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
                        <div class="d-flex justify-content-between align-items-center">
                            <span>
                                <h5>Room 101</h5>
                                <p class="text-muted">Ground Floor - Block A</p>
                            </span>
                            <a href="reserverooms.php"><button class="btn btn-primary"><i class="fas fa-lock-open"></i> Reserved</button></a>
                        </div>
                        <div class="bedspace-grid">
                            <div class="bedspace occupied">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace available" data-bs-toggle="modal" data-bs-target="#bedspaceModal">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Available</small>
                            </div>
                            <div class="bedspace occupied">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Occupied</small>
                            </div>
                        </div>
                    </div>

                    <!-- Room 2 -->
                    <div class="room-card">
                      <div class="d-flex justify-content-between align-items-center">
                            <span>
                                <h5>Room 101</h5>
                                <p class="text-muted">Ground Floor - Block A</p>
                            </span>
                            <a href="reserverooms.php"><button class="btn btn-primary"><i class="fas fa-lock-open"></i> Reserved</button></a>
                        </div>
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
                            <div class="bedspace reserved">
                                <i class="fas fa-bed"></i>
                                <div>Bed 3</div>
                                <small>Reserved</small>
                            </div>
                        </div>
                    </div>

                    <!-- Room 3 -->
                    <div class="room-card">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>
                                <h5>Room 101</h5>
                                <p class="text-muted">Ground Floor - Block A</p>
                            </span>
                            <a href="reserverooms.php"><button class="btn btn-primary"><i class="fas fa-lock-open"></i> Reserved</button></a>
                        </div>
                        <div class="bedspace-grid">
                            <div class="bedspace occupied">
                                <i class="fas fa-bed"></i>
                                <div>Bed 1</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace occupied">
                                <i class="fas fa-bed"></i>
                                <div>Bed 2</div>
                                <small>Occupied</small>
                            </div>
                            <div class="bedspace occupied">
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
                          
                            <button class="btn btn-outline">
                                  <a href="reservebed.php" class="text-decoration-none text-dark">
                                <i class="fas fa-lock me-2"></i>Reserve Bedspace</a>
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
    


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="include/dash.js"></script>
    <script src="include/viwhost.js"></script>

    <script>
      // Unreserve reserved bedspaces on click without prompts
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.bedspace.reserved').forEach(function(card) {
          if (card.dataset.unreserveBound === '1') return;
          card.dataset.unreserveBound = '1';
          card.title = 'Click to mark as available';
          card.style.cursor = 'pointer';
          card.addEventListener('click', function() {
            if (!this.classList.contains('reserved')) return;
            this.classList.remove('reserved');
            this.classList.add('available');
            var label = this.querySelector('small');
            if (label) label.textContent = 'Available';
            this.setAttribute('data-bs-toggle', 'modal');
            this.setAttribute('data-bs-target', '#bedspaceModal');
          });
        });
      });
    </script>
</body>

</html>