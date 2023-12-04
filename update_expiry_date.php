<?php
include('connect.php');

$yourConnectionVariable = $conn;

function updateExpiryDate($conn) {
    try {
        $currentDate = new DateTime();

        $selectSql = "SELECT id, name, phone, email, start_date, expiry_date, expiry_date_new, reminder_in, price, message, file, status,reminder_status FROM client_reminder WHERE expiry_date < ? AND reminder_status = 'Y'";
        $selectStmt = $conn->prepare($selectSql);
        $selectStmt->bind_param('s', $currentDate->format('Y-m-d'));
        $selectStmt->execute();
        
        $result = $selectStmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $existingExpiryDate = (isset($row['expiry_date_new'])) ? $row['expiry_date_new'] : $row['expiry_date'];
                                    
            if (!isset($row['expiry_date_new']) || (new DateTime($existingExpiryDate))->add(new DateInterval('P1M')) < $currentDate) {
                $newExpiryDate = $currentDate->add(new DateInterval('P1M'))->format('Y-m-d');

                $newCopyValue = 'Y';
                $insertSql = "INSERT INTO client_reminder (name, phone, email, start_date, expiry_date, expiry_date_new, reminder_in, price, message, file, status, reminder_status, new_copy) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $insertStmt = $conn->prepare($insertSql);
                $insertStmt->bind_param('sssssssssssss', $row['name'], $row['phone'], $row['email'], $row['start_date'], $row['expiry_date'], $newExpiryDate, $row['reminder_in'], $row['price'], $row['message'], $row['file'], $row['status'], $row['reminder_status'], $newCopyValue);
                $insertStmt->execute();

                $updateSql = "UPDATE client_reminder SET expiry_date_new = ?, expiry_date_hold = 'Y' WHERE id = ?";
                $updateStmt = $conn->prepare($updateSql);
                $updateStmt->bind_param('si', $newExpiryDate, $row['id']);
                $updateStmt->execute();
            }
        }

        $selectStmt->close();
    } catch (mysqli_sql_exception $e) {
        error_log("Error: " . $e->getMessage(), 0);
        echo "Error: " . $e->getMessage();
    }
}
updateExpiryDate($yourConnectionVariable);
?>
