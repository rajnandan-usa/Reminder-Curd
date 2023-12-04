<?php
// Include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userId = $_GET['id'];

    // Output HTML content for the delete confirmation modal
    echo '<p>Are you sure you want to delete the reminder with ID: ' . $userId . '?</p>';
    echo '<button type="button" class="btn btn-danger" id="confirmDelete" data-id="' . $userId . '">Delete</button>';
    echo '<button type="button" style="margin-left:5px;" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
}
?>
