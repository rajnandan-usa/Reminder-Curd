<?php
include 'connect.php';

$today = date('Y-m-d');
$thisWeekStart = date('Y-m-d', strtotime('monday this week'));
$thisWeekEnd = date('Y-m-d', strtotime('sunday this week'));
$nextWeekStart = date('Y-m-d', strtotime('monday next week'));
$nextWeekEnd = date('Y-m-d', strtotime('sunday next week'));

$query = "SELECT id, name, email, phone, start_date, expiry_date FROM client_reminder WHERE new_copy IS NULL AND expiry_date_hold IS NULL AND status = 'Y'";
$result = mysqli_query($conn, $query);

if ($result) {
    $todayExpiry = [];
    $tomorrowExpiry = [];
    $thisWeekExpiry = [];
    $nextWeekExpiry = [];
    $upcomingExpiry = [];
    $overDuesItems = [];
    $todayDate = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime($today . ' +1 day'));

    while ($row = mysqli_fetch_assoc($result)) {
        $expiryDate = $row['expiry_date'];

        if ($expiryDate == $todayDate) {
            $todayExpiry[] = $row;
        } 
        if ($expiryDate == $tomorrow) {
            $tomorrowExpiry[] = $row;
        } 
        if ($thisWeekStart <= $expiryDate && $expiryDate <= $thisWeekEnd) {
            $thisWeekExpiry[] = $row;
        } 
        if ($expiryDate >= $nextWeekStart && $expiryDate <= $nextWeekEnd) {
            $nextWeekExpiry[] = $row;
        } 
        if ($expiryDate < $today) {
            $overDuesItems[] = $row;
        }
        if ($nextWeekEnd < $expiryDate) {
            $upcomingExpiry[] = $row;
        }
    }

    echo json_encode([
        'overDuesItems' => $overDuesItems,
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
