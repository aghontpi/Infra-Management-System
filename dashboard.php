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
			This is the admin dashboard, here you can view and approve new reqistrations, view current items that are loned for employees and search for an item based on category.<br>
		</span>
		<span>
			New user registrations to approve :
		</span>
	</div>
	<div class="search-container">
		<div class="search" id="category_selector">
			 <div><select name="What" id="what">
			 	<option value="" disabled selected>What?</option>
    			<option value="user">Users</option>
    			<option value="device">Devices</option>
  			</select>
  			</div>	
		</div>
		<div class="search-go">
			<span id="search_button"  name="search_btn" onclick="dashboardDisplay()" >Go</span>
		</div>
	</div>
	<div class="table_container" style="display: none">
			<div class="data-table">
			<table id="table_here" class="display hover" style="width:100%;">
			<thead>
            <tr>
                <th>id</th>
                <th>device_id</th>
                <th>brand</th>
                <th>device serial.</th>
                <th>cpu</th>
                <th>ram</th>
                <th>charger serial</th>
                <th>Hard Disk</th>
                <th>model</th>
                <th>os</th>
                <th>used by</th>
            </tr>
        	</thead>
			</table>

			</div>
		</div>
	</div>
</div>
