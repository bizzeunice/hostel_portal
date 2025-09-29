
<?php
session_start();
include 'include/db_connect.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password_hash'];

    if (!empty($username) && !empty($password)) {
        // Check if user exists and has admin privileges
        $sql = "SELECT u.*, r.name as role_name
                FROM users u
                INNER JOIN roles r ON u.role_id = r.id
                WHERE u.username = ? AND r.name IN ('superadmin', 'admin', 'staff') AND u.status = 'active'";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify password (assuming you're using password_hash())
            if (password_verify($password, $user['password_hash'])) {
                // Login successful
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role_name'];
                $_SESSION['email'] = $user['email'];
                
                // Update last login time
                $update_sql = "UPDATE users SET last_login_at = NOW() WHERE id = ?";
                $update_stmt = $conn->prepare($update_sql);
                $update_stmt->bind_param("i", $user['id']);
                $update_stmt->execute();
                
                // Redirect to dashboard
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Invalid username or password!";
            }
        } else {
            $error = "Invalid username or you don't have admin privileges!";
        }
        
        $stmt->close();
    } else {
        $error = "Please fill in all fields!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELSU Hostel Portal - Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="include/login.css">
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-logo">
                <img src="./media/img/delsu-logo.png" alt="">
            </div>
            <h2>DELSU Hostel Admin Portal</h2>
            <p>Administrative access to hostel management system</p>


            <div class="login-features">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>Secure Admin Authentication</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-bed"></i>
                    </div>
                    <div>Room Allocation Management</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div>Occupancy Reports & Analytics</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <div>System Configuration</div>
                </div>
            </div>
        </div>

        <div class="login-right">
            <div class="login-header">
                <span class="badge">Restricted Access</span>
                <h2>Administrator Login</h2>
                <p>Enter your credentials to access the admin dashboard</p>
            </div>
            <?php if (!empty($error)): ?>
            <div class="error alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
            <!-- Admin login form -->
            <form id="adminLoginForm" method="POST" novalidate>
                <div class="form-group">
                    <i class="fas fa-user-circle form-icon"></i>
                    <input type="text" class="form-control" placeholder="Admin ID" name="username" required>
                </div>

                <div class="form-group">
                    <i class="fas fa-lock form-icon"></i>
                    <input type="password" class="form-control" placeholder="Password" name="password_hash"
                        id="adminPassword" required>
                </div>

                <div class="login-options">
                    <a href="forgot_password.php" class="forgot-link">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Secure Login</button>

                <!-- Two-factor authentication UI removed until backend integration is implemented -->
            </form>

            <div class="security-notice">
                <h6><i class="fas fa-info-circle me-2"></i>Security Notice</h6>
                <p class="mb-0">This system is restricted to authorized personnel only. Any unauthorized access attempts
                    may be subject to prosecution.</p>
            </div>

            <div class="login-footer">
                <p>Ensure you are logging in from a secure network</p>
                <p>© 2023 DELSU Hostel Management System. Admin Portal v2.4</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const adminLoginForm = document.getElementById('adminLoginForm');
            // Two-factor authentication UI and logic removed until backend integration is implemented

            adminLoginForm.addEventListener('submit', function (e) {
                // Allow normal form submission to PHP backend
            });

            function showError(message) {
                // Create error notification
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger position-fixed';
                alert.style.top = '20px';
                alert.style.right = '20px';
                alert.style.zIndex = '1050';
                alert.style.minWidth = '300px';
                alert.innerHTML = `
                    <strong><i class="fas fa-exclamation-circle me-2"></i>Error:</strong> ${message}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
                `;

                document.body.appendChild(alert);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 5000);
            }

            function showSuccess(message) {
                // Create success notification
                const alert = document.createElement('div');
                alert.className = 'alert alert-success position-fixed';
                alert.style.top = '20px';
                alert.style.right = '20px';
                alert.style.zIndex = '1050';
                alert.style.minWidth = '300px';
                alert.innerHTML = `
                    <strong><i class="fas fa-check-circle me-2"></i>Success:</strong> ${message}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
                `;

                document.body.appendChild(alert);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (alert.parentNode) {
                        alert.parentNode.removeChild(alert);
                    }
                }, 5000);
            }
        });
    </script>
</body>

</html>