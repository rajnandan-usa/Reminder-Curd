<?php
include 'connect.php';

    $query = "SELECT id, name, phone, email, start_date, expiry_date_new FROM client_reminder WHERE new_copy = 'Y' ";
    $result = mysqli_query($conn, $query);

        if ($result) {
            $completeClient = [];
            $todayDate = new DateTime();

            while ($row = mysqli_fetch_assoc($result)) {
                $completeClient[] = $row;
            }

            echo json_encode([
                'completeClient' => $completeClient,
                
                
            ]);
        } else {
            echo json_encode([
                'error' => 'Unable to fetch user data.',
                'mysqli_error' => mysqli_error($conn)
            ]);
        }

    mysqli_close($conn);
?>
