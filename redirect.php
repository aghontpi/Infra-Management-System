<?php 
session_start();
ob_start();
header("Location: index.php");
ob_end_flush();
session_destroy();
die();

 ?>