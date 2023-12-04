<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reminder System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        .blink-red {
            animation: blink 1s infinite;
            color: red;
        }

        .btn-delete {
            margin-left: 5px;
        }

        .btn-delete1 {
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <!---tab---->
    <div class="container mt-5">
        <ul class="nav nav-tabs" id="listTabs">
            <li class="nav-item">
                <a class="nav-link active" id="list1-tab" data-toggle="tab" href="#list1">Personal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="list3-tab" data-toggle="tab" href="#list3">Complete Reminder</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="list2-tab" data-toggle="tab" href="#list2">Client</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="list4-tab" data-toggle="tab" href="#list4">Complete Reminder</a>
            </li>
        </ul>
        <!---table---->
        <div class="tab-content mt-2">
            <!-- List 1 -->
            <div class="tab-pane fade show active" id="list1">
                <h4>Personal Reminder List</h4>
                <!-- Add button for List 1 -->
                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#dateInputs').empty();" data-target="#addModal1"><i class="fas fa-bell"></i> Add Reminder</button>
                <!--<button type="button" class="btn btn-primary" style="margin-left:5px" data-toggle="modal" data-target="#addEMI">EMI</button>-->


                <div class="container mt-5">
                    <h2>Over Dues</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Services</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <!---<th>Upcoming Services</th>-->
                                <th>Due Services</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="overDuesItems">
                            <!-- Table content will be dynamically loaded by DataTables -->
                        </tbody>
                    </table>
                </div>
                <div class="container mt-5">
                    <h2>Today</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Services</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Upcoming Services</th>
                                <th>Due Services</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="todayTable">

                        </tbody>
                    </table>
                </div>

                <div class="container mt-5">
                    <h2>Tomorrow</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Services</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Upcoming Services</th>
                                <th>Due Services</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tomorrowTable">
                            <!-- Table content will be dynamically loaded by DataTables -->
                        </tbody>
                    </table>
                </div>

                <div class="container mt-5">
                    <h2>This Week</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Services</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Upcoming Services</th>
                                <th>Due Services</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="thisWeekTable">
                            <!-- Table content will be dynamically loaded by DataTables -->
                        </tbody>
                    </table>
                </div>

                <div class="container mt-5">
                    <h2>Next Week</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Services</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Upcoming Services</th>
                                <th>Due Services</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="nextWeekTable">
                            <!-- Table content will be dynamically loaded by DataTables -->
                        </tbody>
                    </table>
                </div>

                <div class="container mt-5">
                    <h2>Upcoming</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Services</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Upcoming Services</th>
                                <!--<th>Due Services</th>-->
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="upcomingTable">
                            <!-- Table content will be dynamically loaded by DataTables -->
                        </tbody>
                    </table>
                </div>

            </div>
            <!---completed table---->
            <div class="tab-pane fade" id="list3">
                <h4>Personal Completed Reminder</h4>
                <!-- Add button for List 2 -->
                <button type="button" class="btn btn-primary" data-toggle="modal" onclick="$('#dateInputs').empty();" data-target="#addModal1"><i class="fas fa-bell"></i> Add Reminder</button>
                <div class="container mt-5">
                    <h2>Completed</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Type</th>
                                <th>Upcoming Services</th>
                                <th>Expiry Services</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="completeTable">
                            <!-- Table content will be dynamically loaded by DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- client table -->
            <div class="tab-pane fade" id="list2">
                <h4>Client Reminder List</h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal2"><i class="fas fa-bell"></i> Add Reminder</button>
                <div class="container mt-5">
                    <h2>OverDues</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="overDuesItemsClient">

                        </tbody>
                    </table>
                </div>

                <div class="container mt-5">
                    <h2>Today</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="todayTableClient">

                        </tbody>
                    </table>
                </div>

                <div class="container mt-5">
                    <h2>Tomorrow</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tomorrowTableClient">

                        </tbody>
                    </table>
                </div>
                <div class="container mt-5">
                    <h2>This Week</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="thisWeekTableClient">

                        </tbody>
                    </table>
                </div>
                <div class="container mt-5">
                    <h2>Next Week</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="nextWeekTableClient">

                        </tbody>
                    </table>
                </div>
                <div class="container mt-5">
                    <h2>Upcoming</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="allDataTable1">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="list4">
                <h4>Client Reminder List</h4>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal2"><i class="fas fa-bell"></i> Add Reminder</button>
                <div class="container mt-5">
                    <h2>Completed List</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Start Date</th>
                                <th>Expiry Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="completeClient">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!---model box emi list---->
    <div class="modal fade" id="addEMI" tabindex="-1" role="dialog" aria-labelledby="addEMI1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEMI1Label">Expiry Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="addUserForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="item2">EMI Month List:</label>
                            <div class="form-check" id="emiList">

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---model box add reminder---->
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
                            <input type="text" name="name" class="form-control" id="name" oninput="validateAlphabets(this)" required>
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
                       
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" class="form-control" id="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date:</label>
                            <input type="date" name="expiry_date" class="form-control" id="expiry_date" required>
                        </div>
                        <div>
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="services_date">Services Date:(Optional)</label>
                                    <input type="date" name="services_date[]" class="form-control" />
                                </div>

                            </div>
                        </div>
                        <div id="dateInputs">

                        </div>
                        <button type="button" class="btn btn-primary" id="addDateBtn">Add</button>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" class="form-control" id="price" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="contact_name">Contact Name:</label>
                            <input type="text" name="contact_name" class="form-control" id="contact_name" oninput="validateAlphabets(this)" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_phone">Contact Phone:</label>
                            <input type="text" name="contact_phone" class="form-control" id="contact_phone" oninput="validateNumbers(this)" required>
                        </div>
                        <div class="form-group">
                            <label for="helpline">HelpLine:</label>
                            <input type="text" name="helpline" class="form-control" id="helpline" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes:</label>
                            <textarea type="text" name="notes" class="form-control" id="notes"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Upload File:</label>
                            <input type="file" name="file" class="form-control" id="file">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Add Reminder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!---model box edit reminder---->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Reminder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editUserForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" class="form-control" id="editName" oninput="validateAlphabets(this)">
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


                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" class="form-control" id="startDate">
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date:</label>
                            <input type="date" name="expiry_date" class="form-control" id="expiryDate">
                        </div>
                        <div id="editdateInputs">
                            <div class="form-row mb-2">
                                <div class="col">
                                    <label for="services_date">Services Date:(Optional)</label>
                                    <input type="date" name="services_date[]" class="form-control servicedate1" />
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-danger btn-remove">Remove</button>
                                </div>
                                <div class="col-auto">
                                    <div class="form-check">
                                        <input class="form-check-input servicedate1check" type="checkbox" id="removeCheckbox" name="services_date_end">
                                        <label class="form-check-label" for="services_date_end">Complete</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" id="addDateBtn1">Add</button>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" class="form-control" id="editPrice" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="contact_name">Contact Name:</label>
                            <input type="text" name="contact_name" class="form-control" id="contactName" oninput="validateAlphabets(this)">
                        </div>
                        <div class="form-group">
                            <label for="contact_phone">Contact Phone:</label>
                            <input type="text" name="contact_phone" class="form-control" id="contactPhone" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="helpline">HelpLine:</label>
                            <input type="text" name="helpline" class="form-control" id="editHelpline" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="notes">Notes:</label>
                            <textarea type="text" name="notes" class="form-control" id="editNotes"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Upload File:</label>
                            <input type="file" name="file" class="form-control" id="file">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Update Reminder</button>
                        <button type="button" style="margin-left:5px;" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!---model box for delete---->

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Reminder</h5>
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

    <!---model box add client reminder---->
    <div class="modal fade" id="addModal2" tabindex="-1" role="dialog" aria-labelledby="addModal2Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModal2Label">Add Reminder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="addclientForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Client Name:</label>
                            <input type="text" name="name" class="form-control" id="name" oninput="validateAlphabets(this)">
                        </div>

                        <div class="form-group">
                            <label for="name">Phone:</label>
                            <input type="text" name="phone" class="form-control" id="phone" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" class="form-control" id="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date:</label>
                            <input type="date" name="expiry_date" class="form-control" id="expiry_date" required>
                        </div>
                        <div class="form-group">
                            <label for="reminder_in">Delay Between:</label>
                            <select class="form-control" id="reminder_in" name="reminder_in">
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="2">3 Days</option>
                                <option value="4">4 Days</option>
                                <option value="5">5 Days</option>
                                <option value="6">6 Days</option>
                                <option value="7">7 Days</option>
                                <option value="8">8 Days</option>
                                <option value="9">9 Days</option>
                                <option value="10">10 Days</option>
                                <option value="11">11 Days</option>
                                <option value="12">12 Days</option>
                                <option value="13">13 Days</option>
                                <option value="14">14 Days</option>
                                <option value="15">15 Days</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" class="form-control" id="price" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="notes">Message:</label>
                            <textarea type="text" name="message" class="form-control" id="message"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Upload File:</label>
                            <input type="file" name="file" class="form-control" id="file">
                        </div>
                        <div class="form-group">
                            <label for="item2">Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="Y">
                                <label class="form-check-label" for="type">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="N">
                                <label class="form-check-label" for="type">Inactive</label>
                            </div>

                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Add Reminder</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---model box edit client reminder---->
    <div class="modal fade" id="editModal1" tabindex="-1" role="dialog" aria-labelledby="editModal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModal1Label">Edit Client Reminder</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editclientForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Client Name:</label>
                            <input type="text" name="name" class="form-control" id="editName1" oninput="validateAlphabets(this)">
                        </div>

                        <div class="form-group">
                            <label for="name">Phone:</label>
                            <input type="text" name="phone" class="form-control" id="editPhone" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="name">Email:</label>
                            <input type="text" name="email" class="form-control" id="editEmail">
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" class="form-control" id="startDate1">
                        </div>
                        <div class="form-group">
                            <label for="expiry_date">Expiry Date:</label>
                            <input type="date" name="expiry_date" class="form-control" id="expiryDate1">
                        </div>
                        <div class="form-group">
                            <label for="reminder_in">Delay Between:</label>
                            <select class="form-control" id="editReminder" name="reminder_in">
                                <option value="1">1 Day</option>
                                <option value="2">2 Days</option>
                                <option value="2">3 Days</option>
                                <option value="4">4 Days</option>
                                <option value="5">5 Days</option>
                                <option value="6">6 Days</option>
                                <option value="7">7 Days</option>
                                <option value="8">8 Days</option>
                                <option value="9">9 Days</option>
                                <option value="10">10 Days</option>
                                <option value="11">11 Days</option>
                                <option value="12">12 Days</option>
                                <option value="13">13 Days</option>
                                <option value="14">14 Days</option>
                                <option value="15">15 Days</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" class="form-control" id="editPrice1" oninput="validateNumbers(this)">
                        </div>
                        <div class="form-group">
                            <label for="notes">Message:</label>
                            <textarea type="text" name="message" class="form-control" id="editMessage"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Upload File:</label>
                            <input type="file" name="file" class="form-control" id="file">
                        </div>
                        <div class="form-group">
                            <label for="item2">Client Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="Y">
                                <label class="form-check-label" for="type">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status" value="N">
                                <label class="form-check-label" for="type">Inactive</label>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="item2">Reminder Status:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reminder_status" id="statusReminder" value="Y">
                                <label class="form-check-label" for="type">Complete</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="reminder_status" id="statusReminder" value="">
                                <label class="form-check-label" for="type">Incomplete</label>
                            </div>

                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Update Reminder</button>
                        <button type="button" style="margin-left:5px;" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---model box delete client reminder---->
    <div class="modal fade" id="deleteModal1" tabindex="-1" role="dialog" aria-labelledby="deleteModal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModal1Label">Delete Reminder</h5>
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

        <div class="modal fade" id="expiryModal" tabindex="-1" role="dialog" aria-labelledby="expiryModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="expiryModalLabel">Expiring Services</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="expiryMessage"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>


    <script src="main.js"></script>
    <script src="client_main.js"></script>
    <script>
        $(document).ready(function() {

            $('#addDateBtn').on('click', function() {

                var newDateInput = $('<div class="form-row mb-2">' +
                    '<div class="col">' +
                    '<label for="services_date">Services Date:(Optional)</label>' +
                    '<input type="date" name="services_date[]" class="form-control" />' +
                    '</div>' +
                    '<div class="col-auto">' +
                    '<button type="button" class="btn btn-danger btn-remove"><i class="fas fa-trash"></i></button>' +
                    '</div>' +
                    '</div>');

                $('#dateInputs').append(newDateInput);
            });
            $('#dateInputs').on('click', '.btn-remove', function() {
                $(this).closest('.form-row').remove();
            });
        });


        function validateAlphabets(input) {
            var regex = /^[A-Za-z 0-9.]+$/;
            var inputValue = input.value;

            if (inputValue !== '' && !regex.test(inputValue)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Please enter only alphabets.',
                });

                input.value = '';
            }
        }


        function validateNumbers(input) {
            var regex = /^[0-9.]+$/;
            var inputValue = input.value;

            if (inputValue !== '' && !regex.test(inputValue)) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid Input',
                    text: 'Please enter only numbers.',
                });
                input.value = '';
            }
        }
    </script>
</body>

</html>
