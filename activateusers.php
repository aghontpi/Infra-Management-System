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
				<li><a href="users.php?id=update"><span class="container-cate">
					Edit/Update Items
				</span></a></li>
				<li> <a href="users.php?id=loan"><span class="container-cate">
					Loan Items
				</span></a></li>
				<li><a href="users.php?id=device_users"><span class="container-cate">
					Device Users
				</span></a></li>				
				<li class="li-active"> <a href="users.php?id=verify"><span class="container-cate">
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
				Hello! This page allows to activate accounts of new users! U HAVE THE POWER!! <br>
				But <b><i>only</i> 'admin'</b> can activate user accounts.. 
			</span>
			<br>
			<?php if(@$_SESSION['user_name'] !="admin"): ?>
			<span><b>EDITING OPTIONS ARE ENABLED AND SHOWN ONLY TO 'admin' ACCOUNT</b></span>
			<?php endif; ?> 

		</div>
		<?php if(@$_SESSION['user_name'] =="admin"): ?>
		<div class="search-container">
			<div class="search" id="category_selector">
				<div><select name="users" id="users_db">
					<option value="" disabled selected>users</option>
					<script>$(document).ready(()=>{getUsersList();})</script>
				</select>
			</div>	
		</div>
		<div class="search-go">
			<span id="search_button"  name="search_btn" onclick="manageUsersFunc()" >Go</span>
		</div>
	</div>
	<?php endif; ?> 
	<div class="table_container" style="display: none">
		<div class="data-table">
			<table id="table_here" class="display" style="width:100%;">
				
			</table>
		</div>
	</div>
</div>
