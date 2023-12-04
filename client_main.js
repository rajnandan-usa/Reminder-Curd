$(document).ready(function () {
    loadUsers();
    loadUsers2();
    loadUsers3();
    var currentDate = new Date();
    //add client reminder
    $(document).on('submit', '#addclientForm', function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
    
        $.ajax({
            type: 'POST',
            url: 'add_client.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Reminder added successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#addclientForm')[0].reset();
                location.reload();
                loadUsers();
                loadUsers2();
                loadUsers3();
                console.log('Added');
                $('#addModal2').modal('hide');
            }
        });
    });
    
    
    function loadUsers() {
        $.ajax({
            type: 'GET',
            url: 'get_client.php',
            success: function (data) {
                var dataObj = JSON.parse(data);
                $('#todayTableClient, #tomorrowTableClient, #thisWeekTableClient, #nextWeekTableClient, #upcomingTableClient, #overDuesItemsClient').empty();

                    displayDataInTable(dataObj.overDuesItems, '#overDuesItemsClient');
                    displayDataInTable(dataObj.todayExpiry, '#todayTableClient');
                    displayDataInTable(dataObj.tomorrowExpiry, '#tomorrowTableClient');
                    displayDataInTable(dataObj.thisWeekExpiry, '#thisWeekTableClient');
                    displayDataInTable(dataObj.nextWeekExpiry, '#nextWeekTableClient');
                    displayDataInTable(dataObj.upcomingExpiry, '#upcomingTableClient');
            }
        });
    }
    
    // Function to display data in a table
    function displayDataInTable(data, tableId) {
        var table = $(tableId);
    
        data.forEach(function (client) {
            var row = $('<tr>');
            row.append($('<td>').text(client.id));
            row.append($('<td>').text(client.name));
            row.append($('<td>').text(client.phone));
            row.append($('<td>').text(client.email));
            row.append($('<td>').text(client.start_date));
                

            var expiryDateCell = $('<td>').text(client.expiry_date);
            var expiryDate = new Date(client.expiry_date);
            var timeDiff = expiryDate.getTime() - currentDate.getTime();
            var itemDaysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
    
            if (itemDaysDiff <= 3) {
                expiryDateCell.addClass('blink-red');
            }
    
            row.append(expiryDateCell);
    
            // var fileCell = $('<td>');
            // if (user.file) {
            //     var fileLink = $('<a>').attr('href', user.file).attr('target', '_blank').text('View File');
            //     fileCell.append(fileLink);
            // }
            // row.append(fileCell);
    
            var actionsCell = $('<td>');
            var editButton = $('<button>').addClass('btn btn-primary btn-edit1')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#editModal1')
                .attr('data-id', client.id)
                .html('<i class="fas fa-edit"></i>');
    
            var deleteButton = $('<button>').addClass('btn btn-danger btn-delete1')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#deleteModal1')
                .attr('data-id', client.id)
                .html('<i class="fas fa-trash"></i>');
    
            actionsCell.append(editButton);
            actionsCell.append(deleteButton);
    
            row.append(actionsCell);
    
            table.append(row);
        });

    }

    function loadUsers3() {
        $.ajax({
            type: 'GET',
            url: 'get_client_complete.php',
            success: function (data) {
                var dataObj = JSON.parse(data);
                $('#completeClient').empty();
                displayDataInTable3(dataObj.completeClient, '#completeClient');
            }
        });
    }
    
    // Function to display data in a table
    function displayDataInTable3(data, tableId) {
        var table = $(tableId);
    
        data.forEach(function (client) {
            var row = $('<tr>');
            row.append($('<td>').text(client.id));
            row.append($('<td>').text(client.name));
            row.append($('<td>').text(client.phone));
            row.append($('<td>').text(client.email));
            row.append($('<td>').text(client.start_date));
            
            var currentDate = new Date();  
            
            var expiryDateCell = $('<td>').text(client.expiry_date_new);
            var expiryDate = new Date(client.expiry_date_new);
            var timeDiff = expiryDate.getTime() - currentDate.getTime();
            var itemDaysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
    
            if (itemDaysDiff <= 3) {
                expiryDateCell.addClass('blink-red');
            }
    
            row.append(expiryDateCell);
    
            var actionsCell = $('<td>');
            var editButton = $('<button>').addClass('btn btn-primary btn-edit1')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#editModal1')
                .attr('data-id', client.id)
                .html('<i class="fas fa-edit"></i>');
    
            var deleteButton = $('<button>').addClass('btn btn-danger btn-delete1')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#deleteModal1')
                .attr('data-id', client.id)
                .html('<i class="fas fa-trash"></i>');
    
            actionsCell.append(editButton);
            actionsCell.append(deleteButton);
    
            row.append(actionsCell);
    
            table.append(row);
        });
    }
    


    function loadUsers2() {
        $.ajax({
            type: 'GET',
            url: 'get_client_upcoming.php',
            success: function (data) {
                var dataObj = JSON.parse(data);
                $('#allDataTable1').empty();
                displayDataInTable2(dataObj.allData, '#allDataTable1');
            }
        });
    }
    
    // Function to display data in a table
    function displayDataInTable2(data, tableId) {
        var table = $(tableId);
    
        data.forEach(function (client) {
            var row = $('<tr>');
            row.append($('<td>').text(client.id));
            row.append($('<td>').text(client.name));
            row.append($('<td>').text(client.phone));
            row.append($('<td>').text(client.email));
            row.append($('<td>').text(client.start_date));
            row.append($('<td>').text(client.expiry_date_new));
    
            var actionsCell = $('<td>');
            var editButton = $('<button>').addClass('btn btn-primary btn-edit1')
            .attr('data-toggle', 'modal')
            .attr('data-target', '#editModal1')
            .attr('data-id', client.id) 
            .html('<i class="fas fa-edit"></i>');
            
            var deleteButton = $('<button>').addClass('btn btn-danger btn-delete1')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#deleteModal1')
                .attr('data-id', client.id)
                .html('<i class="fas fa-trash"></i>');
    
            actionsCell.append(editButton);
            actionsCell.append(deleteButton);
    
            row.append(actionsCell);
    
            table.append(row);
        });

    }
    
    // Move the event listener outside the success callback
    $(document).on('click', '.btn-edit1', function () {
        var userId = $(this).data('id');
        console.log('userId:', userId);

        $.ajax({
            type: 'GET',
            url: 'get_client_reminder.php',
            data: { id: userId },
            dataType: 'json',
            success: function (data) {
                console.log('Received Data:', data);

                // Set the value of #editName
                $('#editName1').val(data.name);
                $('#editPhone').val(data.phone);
                $('#editEmail').val(data.email);
                $('#startDate1').val(data.start_date);
                $('#expiryDate1').val(data.expiry_date);
                $('#editReminder').val(data.reminder_in);
                $('#editPrice1').val(data.price);
                $('#editMessage').val(data.message);
                $('#editclientForm').data('id', userId);
                $('input[name="status"]').prop('checked', false);
                $('input[name="status"][value="' + data.status + '"]').prop('checked', true);
                $('input[name="reminder_status"]').prop('checked', false);
                $('input[name="reminder_status"][value="' + data.reminder_status + '"]').prop('checked', true);
                

                $('#editModal1').modal('show');
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
            }
        }); 
    });
    //edit client 
    $(document).on('submit', '#editclientForm', function (e) {
        e.preventDefault();

        var userId = $(this).data('id');
        console.log('userId:', userId);
        var formData = new FormData(this);
        formData.append('id', userId);
        
        $.ajax({
            type: 'POST',
            url: 'edit_client.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Reminder updated successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload();
                console.log(response); 
                loadUsers();
                loadUsers2();
                loadUsers3();
                $('#editModal1').modal('hide');
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    // Delete user - Show delete confirmation modal
    $(document).on('click', '.btn-delete1', function () {
        var userId = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'get_client_delete.php',
            data: { id: userId },
            success: function (data) {
                $('#deleteModal1 .modal-body').html(data);
                $('#confirmDelete').data('id', userId);
                $('#deleteModal1').modal('show');
            }
        });
    });
    
    // Confirm delete - Delete user
    $(document).on('click', '#confirmDelete', function () {
        var userId = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'delete_client.php',
            data: { id: userId },
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Reminder deleted successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
                loadUsers();
                loadUsers2();
                loadUsers3();
                $('#deleteModal1').modal('hide');
            }
        });
    });

    function updateExpiryDates() {
        $.ajax({
            url: 'update_expiry_date.php', 
            method: 'GET',
            success: function(response) {

                console.log('Expiry dates updated successfully');
                
            },
            error: function(xhr, status, error) {
                console.error('Error updating expiry dates:', error);
            }
        });
    }
    updateExpiryDates();
    setInterval(updateExpiryDates, 86400000);
    
});
