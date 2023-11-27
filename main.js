$(document).ready(function () {
    loadUsers();
    $(document).on('submit', '#addUserForm', function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
        var services_dates = $(this).find('input[name="services_date[]"]').map(function () {
            return $(this).val();
        }).get();

        // Append services_dates manually to formData
        formData.append('services_dates', JSON.stringify(services_dates));
    
        $.ajax({
            type: 'POST',
            url: 'add.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                $('#addUserForm')[0].reset();
                loadUsers();
                console.log('Added');
                $('#addModal1').modal('hide');
            }
        });
    });
    
    
    function loadUsers() {
        $.ajax({
            type: 'GET',
            url: 'get.php',
            success: function (data) {
                var dataObj = JSON.parse(data);
    
                // Clear existing content from all tables
                $('#todayTable, #tomorrowTable, #thisWeekTable, #nextWeekTable, #upcomingTable').empty();
    
                // Add the new content based on the data received
                displayDataInTable(dataObj.todayExpiry, '#todayTable');
                displayDataInTable(dataObj.tomorrowExpiry, '#tomorrowTable');
                displayDataInTable(dataObj.thisWeekExpiry, '#thisWeekTable');
                displayDataInTable(dataObj.nextWeekExpiry, '#nextWeekTable');
                displayDataInTable(dataObj.upcomingExpiry, '#upcomingTable');
            }
        });
    }
    
    // Function to display data in a table
    function displayDataInTable(data, tableId) {
        var table = $(tableId);
    
        data.forEach(function (user) {
            var row = $('<tr>');
            row.append($('<td>').text(user.id));
            row.append($('<td>').text(user.name));
            row.append($('<td>').text(user.contact_phone));
            row.append($('<td>').text(user.type));
            row.append($('<td>').text(user.start_date));
            row.append($('<td>').text(user.expiry_date));
    
            var actionsCell = $('<td>');
            var editButton = $('<button>').addClass('btn btn-primary btn-edit')
            .attr('data-toggle', 'modal')
            .attr('data-target', '#editModal')
            .attr('data-id', user.id) 
            .text('Edit');
            
            var deleteButton = $('<button>').addClass('btn btn-danger btn-delete')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#deleteModal')
                .attr('data-id', user.id)
                .text('Delete');
    
            actionsCell.append(editButton);
            actionsCell.append(deleteButton);
    
            row.append(actionsCell);
    
            table.append(row);
        });
    
        // Initialize DataTable for the table
        table.DataTable();
    }
    
// Move the event listener outside the success callback
$(document).on('click', '.btn-edit', function () {
    var userId = $(this).data('id');
    console.log('userId:', userId);

    $.ajax({
        type: 'GET',
        url: 'get_reminder.php',
        data: { id: userId },
        dataType: 'json',
        success: function (data) {
            console.log('Received Data:', data);

            // Set the value of #editName
            $('#editName').val(data.name);
            $('#startDate').val(data.start_date);
            $('#expiryDate').val(data.expiry_date);
            $('#editPrice').val(data.price);
            $('#contactName').val(data.contact_name);
            $('#contactPhone').val(data.contact_phone);
            $('#editHelpline').val(data.helpline);
            $('#editNotes').val(data.notes);
            $('#editUserForm').data('id', userId);
            // Set values for radio buttons
            $('input[name="type"]').prop('checked', false);
            $('input[name="type"][value="' + data.type + '"]').prop('checked', true);

            // Set values for services_date inputs
            var servicesDates = JSON.parse(data.services_date.replace(/\\/g, ''));

            $('#dateInputs').empty();

            servicesDates.forEach(function (date) {
                var dateInput = $('<div class="form-row mb-2">');
                dateInput.append('<div class="col"><label for="services_date">Services Date:</label>');
                dateInput.append('<input type="date" name="services_date[]" class="form-control" value="' + date + '" /></div>');
                dateInput.append('<div class="col-auto"><button type="button" class="btn btn-danger btn-remove">Remove</button></div></div>');

                $('#dateInputs').append(dateInput);
            });

            // Add event listener for the "Remove" button
            $(document).on('click', '.btn-remove', function () {
                $(this).closest('.form-row').remove();
            });

            // Add event listener for the "Add" button
            $('#addDateBtn').on('click', function () {
                var newDateInput = $('<div class="form-row mb-2">');
                newDateInput.append('<div class="col"><label for="services_date">Services Date:</label>');
                newDateInput.append('<input type="date" name="services_date[]" class="form-control" /></div>');
                newDateInput.append('<div class="col-auto"><button type="button" class="btn btn-danger btn-remove">Remove</button></div></div>');

                $('#dateInputs').append(newDateInput);
            });

            $('#editModal').modal('show');
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', xhr.responseText);
        }
    });
});

$(document).on('submit', '#editUserForm', function (e) {
    e.preventDefault();

    var userId = $(this).data('id');
    console.log('userId:', userId);
    var formData = new FormData(this);
    formData.append('id', userId);
    
    $.ajax({
        type: 'POST',
        url: 'edit.php',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            console.log(response); 
            loadUsers();
            $('#editModal').modal('hide');
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

    

    // Delete user - Show delete confirmation modal
    $(document).on('click', '.btn-delete', function () {
        var userId = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'get_user.php',
            data: { id: userId },
            success: function (data) {
                $('#deleteModal .modal-body').html(data);
                // Set the data-id attribute on the confirmDelete button
                $('#confirmDelete').data('id', userId);
                $('#deleteModal').modal('show');
            }
        });
    });
    
    // Confirm delete - Delete user
    $(document).on('click', '#confirmDelete', function () {
        // Get the user ID from the data-id attribute
        var userId = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'delete.php',
            data: { id: userId },
            success: function () {
                // Reload users after deleting a user
                loadUsers();
                // Close the modal
                $('#deleteModal').modal('hide');
            }
        });
    });
    
});
