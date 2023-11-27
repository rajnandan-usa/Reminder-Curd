<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userId = isset($_POST['id']) ? $_POST['id'] : 0;
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

    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            echo 'File is valid, and was successfully uploaded.';
        } else {
            echo 'Possible file upload attack!';
            exit; // Exit the script if there's an issue with file upload
        }
    } else {
        $uploadFile = ''; // Set to an empty string if no file was uploaded
    }

    $query = "UPDATE reminders SET name = '$name', type = '$type', services_date = '$serialized_dates', start_date = '$start_date',
    expiry_date = '$expiry_date', price = '$price',
    contact_name = '$contact_name', contact_phone = '$contact_phone', helpline = '$helpline', notes = '$notes', file = '$uploadFile' WHERE `id` = '".$userId."'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo 'User updated successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
