<?php
include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $start_date = $_POST['start_date'];
        $expiry_date = $_POST['expiry_date'];
        $reminder_in = $_POST['reminder_in'];
        $price = $_POST['price'];
        $message = $_POST['message'];
        $status = $_POST['status'];


            // Handle file upload
            $uploadDir = 'uploads/';
            $uploadFile = $uploadDir . basename($_FILES['file']['name']);
        
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                echo 'File is valid, and was successfully uploaded.';
            } else {
                echo 'Possible file upload attack!';
            }

            $query = "INSERT INTO client_reminder (name,phone,email, start_date, expiry_date, reminder_in, price, message, file,status)
            VALUES ('$name','$phone','$email', '$start_date', '$expiry_date', '$reminder_in', '$price', '$message', '$uploadFile','$status')";
            $result = mysqli_query($conn, $query);

        if ($result) {
            echo 'Client Reminder added successfully';
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }
    }

        mysqli_close($conn);
?>
