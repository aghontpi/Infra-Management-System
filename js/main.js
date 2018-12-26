let global_limt = 0;
var dashboard_table_device_pc=0;
var dashboard_table_device_other=0;
var table_update_del_device_pc = 0;
var table_update_del_other_device = 0;
var DTtable=0;
var Branches = ['chennai','delhi',''];
var form_dialog = null;
var dashBClone = null;

let sql = "select * from ";
const loading_img = '<div style="margin-left:47%;" ><img src="loading.gif" border-radius="50%"</div>';

$(document).ready(function() { 
	$("#users_db").click(()=>{
		if(global_limt==0){
			$("#category_selector").append('<div><select id="todo"><option value="1">activate</option><option value="2">Reject</option> </select></div>');
			global_limt++;
		}
	});
});

function createTable() {
	dashboard_table_device_pc=$('#table_here').DataTable({
		"ajax": {
			url: "worker.php",
			method: "POST",
			data: { get_all_device_pc: 1 },
		},
		scrollY:false,
        scrollX:true,
        scrollCollapse: true,
		"columnDefs": [
		{
			"targets": [ 0 ],
			"visible": false,
			"searchable": false
		},
		{	targets:-1,
				className:"dt-body-center"
		},
		]
	});
}

function dashboardDisplay() {
	var temp = $("#type option:selected").val();
	if (temp == "device_pc") {
		if(dashboard_table_device_pc){
			dashboard_table_device_pc.destroy();
			dashboard_table_device_pc=0;
		}
		else if(dashboard_table_device_other){
			dashboard_table_device_other.destroy();
			dashboard_table_device_other=0;
		}
		const tableHeadings = ['id','asset_number','tag', 'brand','ram','processor','laptop_serial','charger_serial','HD_capacity','model','os','mouse_serial','bag_details','battery/keyboard serial','remarks','used_by'];
		showTable(createTableHeadings(tableHeadings));
		createTable();
}
else if(temp == "device_other"){
	if(dashboard_table_device_other){
		dashboard_table_device_other.destroy();
		dashboard_table_device_other = 0;
	}
	else if(dashboard_table_device_pc){
		dashboard_table_device_pc.destroy();
		dashboard_table_device_pc = 0;
	}
	$("#table_here").empty().append('<thead><tr><th>ID</th><th>Device ID</th><th>Name</th><th>Brand</th><th>Serial</th><th>Other Info</th><th>Used by</th></tr></thead>');
	$('.table_container').show();

	dashboard_table_device_other = $('#table_here').DataTable({
		"ajax": {
			url: "worker.php",
			method: "POST",
			data: { get_all_device_od: 1 },
			"dataSrc": ""
		},
		"columns": [
		{ "data": "id",className:"dt-body-center"  },
		{ "data": "device_id", className:"dt-body-center" },
		{ "data": "name" },
		{ "data": "brand" },
		{ "data": "serial", className:"dt-body-center" },
		{ "data": "other_info",  className:"dt-body-center"}, //table-responsive
		{ "data": "used_by" }

		],
		"columnDefs": [
		{
			"targets": [ 0 ],
			"visible": false,
			"searchable": false
		},		
		{	targets:'_all',
		className:"dt-body-center"
	}
	]

});
}
}

function getAttributes_to_add(){
var temp = $("#addDevice option:selected").val();if(temp == "pc"){
	$("#fields_container").empty();
	$("#fields_container").append('<div class="base"> <div> <form id="survey-form" method="post" action="worker.php"> <label id="deviceid-label">Asset Numer:</label> <input name="asset_number" placeholder="Enter asset number(unique)" autofocus required> <br> <br> <label id="brand-label">Brand:</label> <input type="text" name="brand" placeholder="Enter Brand" required> <br> <br> <label id="brand-label">Tag:</label> <input type="text" name="tag" placeholder="Enter Tag" required> <br> <br> <label id="serial-label">Laptop Serial:</label> <input type="text" name="laptop_serial" placeholder="Laptop Serial(Unique)" required> <br> <br> <label id="serial-label">Mouse Serial:</label> <input type="text" name="mouse_serial" placeholder="Mouse Serial(Unique)"> <br> <br> <label id="cpu-label">Processor:</label> <input type="text" name="processor" placeholder="processor" required> <br> <br> <label id="ram-label">Ram:</label> <input type="text" name="ram" placeholder="ram" required> <br> <br> <label id="charger_serial-label">Charger Serial:</label> <input type="text" name="charger_serial_number" placeholder="Charger Serial(Unique)"> <br> <br> <label id="HD-label">Hard Disk Capacity:</label> <input type="text" name="harddisk_capacity" placeholder="Hard Disk Capacity" required> <br> <br> <label id="model-label">Model:</label> <input type="text" name="model" placeholder="pc/lap model" required> <br> <br> <label id="os-label">OS:</label> <input type="text" name="os" placeholder="os installed" required> <br> <br> <label id="serial-label">Batt/keyboard SNO:</label> <input type="text" name="battery_keyboard_serial" placeholder="Battery/keyboard serial number"> <br> <br> <label id="serial-label">Bag details:</label> <input type="text" name="bag_details" placeholder="Bag details"> <br> <br> <label id="user-label">User:</label> <input type="text" id="addItemsUser" name="device_user" placeholder="Type here o autofill"> <br> <br> <label id="user-label">Remarks:</label> <input type="text" id="addItemsUser" name="remarks" placeholder="Enter remarks"> <br> <br> <button id="submit" type="submit" name="btn_submit_pc" value="submit" class="btn-submit">Submit</button> </form> </div> </div>');	
	userAutoComplete("#addItemsUser");
}
else if(temp =="device"){
	$("#fields_container").empty();
	$("#fields_container").append('<div class="base"><div><form id="survey-form" action="worker.php" method="post"> <label id="deviceid-label">Device-id:</label> <input name="device_id" placeholder="Enter device id(unique)" autofocus required> <br> <br> <label id="Name-label">Name:</label> <input type="text" name="name" placeholder="Name" required> <br> <br> <label id="brand-label">Brand:</label> <input type="text" name="brand" placeholder="Enter Brand" required> <br> <br> <label id="serial-label">Device Serial:</label> <input type="text" name="device_serial" placeholder="Device Serial(Unique)" required> <br> <br> <label id="Otherinfo-label">Other info:</label> <input type="text" name="other_info" placeholder="Extra Info" required> <br> <br> <button id="submit" name="btn_submit_device" class="btn-submit">Submit</button></form></div></div>');
}

}
//table.destroy();

function updateitemsDisplay(){
	var temp = $("#device_update_select option:selected").val();
	if (temp == "device_pc"){
		if(table_update_del_device_pc){
			table_update_del_device_pc.destroy();
			table_update_del_device_pc=0;
		}else if(table_update_del_other_device){
			table_update_del_other_device.destroy();
			table_update_del_other_device=0;
		}
		const tableHeadings = ['id','asset_number','tag', 'brand','ram','processor','laptop_serial','charger_serial','HD_capacity','model','os','mouse_serial','bag_details','battery/keyboard serial','remarks','used_by'];
		showTable(createTableHeadings(tableHeadings));
		table_update_del_device_pc = $('#table_here').DataTable({
			"ajax":{
				url:"worker.php",
				method:"post",
				data:{getdata_updatepage:1}
			},order:[],
			scrollY:false,
        	scrollX:true,
        	scrollCollapse: true,
			columnDefs: [
			{ 
				orderable: false, 
				targets: -1 
			},
			{	targets:-1,
				className:"dt-body-center"
			},
			{
				"targets": [ 0 ],
				"visible": false,
				"searchable": false
			}
			]
		});
	}
	else if (temp=="other_device") {
		if(table_update_del_device_pc){
			table_update_del_device_pc.destroy();
			table_update_del_device_pc=0;
		}else if(table_update_del_other_device){
			table_update_del_other_device.destroy();
			table_update_del_other_device=0;
		}

		$("#table_here").empty().append('<thead><tr><th>ID</th><th>Device ID</th><th>Name</th><th>Brand</th><th>Serial</th><th>Other Info</th><th>Edit/Delete</th></tr></thead>');
		$("#table_here").dataTable().fnDestroy();
		$('.table_container').show();
		table_update_del_other_device = $('#table_here').DataTable({
			"ajax":{
				url:"worker.php",
				method:"post",
				data:{getdata_updatepage_od:1}
			},order:[],
			columnDefs: [
			{ 
				orderable: false, 
				targets: -1 
			},
			{	targets:'_all',
			className:"dt-body-center"
		},
		{
			"targets": [ 0 ],
			"visible": false,
			"searchable": false
		}
		]
	});
	}
}


function updateToserver(){
	var formdata = $("#update-form");
	//debugger;
	var submitdata = 'updaterow=1&';
	submitdata += formdata.serialize();
	console.log(submitdata);
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:submitdata,
		dataType:"json",
		success:function(data){
			if(data==1){
				table_update_del_device_pc.ajax.reload(null,false);
				msgOnDashboard("Updated Successfully");
			}
			else{
				msgOnDashboard("Error Debug :(");
			}
		}
	});
	return false;
}
function updateToserver_loan(){
	var formdata = $("#update-form");
	var submitdata = 'updaterow_loan=1&'
	submitdata += formdata.serialize();
	console.log(submitdata);
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:submitdata,
		dataType:"json",
		success:function(data){
			if(data==1){
				table_update_del_device_pc.ajax.reload(null,false);
				$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Updated Successfully</span>');
			}
			else{
				$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Error Debug :(</span>');
			}
		}
	});
	return false;
}
function getFieldsForUpdate(id){
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:{"updateid":id},
		dataType:"json",
		success:function(data){
			console.log(data);
			$("#dashboard-add").empty().append('<br> <br> <div> <form id="update-form"> <div class="container_update-values"> <div> <label id="asset_number-label">Device-id:</label> <input name="asset_number" id="asset_number" value="'+data.asset_number+'" required> </div> <div> <label id="brand-label">Brand:</label> <input type="text" name="brand" id="device-brand" value="'+data.brand+'" required> </div> <div> <label id="tag-label">tag:</label> <input type="text" name="tag" id="tag" value="'+data.tag+'" required> </div> <div> <label id="serial-label">Laptop-Serial:</label> <input type="text" name="laptop_serial" id="device-serial" value="'+data.laptop_serial+'" required> </div> <div> <label id="serial-label">Mouse-Serial:</label> <input type="text" name="mouse_serial" id="device-serial" value="'+data.mouse_serial+'" required> </div> <div> <label id="serial-label">Batt/keyboard:</label> <input type="text" name="battery_keyboard_serial" id="device-serial" value="'+data.battery_keyboard_serial+'" required> </div> <div> <label id="serial-label">Bag details:</label> <input type="text" name="bag_details" id="device-serial" value="'+data.bag_details+'" required> </div> <div> <label id="Processor-label">Processor:</label> <input type="text" name="processor" id="device-cpu" value="'+data.processor+'" required> </div> <div> <label id="ram-label">Ram:</label> <input type="text" name="ram" id="device-ram" value="'+data.ram+'" required> </div> <div> <label id="serial-label">Remarks:</label> <input type="text" name="remarks" id="remarks" value="'+data.remarks+'" required> </div> <div> <label id="charger_serial-label">Charger Serial:</label> <input type="text" name="charger_serial_number" id="charger-serial" value="'+data.charger_serial_number+'"> </div> <div> <label id="HD-label">Hard Disk:</label> <input type="text" name="harddisk_capacity" id="device-hd" value="'+data.hard_disk_capacity+'" required> </div> <div> <label id="model-label">Model:</label> <input type="text" name="model" id="device-model" value="'+data.model+'" required> </div> <div> <label id="os-label">OS:</label> <input type="text" name="os" id="device-os" value="'+data.os+'" required> </div> <div> <input type="hidden" value="'+data.id+'" name="id_seq" /> </div> </div> <button id="update-submit" onclick="return updateToserver()" class="update-submit">update</button> </form> </div>');
		}
	});

}
function getFieldsForUpdate_loan(id){
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:{"updateid_loan":id},
		dataType:"json",
		success:function(data){
			console.log(data);
			$("#dashboard-add").empty().append('<span>Type in the textBox For AutoFill</span> <br><br><br><div><form id="update-form"><div class="container_update-values ui-widget"> <div><label id="used-by-label">Used by:</label> <input type="text" name="used_by" style="width:160px" id="usd2"></div><div><input type="hidden" value="'+data.id+'" name="id_seq" /></div></div>  <button id="update-submit" onclick="return updateToserver_loan()" class="update-submit">update</button></form></div>');
			userAutoComplete("#usd2"); 
		}
	});

}

function userAutoComplete(paramElement){	
	$(paramElement).autocomplete({
		source:function(req,res){
		$.ajax({
			url:"worker.php",
			dataType:"json",
			data:{"userL":req.term},
			success:function(x){
				console.log(x);
				res(x);

			}
		});
		},
		minLength:2
	});
}
function deleteFieldsForUpdate(id){
	if (confirm("Are you sure to delete!!")) {
		$.ajax({
			url:"worker.php",
			method:"post",
			data:{"deleteid":id},
			dataType:"json",
			success:function(data){
				if(data==1){
					table_update_del_device_pc.ajax.reload(null,false);
					$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Deleted Successfully!!!</span>');
				}else{	
					console.log("error debug :( ");
				}
			}
		});

	} else {
		console.log("cancelled!");
	}
}

//submit onclick...
function updateToserver_od(){
	var formdata = $("#update-form");
	//debugger;
	var submitdata = 'updaterow_=1&'
	submitdata += formdata.serialize();
	console.log(submitdata);
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:submitdata,
		dataType:"json",
		success:function(data){
			if(data==1){
				table_update_del_other_device.ajax.reload(null,false);
				$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Updated Successfully</span>');
			}
			else{
				$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Error Debug :( <br> Most probably you didnt enter a unique id</span>');
			}
		}
	});
	return false;
}

function updateToserver_od_loan(){
	var formdata = $("#update-form");
	//debugger;
	var a = $('#usd3').val();
	var b = $('#usd4').val();
	if(a!==b){
		alert("Fields doesnt not match");
		return false;
	}
	var submitdata = 'updaterow_loan_od=1&'
	submitdata += formdata.serialize();
	console.log(submitdata);
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:submitdata,
		dataType:"json",
		success:function(data){
			if(data==1){
				table_update_del_other_device.ajax.reload(null,false);
				$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Updated Successfully</span>');
			}
			else{
				$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Error Debug :( <br> Most probably you didnt enter a unique id</span>');
			}
		}
	});
	return false;
}



function getFieldsForUpdate_od(id){
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:{"updateid_od":id},
		dataType:"json",
		success:function(data){
			console.log(data);
			$("#dashboard-add").empty().append('<br> <br><div><form id="update-form"><div class="container_update-values"><div> <label id="deviceid-label">Device-id:</label> <input name="device_id" id="device-id" value="'+data.device_id+'" required></div><div> <label id="name-label">Name:</label> <input type="text" name="name" id="device-name" value="'+data.name+'" required></div><div> <label id="brand-label">Brand:</label> <input type="text" name="brand" id="device-brand" value="'+data.brand+'" required></div><div> <label id="serial-label">Device-Serial:</label> <input type="text" name="device_serial" id="device-serial" value="'+data.serial+'" required></div><div> <label id="other_info-label">Other Info:</label> <input type="text" name="other_info" id="device-other_info" value="'+data.other_info+'" required></div><div> <input type="hidden" value="'+data.id+'" name="id_seq" /></div></div> <button id="update-submit" onclick="return updateToserver_od()" class="update-submit">update</button></form></div>');
		}
	});

}

function getFieldsForUpdate_od_loan(id){
	$("#dashboard-add").empty().append(loading_img);
	$.ajax({
		url:"worker.php",
		method:"post",
		data:{"updateid_od":id},
		dataType:"json",
		success:function(data){
			console.log(data);
			$("#dashboard-add").empty().append('<span>For confirmation you need to type twice</span> <br><br><br><div><form id="update-form"><div class="container_update-values"><div> <label id="usedby-label">used_by:</label> <input type="text" name="used_by" id="usd4" value="'+data.used_by+'"></div><div><label>Type Again:</label> <input type="text" name="used_by" id="usd3"></div><div> <input type="hidden" value="'+data.id+'" name="id_seq" /></div></div> <button id="update-submit" onclick="return updateToserver_od_loan()" class="update-submit">update</button></form></div>');
		}
	});

}

function deleteFieldsForUpdate_od(id){
	if (confirm("Are you sure to delete!!")) {

		$.ajax({
			url:"worker.php",
			method:"post",
			data:{"deleteid_od":id},
			dataType:"json",
			success:function(data){
				if(data==1){
					table_update_del_other_device.ajax.reload(null,false);
					$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">Deleted Successfully!!!</span>');
				}else{	
					console.log("error debug :(");
				}
			}
		});

	} else {
		console.log("cancelled!");
	}
}



function updateitemsDisplay_loan(){
	var temp = $("#device_update_select option:selected").val();
	if (temp == "device_pc"){
		if(table_update_del_device_pc){
			table_update_del_device_pc.destroy();
			table_update_del_device_pc=0;
		}else if(table_update_del_other_device){
			table_update_del_other_device.destroy();
			table_update_del_other_device=0;
		}
		ManageDevices("used");
	}
	else if (temp=="stock") {
		if(table_update_del_device_pc){
			table_update_del_device_pc.destroy();
			table_update_del_device_pc=0;
		}else if(table_update_del_other_device){
			table_update_del_other_device.destroy();
			table_update_del_other_device=0;
		}
		ManageDevices("stock");
	}
}


function getUsersList(){

	$.ajax({
		url:"worker.php",
		method:"post",
		data:{"getRegisteredUsers":1},
		dataType:"json",
		beforeSend:(x)=>{
			$("#users_db").html("<option> loading ... </option>");
		},
		success:(x)=>{
			$("#users_db").empty().append('<option value="" disabled selected>users</option>');
			for(a in x){
				$("#users_db").append('<option value="'+x[a]['user_name']+'">'+x[a]['user_name'] +'</option>')
			}	
		}
	});
}



function manageUsersFunc(){
	var user = $('#users_db').val();
	var selected = $('#todo').val();
	if(selected ==1){
		if(confirm("Are you sure to activate" + " '"+user+"'<= this user? "))
		{

			$.ajax({
				url:"worker.php",
				method:"post",
				data:"userapprovestatus="+selected+"&user="+user,
				dataType:"json",
				success:(x)=>{
					if(x==1){
						alert('user Approved');	
						getUsersList();			
					}
					else{
						alert('There was an error processing the request! debug!!')
					}
				}
			});
		}
		else{
			console.log('cancelled!');
		}
	}
	else if(selected ==2){
		if(confirm("Are you sure to reject" + " '"+user+"'<= this user? ")){
			$.ajax({
				url:"worker.php",
				method:"post",
				data:"userapprovestatus="+selected+"&user="+user,
				dataType:"json",
				success:(x)=>{
					if(x==1){
						alert('user Rejected!');	
						getUsersList();			
					}
					else{
						alert('There was an error processing the request! debug!!')
					}
				}
			});
		}
		else{
			console.log('rejcted!!');
		}
	}
}

/*
Section below for new requirements.
*/
function getDeviceUsers(){
	const payload = { "getDeviceUsers": 1 };
	const tableHeadings = ['Serial','Users','Branch', 'Action']

	if(DTtable){
		destroyDataTable();
	}
	showTable(createTableHeadings(tableHeadings));
	ajaxCallGetUsers(payload);
}


function destroyDataTable(){
	DTtable.destroy();
	DTtable=0;
}

function createTableHeadings(paramHeadings){
	var tableRowFormat = '<thead><tr>'
	paramHeadings.forEach(function(element) {
		tableRowFormat += '<th>' + element + '</th>';
	});
	return tableRowFormat += '</tr></thead>';
}

function showTable(paramHeadings){
	$("#table_here").empty().append(paramHeadings);
	$('.table_container').show();
}

function ajaxCallGetUsers(paramPayload){
	DTtable = $('#table_here').DataTable({
			"ajax": {
				url: "worker.php",
				method: "POST",
				data: paramPayload,
			},
			columnDefs: [
				{	targets:'_all',
					className:"dt-body-center"
				}
			]
		});
} 

function mapUser(paramUser){
	_dashClone();
	$("#dashboard-add").empty().append(getChunkUI(paramUser));
	$("#map-user-branch").autocomplete({"source":Branches});
}

function getChunkUI(chunk){
	return '<div class="w-400 make-center"><span>Map User</span> <span class="ml-10" id="user-to-map" user="'+chunk+'"> " '+chunk+' "	</span> <input class="ml-20 generic_search" placeholder="Type the Branch" type="text" id="map-user-branch" name="branch-mapping"></div><br><div class="make-center"><button class="update-submit" id="mapUserSubmit" onclick="mapTrigger()" style="margin-left:40%">Map User</button></div>';
}

function mapTrigger(){
	var userVal = $("#user-to-map").attr('user');
	var branchMapping = $("#map-user-branch").val();
	var payload = {"mapUser":userVal,"branch":branchMapping};
	if(!Branches.includes(branchMapping)){
		createDialog('Error','Entered branch does not exist!')
		triggerDialog();
	}
	CajaxRequest("worker.php","POST",payload,"afterUserMappingCallback");
}

function createDialog(paramTitle,paramMsg,paramHtmlContent=null,paramId = "dialog-message"){
	var htmlContent
	if(paramHtmlContent == null)
		htmlContent = '<div id="'+paramId+'" title="'+paramTitle+'"><p>'+paramMsg+'</p></div>';
	else
		htmlContent = '<div id="'+paramId+'" title="'+paramTitle+'">'+paramHtmlContent+'</div>';
	if(isElementPresentInDom(paramId)){
		$("#"+paramId).remove();
	}
	$("body").append(htmlContent);
}

function triggerDialog(){
	$( "#dialog-message" ).dialog({
      modal: true,
    });
}

function isElementPresentInDom(paramElementId){
	 if($("#"+paramElementId).length > 0){
	 	return true;
	 }
	 return false;
}

function CajaxRequest(paramUrl,paramMethod,paramPayload,paramCallBackfunction){
	$.ajax({
		url:paramUrl,
		method:paramMethod,
		data:paramPayload,
		dataType:"json",
		success:(x)=>{
			window[paramCallBackfunction](x);
		}
	});
}

function afterUserMappingCallback(paramStatus,successMsg="User Was Mapped",failureMsg="There was error mapping the user"){
	if(paramStatus){
		createDialog("Success",successMsg);
		triggerDialog();
		DTtable.ajax.reload(null,false);
		$("#dashboard-add").empty().append(dashBClone);
	}
	else{
		createDialog("Error",failureMsg);
		triggerDialog();
		
	}
}

function addDeviceUser(){
	var blob = '<form><br><label style = "display:inline-block" class="ml-20" >Name/id</label><input type="text" id="device_user_name" placeholder="Enter name/id" style = "display:inline-block;background-color:white!important;color:black!important;width:auto;" class="ml-20 text ui-widget-content ui-corner-all generic_search"></form>';
	createDialog("Add User",null,blob,"dialog-form");
	formDialogTrigger();
}

function formDialogTrigger(){
	form_dialog = $( "#dialog-form" ).dialog({
      autoOpen: false,
      height: 200,
      width: 350,
      modal: true,
      buttons: {
        "Create User": cDU
      },
      close: function() {
        form[ 0 ].reset();
      }
    });
 
    form = form_dialog.find( "form" ).on( "submit", function( event ) {
      event.preventDefault();
      cDU();
    });
    form_dialog.dialog( "open" );
}

function cDU(){
	var deviceUserName = $("#device_user_name").val();
	var payload = {"nDeviceUser":deviceUserName};
	if(!deviceUserName && deviceUserName == ""){
		createDialog("Error","Please Enter something.");
		triggerDialog();
		return false;
	}
	CajaxRequest("worker.php","POST",payload,"afterCDUCallback");
	form_dialog.dialog("close");
	return true;
}

function afterCDUCallback(paramStatus){
	afterUserMappingCallback(paramStatus,"User Was Successfully Added", "There was an error, try again.");
}

function msgOnDashboard(paramMsg){
	$("#dashboard-add").empty().append('<span style="background-color: yellow; color: black;">' +paramMsg+'</span>');
}
function _dashClone(){
	dashBClone = $("#dashboard-add").children().clone();
}

function ManageDevices(paramType){
	var payload = {"getdata_updatepage_loan":1}
	if(paramType == "stock")
		payload = {"getdata_updatepage_loan":1,"onlyStock":1};
	$("#table_here").empty().append('<thead><tr><th>ID</th><th>Device ID</th><th>Brand</th><th>Device Serial</th><th>Charger Serial</th><th>Model</th><th>Used by</th><th>Assign/Receive</th></tr></thead>');	
		$("#table_here").dataTable().fnDestroy();
		$('.table_container').show();
		table_update_del_device_pc = $('#table_here').DataTable({
			"ajax":{
				url:"worker.php",
				method:"post",
				data:payload,
			},order:[],
			columnDefs: [
			{ 
				orderable: false, 
				targets: -1 
			},
			{	targets:-1,
				className:"dt-body-center"
			},
			{
				"targets": [ 0 ],
				"visible": false,
				"searchable": false
			}
			]
		});
}

/*
dont enable untill tooltip is fixed
 $( function() {
    $( document ).tooltip();
  } );

 */