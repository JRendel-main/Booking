$(document).ready(function () {
    // ajax
    $.ajax({
        url: 'controllers/getAllFeedbacks.php',
        type: 'GET',
        success: function (response) {
            let data = JSON.parse(response);

            // initialize datatable
            $('#feedbacks').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [[0, "asc"]],
                "info": true,
                "responsive": true,
                "scrollX": true,
                "scrollY": true,
                "pageLength": 10,
                "columnDefs": [
                    { "width": "10%", "targets": 0 },
                    { "width": "40%", "targets": 1 },
                    { "width": "20%", "targets": 2 },
                    { "width": "20%", "targets": 3 },
                    { "width": "20%", "targets": 4 }
                ],
                "data": data,
                "columns": [
                    { "data": "feedback_id", title: "ID" },
                    { "data": "feedback", title: "Feedback" },
                    { "data": "guest_name", title: "Guest Name" },
                    { "data": "timestamp", title: "Timestamp" },
                    {
                        "data": null,
                        "title": "Action",
                        "render": function (data, type, row) {
                            return '<a href="controllers/deleteFeedback.php?id=' + data.feedback_id + '" class="btn btn-danger btn-sm">Delete</a>';
                        }
                    }
                ]
            });
        }
    });
});