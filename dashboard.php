<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELSU Hostel Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./include/dashboard.css">
</head>

<body>
    <!-- Sidebar Toggle Button -->
   

    <!-- Sidebar -->
    <?php include 'include/sidebar.php'; ?>

    <!-- Main Content -->
    <div id="content">
        <div class="container-fluid">
            <h1 class="mb-4">Super Admin Dashboard</h1>

            <!-- Dashboard Stats -->
            <div class="row">
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon" style="background-color: rgba(58, 12, 163, 0.1); color: var(--primary);">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="card-value">12</div>
                        <div class="card-title">Total Hostels</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon"
                            style="background-color: rgba(67, 97, 238, 0.1); color: var(--secondary);">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div class="card-value">348</div>
                        <div class="card-title">Total Rooms</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon" style="background-color: rgba(114, 9, 183, 0.1); color: var(--accent);">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="card-value">284</div>
                        <div class="card-title">Occupied Beds</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <div class="card-icon" style="background-color: rgba(40, 167, 69, 0.1); color: #28a745;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-value">64</div>
                        <div class="card-title">Available Beds</div>
                    </div>
                </div>
            </div>

            <!-- Additional Dashboard Content -->
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="dashboard-card">
                        <h4><i class="fas fa-chart-line me-2"></i> Occupancy Rate</h4>
                        <p class="text-muted">Current occupancy rate across all hostels</p>
                        <div class="progress mb-3" style="height: 25px;">
                            <div class="progress-bar" role="progressbar"
                                style="width: 82%; background-color: var(--primary);" aria-valuenow="82"
                                aria-valuemin="0" aria-valuemax="100">82%</div>
                        </div>
                        <div class="mt-4">
                            <h5>Recent Activities</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-bed text-primary me-2"></i>
                                        New booking in Queen's Hall
                                    </div>
                                    <span class="text-muted">2 hours ago</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-tools text-warning me-2"></i>
                                        Maintenance request in Warrior Towers
                                    </div>
                                    <span class="text-muted">5 hours ago</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        Payment completed by student ENG17/1234
                                    </div>
                                    <span class="text-muted">Yesterday</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="dashboard-card">
                        <h4><i class="fas fa-money-bill-wave me-2"></i> Payment Summary</h4>
                        <p class="text-muted">Current payment status</p>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Paid:</span>
                            <span class="text-success">₦2,840,000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Pending:</span>
                            <span class="text-warning">₦320,000</span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span>Failed:</span>
                            <span class="text-danger">₦42,000</span>
                        </div>

                        <h5 class="mt-4">Quick Actions</h5>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary"><i class="fas fa-plus me-2"></i> Add New Hostel</button>
                            <button class="btn btn-outline-primary"><i class="fas fa-file-export me-2"></i> Generate
                                Report</button>
                            <button class="btn btn-outline-secondary"><i class="fas fa-cog me-2"></i> System
                                Settings</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="include/dash.js"></script>
</body>
</html>