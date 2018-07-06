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
				<li class="li-active" >
					<a href="users.php?id=add"><span class="container-cate">
					Add new Items
				</span></a></li>
				<li><a href="users.php?id=update"><span class="container-cate">
					Edit/Update Items
				</span></a></li>
				<li><a href="users.php?id=load"><span class="container-cate">
					Loan Items
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
			<?php if(empty(@$_SESSION['add_status'])):?>
			There are two categorys. Choose pc or Other devices <br><br>

			Choose appropriate option then click on get field to further proceed.
			<?php endif; ?> 
			
			<?php if(!empty(@$_SESSION['add_status'])):?>
				<?php 
				$ts = $_SESSION['add_status'];
				unset($_SESSION['add_status']);	
				?>
				<span style="background-color: yellow; color: black;"><?php echo $ts; ?></span>
			<?php endif; ?>    
		</span>
	</div>
	<div class="search-container">
		<div class="search" id="category_selector">
			 <div><select name="addDevices" id="addDevice">
			 	<option value="" disabled selected>What?</option>
    			<option value="pc">PC</option>
    			<option value="device">Other Devices</option>
  			</select>
  			</div>	
		</div>
		<div class="search-go">
			<span id="add" name="add" class="btnright" onclick="getAttributes_to_add()" >Get Fields</span>
		</div>
	</div>
	
	<div id="fields_container">

	</div>
</div>
