$(document).ready(function () {
    loadUsers();
    loadUsers1();
   
    //add new reminder
    var currentDate = new Date();
    $(document).on('submit', '#addUserForm', function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
        var services_dates = $(this).find('input[name="services_date[]"]').map(function () {
            return $(this).val();
        }).get();
        formData.append('services_dates', JSON.stringify(services_dates));
    
        $.ajax({
            type: 'POST',
            url: 'add.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function () {
                console.log('Reminder added successfully!');
                Swal.fire({
                    icon: 'success',
                    title: 'Reminder added successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#addUserForm')[0].reset();
                loadUsers();
                loadUsers1();
                
                $('#addModal1').modal('hide');
            }
        });
    });
    
    //reminder list
    function loadUsers() {
        $.ajax({
            type: 'GET',
            url: 'get.php',
            success: function (data) {
                var dataObj = JSON.parse(data);
                $('#todayTable, #tomorrowTable, #thisWeekTable, #nextWeekTable, #upcomingTable, #overDuesItems').empty();

                displayDataInTable(dataObj.overdueDates, '#overDuesItems');
                displayDataInTable(dataObj.todayDates, '#todayTable');
                displayDataInTable(dataObj.tomorrowDates, '#tomorrowTable');
                displayDataInTable(dataObj.thisWeekDates, '#thisWeekTable');
                displayDataInTable(dataObj.nextWeekDates, '#nextWeekTable');
                displayDataInTable(dataObj.upcomingDates, '#upcomingTable');
                
            }
        });
    }
        //reminder table 
        function displayDataInTable(data, tableId) {
            var table = $(tableId);

            $.each(data, function (key, user) {
        
                var row = $('<tr>');
                row.append($('<td>').text(user.id));
                row.append($('<td>').text(user.name));
                row.append($('<td >').text(user.contact_phone));
                row.append($('<td>').text(user.type));
                
                var upcomingServicesCell = $('<td>');
                var servicesDates = user.dates;

                if (servicesDates && servicesDates.length > 0) {
                    var upcomingDates = servicesDates.filter(function (serviceDate) {
                        var date = new Date(serviceDate);
                        return date >= currentDate;
                    });

                    if (upcomingDates.length > 0) {
                        upcomingDates.forEach(function (upcomingDate) {
                            upcomingServicesCell.append($('<div>').text(upcomingDate));
                        });
                    } else {
                        upcomingServicesCell.text('No upcoming services');
                    }
                } else {
                    upcomingServicesCell.text('No services dates found');
                }

                if (upcomingServicesCell.text() === 'No upcoming services' || upcomingServicesCell.text() === 'No services dates found') {
                    if (tableId === '#overDuesItems') {
                        upcomingServicesCell.hide();
                    }
                }

                row.append(upcomingServicesCell);

                    var expiryServicesCell = $('<td>');
                    if (servicesDates && servicesDates.length > 0) {
                        var expiryDates = servicesDates.filter(function (serviceDate) {
                            var date = new Date(serviceDate);
                            return date < currentDate;
                        });

                        if (expiryDates.length > 0) {
                            expiryDates.forEach(function (expiryDate) {
                                var expiryDiv = $('<div>').text(expiryDate);
                                var expiryDateObj = new Date(expiryDate);
                                var timeDiff = expiryDateObj.getTime() - currentDate.getTime();
                                var itemDaysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                                if (itemDaysDiff <= 3) {
                                    expiryDiv.addClass('blink-red');
                                }

                                if (itemDaysDiff === 1 || itemDaysDiff === 2) {
                                    // Show modal with expiry message
                                    $('#expiryMessage').text('Service expiring in ' + itemDaysDiff + ' day(s)');
                                    $('#expiryModal').modal('show');
                                }
                                expiryServicesCell.append(expiryDiv);
                            });
                            
                            

                        } else {
                            expiryServicesCell.text('No expired services');
                        }
                    } else {
                        expiryServicesCell.text('No services dates found');
                    }

                    if (tableId === '#upcomingTable') {
                        expiryServicesCell.hide();
                    }
                    row.append(expiryServicesCell);

        
                    // var startDate = new Date(user.start_date);
                    // var formattedStartDate = startDate.toLocaleDateString('en-US', {
                    //     day: 'numeric',
                    //     month: 'long',
                    //     year: 'numeric'
                    // });
                row.append($('<td>').text(user.start_date));
                

                var expiryDateCell = $('<td>').text(user.expiry_date);
                var expiryDate = new Date(user.expiry_date);
                var timeDiff = expiryDate.getTime() - currentDate.getTime();
                var itemDaysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
        
                if (itemDaysDiff <= 3) {
                    expiryDateCell.addClass('blink-red');
                }
        
                row.append(expiryDateCell);

                var fileCell = $('<td>');
                if (user.file && user.file.trim() !== "") {
                    var fileLink = $('<a>').attr('href', user.file).attr('target', '_blank').text('View File');
                    fileCell.append(fileLink);
                } else {
                    fileCell.text('N/A');
                }
                row.append(fileCell);
                
        
                var actionsCell = $('<td>');
                var editButton = $('<button>').addClass('btn btn-primary btn-edit')
                    .attr('data-toggle', 'modal')
                    .attr('data-target', '#editModal')
                    .attr('data-id', user.id)
                    .html('<i class="fas fa-edit"></i>');
        
                    var deleteButton = $('<button>').addClass('btn btn-danger btn-delete')
                    .attr('data-toggle', 'modal')
                    .attr('data-target', '#deleteModal')
                    .attr('data-id', user.id)
                    .html('<i class="fas fa-trash"></i>');
        
                actionsCell.append(editButton);
                actionsCell.append(deleteButton);
        
                row.append(actionsCell);
        
                table.append(row);
                    
        });
    }

    //completed Reminder list
    function loadUsers1() {
        $.ajax({
            type: 'GET',
            url: 'complete_list.php',
            success: function (data) {
                var dataObj = JSON.parse(data);
                $('#completeTable').empty();
                displayDataInTable1(dataObj.completeTable, '#completeTable');
            }
        });
    }

    // Function to display data in a table
    function displayDataInTable1(data, tableId) {
        var table = $(tableId);
        $.each(data, function (key, user) {
       
            var row = $('<tr>');
            row.append($('<td>').text(user.id));
            row.append($('<td>').text(user.name));
            row.append($('<td >').text(user.contact_phone));
             row.append($('<td>').text(user.type));
            // row.append($('<td>').text(user.dates));

            var upcomingServicesCell = $('<td>');
            var servicesDates = JSON.parse(user.services_date_end);
            
            if (servicesDates && servicesDates.length > 0) {
              
                var upcomingDates = servicesDates.filter(function (serviceDate) {
                    var date = new Date(serviceDate);
                    return date >= currentDate;
                    
                });
    
                if (upcomingDates.length > 0) {
                    upcomingDates.forEach(function (upcomingDate) {
                        upcomingServicesCell.append($('<div>').text(upcomingDate));
                    });
                } else {
                    upcomingServicesCell.text('No upcoming services');
                }
            } else {
                upcomingServicesCell.text('No services dates found');
            }
    
            row.append(upcomingServicesCell);

                var expiryServicesCell = $('<td>');
                if (servicesDates && servicesDates.length > 0) {
                    var expiryDates = servicesDates.filter(function (serviceDate) {
                        var date = new Date(serviceDate);
                        return date < currentDate;
                    });

                    if (expiryDates.length > 0) {
                        expiryDates.forEach(function (expiryDate) {
                            var expiryDiv = $('<div>').text(expiryDate);
                            var expiryDateObj = new Date(expiryDate);
                            var timeDiff = expiryDateObj.getTime() - currentDate.getTime();
                            var itemDaysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));

                            if (itemDaysDiff <= 3) {
                                expiryDiv.addClass('blink-red');
                            }

                            expiryServicesCell.append(expiryDiv);
                        });
                        
                        if (user.completed) {
                            expiryServicesCell.empty().text('Completed').addClass('completed');
                        }
                    } else {
                        expiryServicesCell.text('No expired services');
                    }
                } else {
                    expiryServicesCell.text('No services dates found');
                }

                row.append(expiryServicesCell);

    
             row.append($('<td>').text(user.start_date));
            

            var expiryDateCell = $('<td>').text(user.expiry_date);
            var expiryDate = new Date(user.expiry_date);
            var timeDiff = expiryDate.getTime() - currentDate.getTime();
            var itemDaysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
    
            if (itemDaysDiff <= 3) {
                expiryDateCell.addClass('blink-red');
            }
    
            row.append(expiryDateCell);
    
            var fileCell = $('<td>');
            if (user.file) {
                var fileLink = $('<a>').attr('href', user.file).attr('target', '_blank').text('View File');
                fileCell.append(fileLink);
            }
            row.append(fileCell);
    
            var actionsCell = $('<td>');
            var editButton = $('<button>').addClass('btn btn-primary btn-edit')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#editModal')
                .attr('data-id', user.id)
                .html('<i class="fas fa-edit"></i>');
    
                var deleteButton = $('<button>').addClass('btn btn-danger btn-delete')
                .attr('data-toggle', 'modal')
                .attr('data-target', '#deleteModal')
                .attr('data-id', user.id)
                .html('<i class="fas fa-trash"></i>');
    
            actionsCell.append(editButton);
            actionsCell.append(deleteButton);
            row.append(actionsCell);
            table.append(row);
    });

    }

    $(document).on('click', '.btn-remove', function () {
        $(this).closest('.form-row').remove();
    });
    
    //edit from input field data get
    $(document).on('click', '.btn-edit', function () {
        var userId = $(this).data('id');
        $('#addDateBtn1').off('click');

        $.ajax({
            type: 'GET',
            url: 'get_reminder.php',
            data: { id: userId },
            dataType: 'json',
            success: function (data) {

                $('#editName').val(data.name);
                $('#startDate').val(data.start_date);
                $('#expiryDate').val(data.expiry_date);
                $('#editPrice').val(data.price);
                $('#contactName').val(data.contact_name);
                $('#contactPhone').val(data.contact_phone);
                $('#editHelpline').val(data.helpline);
                $('#editNotes').val(data.notes);
                $('#editUserForm').data('id', userId);

                $('input[name="type"]').prop('checked', false);
                $('input[name="type"][value="' + data.type + '"]').prop('checked', true);

                var servicesDates = JSON.parse(data.services_date);

                $('#editdateInputs').empty();

                servicesDates.forEach((date, key) => {
                    var dateInput = $('<div class="form-row mb-2">');
                    dateInput.append('<div class="col"><label for="services_date">Services Date:(Optional)</label>');
                    dateInput.append('<input type="date" name="services_date[]" class="form-control servicedate' + key + '" value="' + date + '" /></div>');
                    dateInput.append('<div class="col-auto"><button type="button" class="btn btn-danger btn-remove"><i class="fas fa-trash"></i></button></div></div>');
                    var completeCheckbox = $('<div class="col-auto"><div class="form-check"><input class="form-check-input moyee_moyee completeservice'+ key +'" onclick="completeservice(' + key + ')" type="checkbox" name="services_date_end"><label class="form-check-label" for="services_date_end">Complete</label></div></div>');
                
                    if (data.services_date_end && data.services_date_end.includes(date)) {
                        completeCheckbox.find('input').prop('checked', true);
                    }
                
                    dateInput.append(completeCheckbox);
                    $('#editdateInputs').append(dateInput);
                });

                $('#addDateBtn1').on('click', function () {
                    var newDateInput = $('<div class="form-row mb-2">');
                    newDateInput.append('<div class="col"><label for="services_date">Services Date:(Optional)</label>');
                    newDateInput.append('<input type="date" name="services_date[]" class="form-control" /></div>');
                    newDateInput.append('<div class="col-auto"><button type="button" class="btn btn-danger btn-remove"><i class="fas fa-trash"></i></button></div></div>');

                    $('#editdateInputs').append(newDateInput);
                });

                $('#editModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', xhr.responseText);
            }
        });
    });


    //submint edit from
    $(document).on('submit', '#editUserForm', function (e) {
        e.preventDefault();

        var userId = $(this).data('id');
        var formData = new FormData(this);
        formData.append('id', userId);
        
        $.ajax({
            type: 'POST',
            url: 'edit.php',
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
                loadUsers();
                loadUsers1();
                $('#editModal').modal('hide');
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    //delete model
    $(document).on('click', '.btn-delete', function () {
        var userId = $(this).data('id');
        $.ajax({
            type: 'GET',
            url: 'get_user.php',
            data: { id: userId },
            success: function (data) {
                $('#deleteModal .modal-body').html(data);
                $('#confirmDelete').data('id', userId);
                $('#deleteModal').modal('show');
            }
        });
    });

    $(document).on('click', '#confirmDelete', function () {
        var userId = $(this).data('id');
        $.ajax({
            type: 'POST',
            url: 'delete.php',
            data: { id: userId },
            success: function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Reminder deleted successfully!',
                    showConfirmButton: false,
                    timer: 1500
                });
                loadUsers();
                loadUsers1();
                $('#deleteModal').modal('hide');
            }
        });
    });

    //emi list
    // $(document).ready(function () {
    //     function loadEmiExpiryDates() {
    //         $.ajax({
    //             type: 'GET',
    //             url: 'emi_list.php', 
    //             success: function (data) {
    //                 try {
    //                     var emiList = $('#emiList');
    //                     emiList.empty();
    
    //                     var expiryDates = JSON.parse(data);
    
    //                     if (expiryDates && expiryDates.length > 0) {
    //                         expiryDates.forEach(function (expiryDate) {
    //                             var radioDiv = $('<div class="form-check">');
    //                             var radioInput = $('<input>')
    //                                 .attr('type', 'radio')
    //                                 .attr('name', 'emiExpiryDate')
    //                                 .attr('value', expiryDate)
    //                                 .addClass('form-check-input');
    //                             var radioLabel = $('<label>')
    //                                 .text(expiryDate)
    //                                 .addClass('form-check-label');
    
    //                             radioDiv.append(radioInput);
    //                             radioDiv.append(radioLabel);
    
    //                             emiList.append(radioDiv);
    //                         });
    //                     } else {
    //                         emiList.html('<p>No EMI expiry dates found.</p>');
    //                     }
    //                 } catch (error) {
    //                     console.error('Error parsing JSON:', error);
    //                 }
    //             },
    //             error: function (error) {
    //                 console.error('Error fetching data:', error);
    //             }
    //         });
    //     }
    
    //     loadEmiExpiryDates(); 
    // });
    
});
    var expiredatae = [];
    function completeservice(id) {
    
        if ($('.completeservice' + id).is(':checked')) {
            expiredatae.push($('.servicedate' + id).val());
          
        } else {
          
            expiredatae.push(null);
        }
        var filteredData = expiredatae.filter(function (value) {
            return value !== null;
        });

        $('input[name="services_date_end"]').val(JSON.stringify(filteredData));
    }



    // function resetForm(){
    //     $('#dateInputs')[0].reset();
    //     alert()
    //     $('#dateInputs').empty();
    // }
