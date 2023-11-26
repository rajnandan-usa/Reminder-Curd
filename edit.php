<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize the user ID to prevent SQL injection
    $userId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $services_dates = isset($_POST['services_date']) ? $_POST['services_date'] : [];
    $start_date = isset($_POST['start_date']) ? $_POST['start_date'] : '';
    $expiry_date = isset($_POST['expiry_date']) ? $_POST['expiry_date'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $contact_name = isset($_POST['contact_name']) ? $_POST['contact_name'] : '';
    $contact_phone = isset($_POST['contact_phone']) ? $_POST['contact_phone'] : '';
    $helpline = isset($_POST['helpline']) ? $_POST['helpline'] : '';
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

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

    // Use prepared statement to prevent SQL injection
    $query = "UPDATE reminders SET name=?, type=?, services_date=?, start_date=?, expiry_date=?, price=?,
    contact_name=?, contact_phone=?, helpline=?, notes=?, file=? WHERE id=?";
    
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sssssssssssi', $name, $type, $serialized_dates, $start_date, $expiry_date, $price, $contact_name, $contact_phone, $helpline, $notes, $uploadFile, $userId);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo 'User updated successfully';
    } else {
        echo 'Error: ' . mysqli_stmt_error($stmt);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
?>
