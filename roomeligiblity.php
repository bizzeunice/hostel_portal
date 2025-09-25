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
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
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
                <h2>Create Eligibility Rules</h2>
                <p class="mb-0">Add all hostel and room eligibility rules</p>
            </div>
            <span>
                <a href="dashboard.php" class="btn btn-light"><i class="fas fa-arrow-left"></i> &nbsp; Go back to
                    Dashboard</a>
            </span>
        </div>

        <div class="container-fluid">
            <ul class="nav nav-tabs" id="eligibilityTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="hostel-tab" data-bs-toggle="tab" data-bs-target="#hostel-rules"
                        type="button" role="tab" aria-controls="hostel-rules" aria-selected="true">
                        <i class="fas fa-building me-1"></i> Room Eligibility Rules
                    </button>
                </li>

                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content bg-white" id="eligibilityTabContent">
                <!-- Hostel Eligibility Rules Tab -->
                <div class="tab-pane fade show active " id="hostel-rules" role="tabpanel" aria-labelledby="hostel-tab">
                    <!-- Create New Hostel Rule Form -->
                    <div class="form-section">
                        <h4><i class="fas fa-plus-circle me-2"></i>Create New Room Eligibility Rule</h4>
                        <form id="roomRuleForm">
                            <div class="row mb-3">

                                <div class="col-md-6">
                                    <label class="form-label">Applicable Hostel</label>
                                    <select class="form-select" name="hostel_id">
                                        <option value="">All Hostels</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Target Room Number</label>
                                            <select class="form-select" required name="room_id">
                                                <option value="">Select Room Number</option>

                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Target Room Number</label>
                                            <select class="form-select" required name="room_id">
                                                <option value="">Select Room Number</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>



                            <div class="criteria-card">
                                <h5 class="mb-3">Eligibility Criteria</h5>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Gender</label>
                                        <select class="form-select">
                                            <option value="">Any Gender</option>
                                            <option value="male">Male Only</option>
                                            <option value="female">Female Only</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Programme</label>
                                        <select class="form-select" name="programme_id">
                                            <option value="">Any Programme</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Levels</label>
                                        <select class="selectpicker form-control" name="level_id" multiple data-live-search="true"
                                            title="Select levels...">
                                            <option value="100">100 Level</option>
                                            <option value="200">200 Level</option>
                                            <option value="300">300 Level</option>
                                            <option value="400">400 Level</option>
                                            <option value="500">500 Level</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Faculty</label>
                                        <select class="selectpicker form-control" name="faculty_id" multiple data-live-search="true"
                                            title="Select faculties...">
                                            <option value="science">Faculty of Science</option>
                                            <option value="engineering">Faculty of Engineering</option>
                                            <option value="arts">Faculty of Arts</option>
                                            <option value="medicine">Faculty of Medicine</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Department</label>
                                        <select class="selectpicker form-control" name="department_id" multiple data-live-search="true"
                                            title="Select departments...">
                                            <option value="computer-sci">Computer Science</option>
                                            <option value="electrical">Electrical Engineering</option>
                                            <option value="mechanical">Mechanical Engineering</option>
                                            <option value="biology">Biology</option>
                                            <option value="chemistry">Chemistry</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="roomFeeCheck">
                                    <label class="form-check-label" for="roomFeeCheck">
                                        Must have paid all school fees
                                    </label>
                                </div>

                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="academicStandingCheck">
                                    <label class="form-check-label" for="academicStandingCheck">
                                        Good academic standing required
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-secondary me-2">Reset</button>
                                <button type="submit" class="btn btn-primary">Create Room Rule</button>
                            </div>
                        </form>
                    </div>

                    <!-- Existing Hostel Rules Section -->
                    <div class="form-section">
                        <h4><i class="fas fa-list me-2"></i>Existing Room Eligibility Rules</h4>
                        <p class="text-muted">Manage your current room eligibility rules</p>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    <input type="text" class="form-control" placeholder="Search room rules...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">All Room Types</option>
                                    <option value="single">Single Room</option>
                                    <option value="double">Double Room</option>
                                    <option value="4-man">4-Man Room</option>
                                    <option value="6-man">6-Man Room</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-select">
                                    <option value="">All Status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Room Rule Cards -->
                        <div class="rule-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5>Single Room - High Achievers</h5>
                                    <div class="mb-2">
                                        <span class="badge badge-active">Active</span>
                                        <span class="text-muted">Created: 20 Aug 2023</span>
                                    </div>
                                    <div class="criteria-list">
                                        <span class="badge criteria-badge">GPA: 4.0+</span>
                                        <span class="badge criteria-badge">Levels: 300,400,500</span>
                                        <span class="badge criteria-badge">Good Academic Standing</span>
                                    </div>
                                </div>
                                <div class="action-buttons">
                                    <div class="rule-status">
                                        <span class="me-2">Active</span>
                                        <label class="switch">
                                            <input type="checkbox" checked>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i>
                                        Edit</button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                        Delete</button>
                                </div>
                            </div>
                        </div>

                        <div class="rule-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h5>Postgraduate Rooms</h5>
                                    <div class="mb-2">
                                        <span class="badge badge-active">Active</span>
                                        <span class="text-muted">Created: 18 Aug 2023</span>
                                    </div>
                                    <div class="criteria-list">
                                        <span class="badge criteria-badge">Programme: Postgraduate</span>
                                        <span class="badge criteria-badge">GPA: 3.5+</span>
                                        <span class="badge criteria-badge">Fees: Must be paid</span>
                                    </div>
                                </div>
                                <div class="action-buttons">
                                    <div class="rule-status">
                                        <span class="me-2">Active</span>
                                        <label class="switch">
                                            <input type="checkbox" checked>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i>
                                        Edit</button>
                                    <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i>
                                        Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Room Eligibility Rules Tab -->
                <div class="tab-pane fade" id="room-rules" role="tabpanel" aria-labelledby="room-tab">
                    <!-- Create New Room Rule Form -->


                    <!-- Existing Room Rules Section -->

                </div>
            </div>

        </div>


    </div>

    <!-- Edit Campus Modal -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script src="include/dash.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Bootstrap Select
            $('.selectpicker').selectpicker();

            // Hostel Rule Form submission
            const hostelRuleForm = document.getElementById('hostelRuleForm');
            hostelRuleForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Show processing state
                const submitBtn = hostelRuleForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...';
                submitBtn.disabled = true;

                // Simulate rule creation process
                setTimeout(function () {
                    alert('Hostel eligibility rule created successfully!');
                    submitBtn.innerHTML = 'Create Hostel Rule';
                    submitBtn.disabled = false;
                    hostelRuleForm.reset();
                    $('.selectpicker').selectpicker('refresh');
                }, 2000);
            });

            // Room Rule Form submission
            const roomRuleForm = document.getElementById('roomRuleForm');
            roomRuleForm.addEventListener('submit', function (e) {
                e.preventDefault();

                // Show processing state
                const submitBtn = roomRuleForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Creating...';
                submitBtn.disabled = true;

                // Simulate rule creation process
                setTimeout(function () {
                    alert('Room eligibility rule created successfully!');
                    submitBtn.innerHTML = 'Create Room Rule';
                    submitBtn.disabled = false;
                    roomRuleForm.reset();
                    $('.selectpicker').selectpicker('refresh');
                }, 2000);
            });

            // Toggle switch functionality
            const toggleSwitches = document.querySelectorAll('.switch input');
            toggleSwitches.forEach(toggle => {
                toggle.addEventListener('change', function () {
                    const statusText = this.parentElement.parentElement.querySelector('span:first-child');
                    if (this.checked) {
                        statusText.textContent = 'Active';
                        statusText.classList.remove('text-muted');
                    } else {
                        statusText.textContent = 'Inactive';
                        statusText.classList.add('text-muted');
                    }
                });
            });

            // Delete button functionality
            const deleteButtons = document.querySelectorAll('.btn-outline-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const ruleName = this.closest('.rule-card').querySelector('h5').textContent;
                    if (confirm(`Are you sure you want to delete the rule "${ruleName}"?`)) {
                        // Simulate deletion
                        this.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
                        setTimeout(() => {
                            this.closest('.rule-card').style.opacity = '0';
                            setTimeout(() => {
                                this.closest('.rule-card').remove();
                            }, 500);
                        }, 1500);
                    }
                });
            });
        });
    </script>
</body>

</html>