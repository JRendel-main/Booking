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
                            return '<a href="reservation_details.php?id=' + data.reservation_id + '" class="btn btn-primary btn-sm">View</a>';
                        }
                    }
                ]
            });
        }
    })

});