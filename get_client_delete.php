<?php
// Include 'connect.php' and any necessary logic

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userId = $_GET['id'];
    
    echo '<p>Are you sure you want to delete the reminder with ID: ' . $userId . '?</p>';
    echo '<button type="button" class="btn btn-danger" id="confirmDelete" data-id="' . $userId . '">Delete</button>';
    echo '<button type="button" style="margin-left:5px;" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
}
?>
