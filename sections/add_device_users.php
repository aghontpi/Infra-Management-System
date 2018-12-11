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
				<li>
					<a href="users.php?id=add"><span class="container-cate">
					Add new Items
				</span></a></li>
				<li><a href="users.php?id=update"><span class="container-cate">
					Edit/Update Items
				</span></a></li>
				<li><a href="users.php?id=loan"><span class="container-cate">
					Loan Items
				</span></a></li>
				<li class="li-active"><a href="users.php?id=device_users"><span class="container-cate">
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
			<?php if(empty(@$_SESSION['add_status'])):?>
			Here You can create Device Users<br><br>

			Add them to branch etc.
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
	</div>
		
	<div id="fields_container">
		<div class="btns-primary">
			Add Device Users
		</div>
	</div>
</div>
