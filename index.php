<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>

<div class="container mt-5">
    <ul class="nav nav-tabs" id="listTabs">
        <li class="nav-item">
            <a class="nav-link active" id="list1-tab" data-toggle="tab" href="#list1">User</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="list2-tab" data-toggle="tab" href="#list2">Client</a>
        </li>
    </ul>

    <div class="tab-content mt-2">
        <!-- List 1 -->
        <div class="tab-pane fade show active" id="list1">
            <h4>List 1 Content</h4>
            <!-- Add button for List 1 -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal1">Add</button>
			<div class="container mt-5">
    <h2>Reminders Expiring Today</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="todayTable">
            <!-- Table content will be dynamically loaded by DataTables -->
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2>Reminders Expiring Tomorrow</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tomorrowTable">
            <!-- Table content will be dynamically loaded by DataTables -->
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2>Reminders Expiring This Week</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="thisWeekTable">
            <!-- Table content will be dynamically loaded by DataTables -->
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2>Reminders Expiring Next Week</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="nextWeekTable">
            <!-- Table content will be dynamically loaded by DataTables -->
        </tbody>
    </table>
</div>

<div class="container mt-5">
    <h2>Upcoming Reminders</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>Expiry Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="upcomingTable">
            <!-- Table content will be dynamically loaded by DataTables -->
        </tbody>
    </table>
</div>

        </div>

        <!-- List 2 -->
        <div class="tab-pane fade" id="list2">
            <h4>List 2 Content</h4>
            <!-- Add button for List 2 -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal2">Add</button>
			<div class="container mt-5">
				<h2>Bootstrap Table Example</h2>
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Email</th>
							<th>Role</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>John Doe</td>
							<td>johndoe@example.com</td>
							<td>Admin</td>
							<td>
								<button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal">Edit</button>
								<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#deleteModal">Delete</button>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Jane Smith</td>
							<td>janesmith@example.com</td>
							<td>User</td>
							<td>
								<button type="button" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#editModal">Edit</button>
								<button type="button" class="btn btn-danger btn-delete" data-toggle="modal" data-target="#deleteModal">Delete</button>
							</td>
						</tr>
						<!-- Add more rows as needed -->
					</tbody>
				</table>
			</div>
        </div>
    </div>
</div>
<div class="modal fade" id="addModal1" tabindex="-1" role="dialog" aria-labelledby="addModal1Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal1Label">Add Reminder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="addUserForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
					<div class="form-group">
						<label for="item2">Type:</label>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="type" id="type" value="EMI">
							<label class="form-check-label" for="type">EMI</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="type" id="type" value="AMC">
							<label class="form-check-label" for="type">AMC</label>
						</div>
						<div class="form-check">
							<input class="form-check-input" type="radio" name="type" id="type" value="LICENCE">
							<label class="form-check-label" for="type">LICENCE</label>
						</div>
					</div>
					<div id="dateInputs">
						<div class="form-row mb-2">
							<div class="col">
								<label for="services_date">Services Date:</label>
								<input type="date" name="services_date[]" class="form-control" />
							</div>
							<div class="col-auto">
								<button type="button" class="btn btn-danger btn-remove">Remove</button>
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-primary" id="addDateBtn">Add</button>

        			<button type="button" class="btn btn-primary" id="addDateBtn">Add</button>
					<div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" class="form-control" id="start_date">
                    </div>
					<div class="form-group">
                        <label for="expiry_date">Expiry Date:</label>
                        <input type="date" name="expiry_date" class="form-control" id="expiry_date">
                    </div>
					<div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" name="price" class="form-control" id="price">
                    </div>
					<div class="form-group">
                        <label for="contact_name">Contact Name:</label>
                        <input type="text" name="contact_name" class="form-control" id="contact_name">
                    </div>
					<div class="form-group">
                        <label for="contact_phone">Contact Phone:</label>
                        <input type="text" name="contact_phone" class="form-control" id="contact_phone">
                    </div>
					<div class="form-group">
                        <label for="helpline">HelpLine:</label>
                        <input type="text" name="helpline" class="form-control" id="helpline">
                    </div>
					<div class="form-group">
                        <label for="notes">Notes:</label>
                        <textarea type="text" name="notes" class="form-control" id="notes"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload File:</label>
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form method="post" id="editUserForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" name="name" class="form-control" id="editName">
                    </div>
                    <div class="form-group">
                        <label for="item2">Type:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="typeEMI" value="EMI">
                            <label class="form-check-label" for="typeEMI">EMI</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="typeAMC" value="AMC">
                            <label class="form-check-label" for="typeAMC">AMC</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="type" id="typeLicence" value="LICENCE">
                            <label class="form-check-label" for="typeLicence">LICENCE</label>
                        </div>
                    </div>
                    <div id="dateInputs">
                        <div class="form-row mb-2">
                            <div class="col">
                                <label for="services_date">Services Date:</label>
                                <input type="date" name="services_date[]" class="form-control" />
                            </div>
                            <div class="col-auto">
                                <button type="button" class="btn btn-danger btn-remove">Remove</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addDateBtn">Add</button>

                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" class="form-control" id="startDate">
                    </div>
                    <div class="form-group">
                        <label for="expiry_date">Expiry Date:</label>
                        <input type="date" name="expiry_date" class="form-control" id="expiryDate">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" name="price" class="form-control" id="editPrice">
                    </div>
                    <div class="form-group">
                        <label for="contact_name">Contact Name:</label>
                        <input type="text" name="contact_name" class="form-control" id="contactName">
                    </div>
                    <div class="form-group">
                        <label for="contact_phone">Contact Phone:</label>
                        <input type="text" name="contact_phone" class="form-control" id="contactPhone">
                    </div>
                    <div class="form-group">
                        <label for="helpline">HelpLine:</label>
                        <input type="text" name="helpline" class="form-control" id="editHelpline">
                    </div>
                    <div class="form-group">
                        <label for="notes">Notes:</label>
                        <textarea type="text" name="notes" class="form-control" id="editNotes"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="file">Upload File:</label>
                        <input type="file" name="file" class="form-control" id="file">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Add Item</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Delete confirmation content goes here -->
            </div>
        </div>
    </div>
</div>

<!-- Similar modals for List 2, List 3, and List 4 -->
<!-- Modify the modal content and form fields as needed -->

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
<script src="main.js"></script>
<script>
$(document).ready(function () {
    // Your existing code...

    // Add button click event to dynamically add date input
    $('#addDateBtn').on('click', function () {
        var newDateInput = $('<div class="form-row mb-2">' +
            '<div class="col">' +
            '<label for="services_date">Services Date:</label>' +
            '<input type="date" name="services_date[]" class="form-control" />' +
            '</div>' +
            '<div class="col-auto">' +
            '<button type="button" class="btn btn-danger btn-remove">Remove</button>' +
            '</div>' +
            '</div>');

        $('#dateInputs').append(newDateInput);
    });

    // Remove button click event to dynamically remove date input
    $('#dateInputs').on('click', '.btn-remove', function () {
        $(this).closest('.form-row').remove();
    });

    // Your existing code...
});


    </script>
</body>
</html>
