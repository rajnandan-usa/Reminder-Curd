<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $services_dates = $_POST['services_date'];
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

        // Handle file upload
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);
    
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo 'File is valid, and was successfully uploaded.';
        } else {
            $uploadFile = '';
        }

        $query = "INSERT INTO reminders (name, type, services_date, start_date, expiry_date, price, contact_name, contact_phone, helpline, notes, file)
        VALUES ('$name', '$type', '$serialized_dates', '$start_date', '$expiry_date', '$price', '$contact_name', '$contact_phone', '$helpline', '$notes', '$uploadFile')";
       $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'User added successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
