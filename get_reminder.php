<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $userId = $_GET['id'];

    $query = "SELECT * FROM reminders WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $userId);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if ($row) {
            echo json_encode($row);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    } else {
        echo json_encode(['error' => 'Error executing statement']);
    }
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
