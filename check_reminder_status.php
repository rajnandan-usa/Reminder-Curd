<?php
    include 'connect.php';

    $query = "SELECT reminder_status FROM client_reminder";
    $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                echo $row['reminder_status'];
            } else {
                echo 'No data found';
            }
        } else {
            echo 'Error: ' . mysqli_error($conn);
        }

    mysqli_close($conn);
?>
