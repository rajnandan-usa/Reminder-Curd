<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = $_POST['id'];
    $query = "DELETE FROM client_reminder WHERE id = $userId";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'User deleted successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
