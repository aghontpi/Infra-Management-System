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
				<li >
					<a href="users.php"><span class="container-cate">
						DashBoard
					</span><span class="approve-users" id="approve_count"><?php echo "<span>" .$count. "</span>" ?></span></a>
				</li>
				<li ><a href="users.php?id=add"><span class="container-cate">
					Add new Items
				</span></a></li>
				<li class="li-active"><a href="users.php?id=update"><span class="container-cate">
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
		<div class="dashboard"  id="dashboard-add"">
			<br>
			<span>
				Here you can update the items present on the database with ease, just select your requirements and click go button then proceed from there on. ...thanks!
			</span>
			<br>
			<span>You can update from two tables just choose what is your necessary table.. (computer-lap/other devices)</span>
			<br>
			<span>and finally... use the delete option with caution. it permenently deletes it</span>

		</div>
		<div class="search-container">
			<div class="search" id="category_selector">
				<div><select name="update_select" id="device_update_select">
					<option value="device_pc">Device PC</option>
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

			</table>

		</div>
	</div>
</div>
</div>
