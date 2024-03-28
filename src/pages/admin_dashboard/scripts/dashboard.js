// document ready
$(document).ready(function () {
    $.ajax({
        url: 'controllers/getReservation.php',
        type: 'GET',
        success: function (response) {
            var data = JSON.parse(response);
            $('#reservationlist').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [[0, "desc"]],
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "scrollX": true,
                "scrollY": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100],
                "data": data,
                "columns": [
                    { "data": "reservation_date", title: "Reservation Date" },
                    { "data": "package_name", title: "Package Name" },
                    { "data": "guest_name", title: "Guest Name" },
                    { "data": "guest_contact", title: "Guest Contact" },
                    { "data": "total_paid", title: "Total Paid" },
                    { "data": "status", title: `Status` },
                    {
                        "data": null,
                        "title": "Action",
                        "render": function (data, type, row) {
                            if (data.status === '<badge class=\"badge badge-pill badge-success\">Approved</badge>') {
                                // Show "Cancel" button if status is "approved"
                                return `
                                <button class="btn btn-danger btn-sm cancel-booking" data-id="${data.reservation_id}">Cancel Booking</button>`;
                            } else {
                                return `<button class="btn btn-secondary btn-sm" disabled>Cancel</button>`
                            }
                        }
                    }
                ]
            });
        }
    })

    $(document).on('click', '.cancel-booking', function () {
        var reservationId = $(this).data('id');
        // change the cursor of user to wait and disable the button
        $(this).css('cursor', 'wait').prop('disabled', true);
        // show confirmation dialog
        confirm('Are you sure you want to cancel this booking?') && $.ajax({
            url: 'controllers/cancelReservation.php',
            type: 'POST',
            data: { reservationId: reservationId },
            success: function (response) {
                var response = JSON.parse(response);
                if (response.status === 'success') {
                    alert('Booking has been cancelled successfully.');
                    location.reload();
                } else {
                    alert('Failed to cancel booking. Please try again later.');
                    location.reload();
                }
            }
        });
    });

    $.ajax({
        url: 'controllers/getPendingReservation.php',
        type: 'GET',
        success: function (response) {
            var data = JSON.parse(response);
            $('#pendingreservationlist').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [[0, "desc"]],
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "scrollX": true,
                "scrollY": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100],
                "data": data,
                "columns": [
                    { "data": "reservation_date", title: "Reservation Date" },
                    { "data": "package_name", title: "Package Name" },
                    { "data": "guest_name", title: "Guest Name" },
                    { "data": "guest_contact", title: "Guest Contact" },
                    { "data": "total_paid", title: "Total Paid" },
                    { "data": "status", title: `Status` },
                    {
                        "data": null,
                        "title": "Action",
                        "render": function (data, type, row) {
                            return '<a href="reservation_details.php?id=' + data.reservation_id + '" class="btn btn-primary btn-sm">View</a>';
                        }
                    }
                ]
            });
        }
    })
});