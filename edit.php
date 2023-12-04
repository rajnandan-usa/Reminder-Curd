<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = isset($_POST['id']) ? $_POST['id'] : 0;
    $name = $_POST['name'];
    $type = $_POST['type'];
    $services_dates = $_POST['services_date'];
    $services_date_end = isset($_POST['services_date_end']) ? $_POST['services_date_end'] : NULL;
    print_r($services_date_end);
    $start_date = $_POST['start_date'];
    $expiry_date = $_POST['expiry_date'];
    $price = $_POST['price'];
    $contact_name = $_POST['contact_name'];
    $contact_phone = $_POST['contact_phone'];
    $helpline = $_POST['helpline'];
    $notes = $_POST['notes'];

    if (is_array($services_dates) && !empty($services_dates)) {
        $serialized_dates = json_encode($services_dates);
    } else {
        $serialized_dates = null;
    }

    // Convert the array to a JSON string
    if (is_array($services_date_end)) {
        $services_date_end = json_encode($services_date_end);
    }

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
    

    $query = "UPDATE reminders SET name = ?, type = ?, services_date = ?, start_date = ?,
    expiry_date = ?, price = ?,
    contact_name = ?, contact_phone = ?, helpline = ?, notes = ?, services_date_end = ? $fileUpdate WHERE `id` = ?";

    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssssssssssi", $name, $type, $serialized_dates, $start_date, $expiry_date, $price, $contact_name, $contact_phone, $helpline, $notes, $services_date_end, $userId);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo 'User updated successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}

    mysqli_close($conn);

?>
