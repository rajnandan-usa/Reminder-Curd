<?php
include 'connect.php';

$today = date('Y-m-d');

$query = "SELECT * FROM reminders";
$result = mysqli_query($conn, $query);

if ($result) {
    $expiryData = [
        'todayExpiry' => [],
        'tomorrowExpiry' => [],
        'thisWeekExpiry' => [],
        'nextWeekExpiry' => [],
        'upcomingExpiry' => [],
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        $servicesDates = json_decode($row['services_date'], true);

        if (in_array($today, $servicesDates)) {
            $expiryData['todayExpiry'][$row['id']] = $row;
        } if (in_array(date('Y-m-d', strtotime('tomorrow')), $servicesDates)) {
            $expiryData['tomorrowExpiry'][$row['id']] = $row;
        } if (date('Y-m-d', strtotime('monday this week')) <= $servicesDates[count($servicesDates) - 1] &&
                  date('Y-m-d', strtotime('sunday this week')) >= $servicesDates[0]) {
            $expiryData['thisWeekExpiry'][$row['id']] = $row;
        } if (date('Y-m-d', strtotime('monday next week')) <= $servicesDates[count($servicesDates) - 1] &&
                  date('Y-m-d', strtotime('sunday next week')) >= $servicesDates[0]) {
            $expiryData['nextWeekExpiry'][$row['id']] = $row;
        } if (end($servicesDates) > date('Y-m-d', strtotime('sunday next week'))) {
            $expiryData['upcomingExpiry'][$row['id']] = $row;
        }
    }
    var_dump($expiryData);
    echo json_encode($expiryData);
} else {
    echo json_encode(['error' => 'Unable to fetch user data.']);
}

mysqli_close($conn);
?>
