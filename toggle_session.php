<?php
session_start();
include 'include/db_connect.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'superadmin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_status'])) {
    $session_id = $conn->real_escape_string($_POST['session_id']);
    
    // Get current status
    $check_sql = "SELECT status FROM sessions WHERE id='$session_id'";
    $result = $conn->query($check_sql);
    
    if ($result !== false && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $new_status = ($row['status'] == 'active') ? 'inactive' : 'active';
        
        // If activating this session, deactivate all others
        if ($new_status == 'active') {
            $deactivate_sql = "UPDATE sessions SET status='inactive', updated_at=NOW() WHERE id != '$session_id'";
            $conn->query($deactivate_sql);
        }
        
        $sql = "UPDATE sessions SET status='$new_status', updated_at=NOW() WHERE id='$session_id'";
        
        if ($conn->query($sql)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Session not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>