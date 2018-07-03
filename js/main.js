let global_limt = 0;
let sql = "select * from ";
$(document).ready(function() {

    //for device category
    $('#what').click(function() {
        var check_selection = $("#what option:selected").val();
        if (check_selection == "device" && global_limt == 0) {
            global_limt++;
            $('#category_selector').append('<div><select name="type" id="type"><option value="" disabled selected>Type?</option><option value="device_pc">Device PC</option><option value="device_other">Other Devices</option></select></div>');
        } else if (check_selection == "user") {
            console.log('user click');
            $("#type").remove();
            global_limt = 0;
        }

    });


});

function createTable(arr) {
    $('#table_here').DataTable({
        "ajax": {
            url: "worker.php",
            method: "POST",
            data: { get_all_device_pc: 1 },
            "dataSrc": ""
        },
        "columns": [
            { "data": "id",className:"dt-body-center"  },
            { "data": "device_id", className:"dt-body-center" },
            { "data": "brand" },
            { "data": "device_serial", className:"dt-body-center" },
            { "data": "cpu" },
            { "data": "ram" },
            { "data": "charger_serial_number", className:"dt-body-center" },
            { "data": "hard_disk_capacity", className:"dt-body-center" },
            { "data": "model" },
            { "data": "os" },
            { "data": "used_by" }

        ]
    });
}

function dashboardDisplay() {
    var temp = $("#type option:selected").val();
    if (temp == "device_pc") {
        sql = sql + "device_pc ";
        //ajaxcall to retrieve from databse
        $.ajax({
            url: "worker.php",
            method: "POST",
            dataType: "json",
            data: { get_all_columns: 1, },
            success: function(data) {
                var b = [];
                for (a in data) {
                    if (!data.length - 1 == a) {
                        b.push('{"data":"' + data[a]["Field"] + '"},');
                    } else {
                        b.push('{"data":"' + data[a]["Field"] + '"}');
                    }
                }
                // createTable(arr);
                //call the function to get all data ffrom databse
                console.log("inside the get all data");
                $('.table_container').show();
                createTable(b);

            }
        });

    }
}