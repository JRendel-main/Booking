$(document).ready(() => {
    $.ajax({
        url: 'controllers/getStandardPackges.php',
        type: 'GET',
        success: (response) => {
            let data = JSON.parse(response);
            $('#standard_package_list').DataTable({
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
                    { "data": "PackageName", title: "Package Name" },
                    { "data": "Price", title: "Package Price" },
                    { "data": "Description", title: "Package Description" },
                    {
                        "data": null,
                        "title": "Action",
                        "render": function (data, type, row) {
                            return '<a href="edit_package.php?id=' + data.PackageID + '" class="btn btn-primary btn-sm">Edit</a>';
                        }
                    }
                ]
            });
        }
    })

    $.ajax({
        url: 'controllers/getCustomPackage.php',
        type: 'GET',
        success: (response) => {
            let data = JSON.parse(response);
            $('#custom_package_list').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "order": [[0, "asc"]],
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "scrollX": true,
                "scrollY": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 75, 100],
                "data": data,
                "columns": [
                    { "data": "PackageName", title: "Package Name" },
                    { "data": "Price", title: "Package Price" },
                    { "data": "Description", title: "Package Description" },
                    {
                        "data": null,
                        "title": "Action",
                        "render": function (data, type, row) {
                            return '<a href="edit_package.php?id=' + data.PackageID + '" class="btn btn-primary btn-sm">Edit</a>';
                        }
                    }
                ]
            });
        }
    })
})