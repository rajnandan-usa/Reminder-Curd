<?php
include 'connect.php';

// Get today's date
$today = date('Y-m-d');

$thisWeekStart = date('Y-m-d', strtotime('monday this week'));
$thisWeekEnd = date('Y-m-d', strtotime('sunday this week'));
$nextWeekStart = date('Y-m-d', strtotime('monday next week'));
$nextWeekEnd = date('Y-m-d', strtotime('sunday next week'));

$query = "SELECT * FROM reminders WHERE services_date_end != 'NULL'";

$result = mysqli_query($conn, $query);

if ($result->num_rows > 0) {
    $completeTable = [];

    while ($row = mysqli_fetch_assoc($result)) {
        // $expiryDate = $row['expiry_date'];
        $servicesDatesEnd = json_decode($row['services_date_end'], true) ?? [];

        // Check if the current record matches any of the conditions
        // $matchesCondition = false;

        // if ($expiryDate == $today ||
        //     $expiryDate == date('Y-m-d', strtotime('tomorrow')) ||
        //     ($expiryDate >= $thisWeekStart && $expiryDate <= $thisWeekEnd) ||
        //     ($expiryDate >= $nextWeekStart && $expiryDate <= $nextWeekEnd) ||
        //     ($expiryDate > $nextWeekEnd && $expiryDate <= $thisWeekEnd) ||
        //     $expiryDate < $today) {
        //     $matchesCondition = true;
        // }

        // if (!$matchesCondition && !empty($servicesDatesEnd)) {
        //     foreach ($servicesDatesEnd as $date) {
        //         if ($date != null) {
        //             $matchesCondition = true;
        //             break;
        //         }
        //     }
        // }

        
            $completeTable[] = $row;
        
    }

    // Output the complete table
    echo json_encode([
        'completeTable' => $completeTable,
    ]);
} else {
    echo json_encode(['error' => 'Unable to fetch user data.']);
}

mysqli_close($conn);
?>
