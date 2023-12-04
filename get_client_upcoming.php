<?php
include 'connect.php';

$query = "SELECT id, name, phone, email, start_date, expiry_date_new FROM client_reminder WHERE expiry_date_hold IS NULL AND expiry_date_new != '' ";
$result = mysqli_query($conn, $query);

    if ($result) {
        $allData = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $allData[] = $row;
        }

        echo json_encode(['allData' => $allData]);
    } else {
        echo json_encode(['error' => 'Unable to fetch user data.']);
    }

mysqli_close($conn);
?>
