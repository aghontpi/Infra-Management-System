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
</head>
<body style="background-color:#083045;">
	<?php include("header.php"); ?>
	<?php include("sidebar.php"); ?>
	<?php include("dashboard.php"); ?>
</body>
</html>