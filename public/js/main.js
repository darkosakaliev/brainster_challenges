jQuery(document).ready(function ($) {
    // SHOW VEHICLES
    $.ajax({
        type: "GET",
        dataType: "json",
        url: "http://127.0.0.1:8000/api/vehicles",
        success: function (obj) {
            $.each(obj.data, function (key, element) {
                var vehicles =
                    '<tr id="vehicle' +
                    element.id +
                    '"><td>' +
                    element.brand +
                    "</td><td>" +
                    element.model +
                    "</td><td>" +
                    element.plate_number +
                    "</td><td>" +
                    element.insurance_date +
                    "</td><td>" +
                    "<button id='btn-edit' data-id='" +
                    element.id +
                    "' class='me-2 btn btn-warning bg-warning'>Edit</button><button id='btn-delete' data-id='" +
                    element.id +
                    "' class='btn btn-danger bg-danger'>Delete</button>" +
                    "</td>";
                jQuery("#vehicle-list").append(vehicles);
            });
        },
    });
    jQuery("#vehicle-list").on("click", "#btn-edit", function () {
        jQuery("#btn-save").val("edit");
        jQuery("#vehicle_id").val($(this).data("id"));
        jQuery("#myForm").trigger("reset");
        jQuery("#formModal").modal("show");
        // SHOW VEHICLE
        $.ajax({
            type: "GET",
            url:
                "http://127.0.0.1:8000/api/vehicles/" +
                jQuery("#vehicle_id").val(),
            dataType: "json",
            success: function (obj) {
                console.log(obj);
                $("#brand").val(obj.data[0].brand);
                $("#model").val(obj.data[0].model);
                $("#plate_number").val(obj.data[0].plate_number);
                $("#insurance_date").val(obj.data[0].insurance_date);
            },
        });
    });
    jQuery("#vehicle-list").on("click", "#btn-delete", function () {
        jQuery("#vehicle_id").val($(this).data("id"));
        vehicle_id = jQuery("#vehicle_id").val();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url:
                        "http://127.0.0.1:8000/api/vehicles/" +
                        jQuery("#vehicle_id").val(),
                    dataType: "json",
                    success: function (obj) {
                        Swal.fire(
                            "Deleted!",
                            "The Vehicle has been deleted.",
                            "success"
                        );
                        jQuery("#vehicle" + vehicle_id).remove();
                    },
                });
            }
        });
    });

    jQuery("#btn-add").click(function () {
        jQuery("#btn-save").val("add");
        jQuery("#myForm").trigger("reset");
        jQuery("#formModal").modal("show");
    });
    //----- Open model CREATE -----//
    // CREATE
    $("#btn-save").on("click", function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        e.preventDefault();
        var formData = {
            brand: jQuery("#brand").val(),
            model: jQuery("#model").val(),
            plate_number: jQuery("#plate_number").val(),
            insurance_date: jQuery("#insurance_date").val(),
        };
        var state = jQuery("#btn-save").val();
        var vehicle_id = jQuery("#vehicle_id").val();
        if (state == "add") {
            $.ajax({
                type: "POST",
                url: "http://127.0.0.1:8000/api/vehicles",
                data: formData,
                dataType: "json",
                success: function (obj) {
                    var vehicle =
                        '<tr id="vehicle' +
                        obj.data.id +
                        '"><td>' +
                        obj.data.brand +
                        "</td><td>" +
                        obj.data.model +
                        "</td><td>" +
                        obj.data.plate_number +
                        "</td><td>" +
                        obj.data.insurance_date +
                        "</td><td>" +
                        "<button id='btn-edit' data-id='" +
                        obj.data.id +
                        "' class='me-2 btn btn-warning bg-warning'>Edit</button><button id='btn-delete' data-id='" +
                        obj.data.id +
                        "' class='btn btn-danger bg-danger'>Delete</button>" +
                        "</td>";
                    jQuery("#vehicle-list").append(vehicle);
                    jQuery("#myForm").trigger("reset");
                    jQuery("#formModal").modal("hide");
                    Swal.fire(
                        "Created successfully!",
                        "The Vehicle has been created.",
                        "success"
                    );
                },
                error: function (data) {
                    console.log(data);
                },
            });
        } else if (state == "edit") {
            $.ajax({
                type: "PUT",
                url:
                    "http://127.0.0.1:8000/api/vehicles/" +
                    jQuery("#vehicle_id").val(),
                data: formData,
                dataType: "json",
                success: function (obj) {
                    var vehicle =
                        '<tr id="vehicle' +
                        obj.data.id +
                        '"><td>' +
                        obj.data.brand +
                        "</td><td>" +
                        obj.data.model +
                        "</td><td>" +
                        obj.data.plate_number +
                        "</td><td>" +
                        obj.data.insurance_date +
                        "</td><td>" +
                        "<button id='btn-edit' data-id='" +
                        obj.data.id +
                        "' class='me-2 btn btn-warning bg-warning'>Edit</button><button id='btn-delete' data-id='" +
                        obj.data.id +
                        "' class='btn btn-danger bg-danger'>Delete</button>" +
                        "</td>";
                    jQuery("#vehicle" + vehicle_id).replaceWith(vehicle);
                    jQuery("#myForm").trigger("reset");
                    jQuery("#formModal").modal("hide");
                    Swal.fire(
                        "Edit successful!",
                        "The Vehicle has been edited sucessfully.",
                        "success"
                    );
                },
                error: function (data) {
                    console.log(data);
                },
            });
        } else if (state == "delete") {
        }
    });
});
