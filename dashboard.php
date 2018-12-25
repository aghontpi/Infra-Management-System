<?php 


if(empty(@$_SESSION['user_name'])){   
	ob_start();
    header("Location: index.php");
    ob_end_flush();
    die();
}




 ?>


<div class="sidebar">
	<div class="ul-container">
		<div class="ul" >
			<ul>
				<li class="li-active">
					<a href="users.php"><span class="container-cate">
						DashBoard
					</span><span class="approve-users" id="approve_count"><?php echo "<span>" .$count. "</span>" ?></span></a>
				</li>
				<li ><a href="users.php?id=add"><span class="container-cate">
					Add new Items
				</span></a></li>
				<li><a href="users.php?id=update"><span class="container-cate">
					Edit/Update Items
				</span></a></li>
				<li> <a href="users.php?id=loan"><span class="container-cate">
					Give/Get Items
				</span></a></li>
				<li><a href="users.php?id=device_users"><span class="container-cate">
					Device Users
				</span></a></li>				
				<li><a href="users.php?id=verify"><span class="container-cate">
					Approve users
				</span></a></li>
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
				New user registrations to approve : <?php echo "<span> " .$count. "</span>" ?>
			</span>
		</div>
		<div class="search-container">
			<div class="search" id="category_selector">
				<div>
					<select name="type" id="type">
						<option value="device_pc">Devices PC</option>
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
