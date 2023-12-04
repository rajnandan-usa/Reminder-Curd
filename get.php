<?php
include 'connect.php';

$query = "SELECT * FROM reminders";

$result = mysqli_query($conn, $query);

if ($result) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $upcomingDates = [];
    $overdueDates = [];
    $todayDates = [];
    $tomorrowDates = [];
    $thisWeekDates = [];
    $nextWeekDates = [];
    $thisWeekStart = date('Y-m-d', strtotime('monday this week'));
    $thisWeekEnd = date('Y-m-d', strtotime('sunday this week'));
    $nextWeekStart = date('Y-m-d', strtotime('monday next week'));
    $nextWeekEnd = date('Y-m-d', strtotime('sunday next week'));

    foreach ($rows as $row) {
        $id = $row['id'];
        $type = $row['type'];
        $name = $row['name'];
        $contact_phone = $row['contact_phone'];
        $start_date = $row['start_date'];
        $expiry_date = $row['expiry_date'];
        $file = $row['file'];

        $services_dates = json_decode($row['services_date']);
        $services_dates_end = json_decode($row['services_date_end']);
        $services_dates_remove = array_diff($services_dates, $services_dates_end ?? []);

        $currentDate = date('Y-m-d');

        foreach ($services_dates_remove as $service_date) {
            $formattedDate = date('Y-m-d', strtotime($service_date));

            if ($formattedDate < $currentDate) {

                if (isset($overdueDates[$id])) {
                    $overdueDates[$id]['dates'][] = $formattedDate;
                } else {
                    $overdueDates[$id] = [
                        "id" => $id,
                        "name" => $name,
                        "contact_phone" => $contact_phone,
                        "type" => $type,
                        "start_date" => $start_date,
                        "expiry_date" => $expiry_date,
                        "file" => $file,
                        "dates" => [$formattedDate]
                    ];
                }

            } elseif ($formattedDate == $currentDate) {

                if (isset($todayDates[$id])) {
                    $todayDates[$id]['dates'][] = $formattedDate;
                } else {
                    $todayDates[$id] = [
                        "id" => $id,
                        "name" => $name,
                        "contact_phone" => $contact_phone,
                        "type" => $type,
                        "start_date" => $start_date,
                        "expiry_date" => $expiry_date,
                        "file" => $file,
                        "dates" => [$formattedDate]
                    ];
                }
            } if ($formattedDate == date('Y-m-d', strtotime($currentDate . ' +1 day'))) {
                if (isset($tomorrowDates[$id])) {
                    $tomorrowDates[$id]['dates'][] = $formattedDate;
                } else {
                    $tomorrowDates[$id] = [
                        "id" => $id,
                        "name" => $name,
                        "contact_phone" => $contact_phone,
                        "type" => $type,
                        "start_date" => $start_date,
                        "expiry_date" => $expiry_date,
                        "file" => $file,
                        "dates" => [$formattedDate]
                    ];
                }

            } if ($formattedDate <= $thisWeekStart = date('Y-m-d', strtotime('monday this week')) && $formattedDate <= $thisWeekEnd = date('Y-m-d', strtotime('sunday this week'))) {
                if (isset($thisWeekDates[$id])) {
                    $thisWeekDates[$id]['dates'][] = $formattedDate;
                } else {
                    $thisWeekDates[$id] = [
                        "id" => $id,
                        "name" => $name,
                        "contact_phone" => $contact_phone,
                        "type" => $type,
                        "start_date" => $start_date,
                        "expiry_date" => $expiry_date,
                        "file" => $file,
                        "dates" => [$formattedDate]
                    ];
                }
            } if ($formattedDate > $nextWeekStart && $formattedDate <= $nextWeekEnd) {
                if (isset($nextWeekDates[$id])) {
                    $nextWeekDates[$id]['dates'][] = $formattedDate;
                } else {
                    $nextWeekDates[$id] = [
                        "id" => $id,
                        "name" => $name,
                        "contact_phone" => $contact_phone,
                        "type" => $type,
                        "start_date" => $start_date,
                        "expiry_date" => $expiry_date,
                        "file" => $file,
                        "dates" => [$formattedDate]
                    ];
                }
            } else {
                if (isset($upcomingDates[$id])) {
                    $upcomingDates[$id]['dates'][] = $formattedDate;
                } else {
                    $upcomingDates[$id] = [
                        "id" => $id,
                        "name" => $name,
                        "contact_phone" => $contact_phone,
                        "type" => $type,
                        "start_date" => $start_date,
                        "expiry_date" => $expiry_date,
                        "file" => $file,
                        "dates" => [$formattedDate]
                    ];
                }
            }
        }
    }

    echo json_encode([
        'upcomingDates' => $upcomingDates,
        'overdueDates' => $overdueDates,
        'todayDates' => $todayDates,
        'tomorrowDates' => $tomorrowDates,
        'thisWeekDates' => $thisWeekDates,
        'nextWeekDates' => $nextWeekDates
    ]);
} else {
    echo json_encode(['error' => mysqli_error($conn)]);
}

mysqli_close($conn);
?>
