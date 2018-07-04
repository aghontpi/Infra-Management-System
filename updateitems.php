<div class="sidebar">
	<div class="ul-container">
		<div class="ul" >
			<ul>
				<li >
					<a href="users.php"><span class="container-cate">
					DashBoard
					</span></a>
				</li>
				<li ><a href="users.php?id=add"><span class="container-cate">
					Add new Items
				</span></a></li>
				<li class="li-active"><a href="users.php?id=update"><span class="container-cate">
					Update Items
				</span></a></li>
				<li><span class="container-cate">
					Loan Items
				</span></li>
				<li><span class="container-cate">
					Approve users
				</span></li>
			</ul>
		</div>
	</div>

</div>



<div class="dashboard-container">
	<div class="overall-container">
	<div class="dashboard">
		<span>
			Here you can update the items present on the database with ease, just select your requirements and click go button then proceed from there on. ...thanks!<br>
		</span>
		<br><br>
		<div>
		<form id="update-form">
			<div class="container_update-values">
				<div><label id="deviceid-label">Device-id:</label>
				<input name="device_id" id="device-id" required></div>
				<div><label id="brand-label">Brand:</label>
				<input type="text" name="brand" id="device-brand" required></div>
				<div><label id="serial-label">Device-Serial:</label>
				<input type="text" name="device_serial" id="device-serial" required></div>

				<div><label id="cpu-label">Cpu:</label>
				<input type="text" name="cpu" id="device-cpu" required></div>
				<div><label id="ram-label">Ram:</label>
				<input type="text" name="ram" id="device-ram" required></div>
				<div><label id="charger_serial-label">Charger Serial:</label>
				<input type="text" name="charger_serial" id="charger-serial" ></div>


				<div><label id="HD-label">Hard Disk Capacity:</label>
				<input type="text" name="harddisk_capacity" id="device-hd" required></div>  
				<div><label id="model-label">Model:</label>
				<input type="text" name="model" id="device-model" required></div>
				<div><label id="os-label">OS:</label>
				<input type="text" name="os" id="device-os" required></div>
			</div>
          <br>
                              
          <button id="update-submit" onclick="return updateToserver()" class="update-submit">update</button>
        </form>
		</div>



	</div>
	<div class="search-container">
		<div class="search" id="category_selector">
			 <div><select name="update_select" id="device_update_select">
			 	<option value="" disabled selected>What?</option>
    			<option value="device_pc">Device PC</option>
    			<option value="other_device">Other Devices</option>
  			</select>
  			</div>	
		</div>
		<div class="search-go">
			<span id="search_button"  name="search_btn" onclick="updateitemsDisplay()" >Go</span>
		</div>
	</div>
	<div class="table_container" style="display: none">
		<div class="data-table">
			<table id="table_here" class="display" style="width:100%;">
				<thead>
					<tr>
						<th>Device ID</th>
						<th>Brand</th>
						<th>Device Serial</th>
						<th>CPU</th>
						<th>RAM</th>
						<th>Charger Serial</th>
						<th>Model</th>
						<th>Os</th>
						<th>Edit?</th>
					</tr>
				</thead>
			</table>

		</div>
	</div>
</div>
</div>
