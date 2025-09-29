 <button id="sidebar-toggle">
        <i class="fas fa-bars"></i>
</button>
<div id="sidebar">
    <div class="sidebar-header d-flex">
        <img src="./media/img/delsu-logo.png" alt="">
        <!-- <h4><i class="fas fa-hotel me-2"></i> Hostel Manager</h4> -->
        <span>
            <p class="my">Hostel Manager</p>
            <p class="h3"> <?php echo $_SESSION['username']; ?>!</p>
        </span>
    </div>

    <div class="sidebar-menu">

        <!-- Dashboard -->
        <a href="dashboard.php" class="menu-item active">
            <div class="menu-icon"><i class="fas fa-home"></i></div>
            <div class="menu-text">Dashboard</div>
        </a>
        <div class="menu-category">Main</div>
        <a href="createsession.php" class="menu-item">
            <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
            <div class="menu-text">Add Sessions</div>
        </a>

        <a href="campusmgt.php" class="menu-item">
            <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
            <div class="menu-text">Add Campus</div>
        </a>

        <!-- Hostel Management -->
        <div class="menu-category">Hostel Management</div>
        <a href="createhostel.php" class="menu-item">
            <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
            <div class="menu-text">Add New Hostel</div>
        </a>
        <a href="viewhostel.php" class="menu-item">
            <div class="menu-icon"><i class="fas fa-plus-circle"></i></div>
            <div class="menu-text">Add Rooms</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-bed"></i></div>
            <div class="menu-text">Room/Bed Management</div>
        </a>

        <!-- Eligibility Rules -->
        <div class="menu-category">Eligibility Rules</div>
        <a href="eligiblity.php" class="menu-item">
            <div class="menu-icon"><i class="fas fa-plus-square"></i></div>
            <div class="menu-text">Create Eligibility Rule</div>
        </a>
        <a href="ho" class="menu-item">
            <div class="menu-icon"><i class="fas fa-tasks"></i></div>
            <div class="menu-text">Manage Eligibility Rules</div>
        </a>

        <!-- Reservations & Allocation -->
        <div class="menu-category">Reservations & Allocation</div>
        <a href="allocate" class="menu-item">
            <div class="menu-icon"><i class="fas fa-calendar-alt"></i></div>
            <div class="menu-text">View Reservations</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-check-circle"></i></div>
            <div class="menu-text">Dellocation/History</div>
        </a>

        <!-- Payments -->
        <div class="menu-category">Payments</div>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-credit-card"></i></div>
            <div class="menu-text">View Payments</div>
        </a>

        <!-- Student Management -->
        <!-- <div class="menu-category">Student Management</div>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-users"></i></div>
            <div class="menu-text">View Students</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-user-check"></i></div>
            <div class="menu-text">Verify Eligibility</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-user-slash"></i></div>
            <div class="menu-text">Restrict/Blacklist Student</div>
        </a> -->

        <!-- Reports & Analytics -->
        <!-- <div class="menu-category">Reports & Analytics</div>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-chart-pie"></i></div>
            <div class="menu-text">Hostel Occupancy Report</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-money-bill-wave"></i></div>
            <div class="menu-text">Financial Report</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-chart-line"></i></div>
            <div class="menu-text">Reservation Trends</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-file-export"></i></div>
            <div class="menu-text">Export Reports</div>
        </a> -->

        <!-- System Settings -->
        <div class="menu-category">System Settings</div>
        <a href="userrole.php" class="menu-item">
            <div class="menu-icon"><i class="fas fa-user-shield"></i></div>
            <div class="menu-text">Manage Admins</div>
        </a>
        <a href="#" class="menu-item">
            <div class="menu-icon"><i class="fas fa-cogs"></i></div>
            <div class="menu-text">General Settings</div>
        </a>
        <a href="rolepermits.php" class="menu-item">
            <div class="menu-icon"><i class="fas fa-user-lock"></i></div>
            <div class="menu-text">Roles & Permissions</div>
        </a>
    </div> 
    <div class="sidebar-footer">
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown">
                <img src="https://placehold.co/40x40" alt="Admin" width="32" height="32" class="rounded-circle me-2">
                <p class="admin-name"> <?php echo $_SESSION['username']; ?>!</p>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i>  Logout </a></li>
            </ul>
        </div>
    </div>
</div>