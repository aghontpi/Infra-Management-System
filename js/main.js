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

    // $("#update-submit").on('click',function(){
    // 	$("#update-form")[0].reset();

    // 	$("#update-form").unbind('submit').bind('submit',function(){
    // 		var form = $(this);

    // 	});
    // });

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

        ],
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false,
                "searchable": false
            }
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

function getAttributes_to_add(){
	var temp = $("#addDevice option:selected").val();
	if(temp == "pc"){
	$("#fields_container").empty();
	$("#fields_container").append('<div class="base"><div><form id="survey-form" method="post" action="worker.php"> <label id="deviceid-label">Device-id:</label> <input name="device_id" placeholder="Enter device id(unique)" autofocus required> <br> <br> <label id="brand-label">Brand:</label> <input type="text" name="brand" placeholder="Enter Brand" required> <br> <br> <label id="serial-label">Device Serial:</label> <input type="text" name="device_serial" placeholder="Device Serial(Unique)" required> <br> <br> <label id="cpu-label">Cpu:</label> <input type="text" name="cpu" placeholder="CPU" required> <br> <br> <label id="ram-label">Ram:</label> <input type="text" name="ram" placeholder="ram" required> <br> <br> <label id="charger_serial-label">Charger Serial:</label> <input type="text" name="charger_serial" placeholder="Charger Serial(Unique)" > <br> <br> <label id="HD-label">Hard Disk Capacity:</label> <input type="text" name="harddisk_capacity" placeholder="Hard Disk Capacity" required> <br> <br> <label id="model-label">Model:</label> <input type="text" name="model" placeholder="pc/lap model" required> <br> <br> <label id="os-label">OS:</label> <input type="text" name="os" placeholder="os installed" required> <br> <br> <button id="submit" type="submit" name="btn_submit_pc" value="submit" class="btn-submit">Submit</button></form></div></div>');	
	}
	else if(temp =="device"){
		$("#fields_container").empty();
		$("#fields_container").append('<div class="base"><div><form id="survey-form" action="worker.php" method="post"> <label id="deviceid-label">Device-id:</label> <input name="device_id" placeholder="Enter device id(unique)" autofocus required> <br> <br> <label id="Name-label">Name:</label> <input type="text" name="name" placeholder="Name" required> <br> <br> <label id="brand-label">Brand:</label> <input type="text" name="brand" placeholder="Enter Brand" required> <br> <br> <label id="serial-label">Device Serial:</label> <input type="text" name="device_serial" placeholder="Device Serial(Unique)" required> <br> <br> <label id="Otherinfo-label">Other info:</label> <input type="text" name="other_info" placeholder="Extra Info" required> <br> <br> <button id="submit" name="btn_submit_device" class="btn-submit">Submit</button></form></div></div>');
	}
}

function updateitemsDisplay(){
	var temp = $("#device_update_select option:selected").val();
    if (temp == "device_pc"){
   	$('.table_container').show();
   	var table = $('#table_here').DataTable({
   		"ajax":{
   			url:"worker.php",
   			method:"post",
   			data:{getdata_updatepage:1}
   		}
   	});
    }
}
function updateToserver(){
	console.log('clicked');
	$("#update-form")[0].reset();
	var formdata = $("#update-form");
	$.ajax({
		url:"worker.php",
		method:"post",
		data:{},
		dataType:"json",
		success:function(data){
			console.log(data);
		}
	});
	return false;
}

function getDataUpdatePage(){

}