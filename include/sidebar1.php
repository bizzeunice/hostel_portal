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
            <div class="menu-icon"><i class="fas fa-bed"></i></div>
            <div class="menu-text">Manage Hostel</div>
        </a>


        <!-- Hostel Management -->
        

        <!-- Eligibility Rules -->




        <!-- System Settings -->

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