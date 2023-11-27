<?php
// Include 'connect.php' and any necessary logic

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $userId = $_GET['id'];

    // Fetch user details from the database based on $userId
    // Assuming $userDetails contains the details of the user to be deleted

    // Output HTML content for the delete confirmation modal
    echo '<p>Are you sure you want to delete the user with ID: ' . $userId . '?</p>';
    echo '<button type="button" class="btn btn-danger" id="confirmDelete" data-id="' . $userId . '">Delete</button>';
    echo '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
}
?>
