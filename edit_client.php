<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = isset($_POST['id']) ? $_POST['id'] : 0;
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $start_date = $_POST['start_date'];
    $expiry_date = $_POST['expiry_date'];
    $reminder_in = $_POST['reminder_in'];
    $price = $_POST['price'];
    $message = $_POST['message'];
    $status = $_POST['status'];
    $reminder_status = $_POST['reminder_status'];


    $uploadFile = '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        $previousFile = 'uploads/'; 
        if (file_exists($previousFile)) {
            unlink($previousFile);
        }
    
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo 'File is valid, and was successfully uploaded.';
        } else {
            echo 'Possible file upload attack!';
            exit;
        }
    }
    
    $fileUpdate = !empty($uploadFile) ? ", file = '$uploadFile'" : '';

    $query = "UPDATE client_reminder SET name = '$name', phone = '$phone', email = '$email', start_date = '$start_date',
    expiry_date = '$expiry_date', price = '$price',
    reminder_in = '$reminder_in', message = '$message', status = '$status', reminder_status = '$reminder_status', file = '$uploadFile' WHERE `id` = '".$userId."'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'User updated successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

    mysqli_close($conn);
?>
