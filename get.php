<?php
include 'connect.php';

// Get today's date
$today = date('Y-m-d');

$thisWeekStart = date('Y-m-d', strtotime('monday this week'));
$thisWeekEnd = date('Y-m-d', strtotime('sunday this week'));
$nextWeekStart = date('Y-m-d', strtotime('monday next week'));
$nextWeekEnd = date('Y-m-d', strtotime('sunday next week'));

$query = "SELECT * FROM reminders";
$result = mysqli_query($conn, $query);

if ($result) {
    $todayExpiry = [];
    $tomorrowExpiry = [];
    $thisWeekExpiry = [];
    $nextWeekExpiry = [];
    $upcomingExpiry = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $expiryDate = $row['expiry_date'];

        if ($expiryDate == $today) {
            $todayExpiry[] = $row;
        } elseif ($expiryDate == date('Y-m-d', strtotime('tomorrow'))) {
            $tomorrowExpiry[] = $row;
        } elseif ($expiryDate >= $thisWeekStart && $expiryDate <= $thisWeekEnd) {
            $thisWeekExpiry[] = $row;
        } elseif ($expiryDate >= $nextWeekStart && $expiryDate <= $nextWeekEnd) {
            $nextWeekExpiry[] = $row;
        } elseif ($expiryDate > $nextWeekEnd) {
            $upcomingExpiry[] = $row;
        }
    }

    echo json_encode([
        'todayExpiry' => $todayExpiry,
        'tomorrowExpiry' => $tomorrowExpiry,
        'thisWeekExpiry' => $thisWeekExpiry,
        'nextWeekExpiry' => $nextWeekExpiry,
        'upcomingExpiry' => $upcomingExpiry,
    ]);
} else {
    echo json_encode(['error' => 'Unable to fetch user data.']);
}

mysqli_close($conn);
?>
