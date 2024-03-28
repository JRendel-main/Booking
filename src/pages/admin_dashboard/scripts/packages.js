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

    // when the add package button is clicked on modal add package
    $('#addPackageBtn').on('click', function () {
        let package_name = $('#packageName').val();
        let package_price = $('#packagePrice').val();
        let package_description = $('#packageDescription').val();

        // get the package_type from select option
        let package_type = $('#packageType').val();

        if (package_name == '' || package_price == '' || package_description == '') {
            alert('Please fill all fields');
        } else {
            $.ajax({
                url: 'controllers/addPackage.php',
                type: 'POST',
                data: {
                    packageName: package_name,
                    packagePrice: package_price,
                    packageDescription: package_description,
                    packageType: package_type
                },
                success: (response) => {
                    var data = JSON.parse(response);
                    if (data.status == 'success') {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert(data.message);
                    }
                }
            })
        }
    })
})