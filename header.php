<?php 

if(empty(@$_SESSION['user_name'])){   
	ob_start();
    header("Location: index.php");
    ob_end_flush();
    die();
}


 ?>

<div class="header-container">
 	<header id="header">
 		<div class="h-title">
 			Infra Management System
 		</div>
 		<div class="h-user-details">
 			<div>
 				<div class="h-user_name">
 				logged in as:<?php echo " ".$_SESSION['user_name'];?>
 				</div>
 				<div class="h-user_logout">
 				<span onclick="window.location='redirect.php'">logout</span>
 				</div>
 			</div>
 		</div>
 	</header>
</div>