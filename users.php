<?php 
session_start();
include('Database.php');

if(empty(@$_SESSION['user_name'])){   
	ob_start();
    header("Location: index.php");
    ob_end_flush();
    die();
}

//echo "welcome " .  $_SESSION['user_name']; 

?>
<!DOCTYPE html>
<html>
<head>
	<title>Management</title>
	<meta name="description" content="Customised InfraStructure Management Software for Organisation">
    <meta name="author" content="Gopinath">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Yatra+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
	<link rel="stylesheet" href="css/main.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
	<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
 	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.jqueryui.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.jqueryui.min.js"></script>
</head>
<body style="background-color:#083045;">
	<?php include("header.php"); ?>
	<?php

	if(!empty($_GET['id'])){
		$id=$_GET['id'];
		if($id=="add")
		{
			include("addnew.php");
		}
		elseif ($id=="update") {
			include("updateitems.php");
		}
		elseif ($id=="loan") {
			include("loanitems.php");
		}

		else {
			echo 'Page not Found';
		}
	}else{
		include('dashboard.php');   
	} 

	?>

</body>
</html>