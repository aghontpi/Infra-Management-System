<div class="sidebar">
	<div class="ul-container">
		<div class="ul" >
			<ul>
				<li class="li-active">
					<a href="users.php"><span class="container-cate">
						DashBoard
					</span></a>
				</li>
				<li ><a href="users.php?id=add"><span class="container-cate">
					Add new Items
				</span></a></li>
				<li><a href="users.php?id=update"><span class="container-cate">
					Edit/Update Items
				</span></a></li>
				<li> <a href="users.php?id=loan"><span class="container-cate">
					Loan Items
				</span></a></li>
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
				This is the admin dashboard, here you can view and approve new reqistrations, view current items that are loned for employees and search for an item based on category.<br>
			</span>
			<span>
				New user registrations to approve :
			</span>
		</div>
		<div class="search-container">
			<div class="search" id="category_selector">
				<div>
					<select name="type" id="type">
						<option value="" disabled selected>Type?</option>
						<option value="device_pc">Device PC</option>
						<option value="device_other">Other Devices</option>
					</select>
				</div>
			</div>
			<div class="search-go">
				<span id="search_button"  name="search_btn" onclick="dashboardDisplay()" >Go</span>
			</div>
		</div>
		<div class="table_container" style="display: none">
			<div class="data-table">
				<table id="table_here" class="display hover " style="width:100%;">
				</table>

			</div>
		</div>
	</div>
</div>
