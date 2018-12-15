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
				<li ><a href="users.php?id=update"><span class="container-cate">
					Edit/Update Items
				</span></a></li>
				<li class="li-active"><a href="users.php?id=loan"><span class="container-cate">
					Loan Items
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
		<div class="dashboard"  id="dashboard-add">
			
			<span>
				Assign computer/lap and other devices to user id here.
			</span>
			<br>
			<span>Just choose the nessary category!.</span>

		</div>
		<div class="search-container">
			<div class="search" id="category_selector">
				<div><select name="update_select" id="device_update_select">
					<option value="" disabled selected>What?</option>
					<option value="device_pc">Devices</option>
					<option value="stock">Stock</option>
				</select>
			</div>	
		</div>
		<div class="search-go">
			<span id="search_button"  name="search_btn" onclick="updateitemsDisplay_loan()" >Go</span>
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
