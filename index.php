<?php 
session_start();
include('Database.php');

if(!empty(@$_SESSION['user_name'])){   
    header("Location: users.php");    
}

if(isset($_POST["login"])){
	$dataBase = new DB;
	if (isset($_POST["username"]) && isset($_POST["password"]))
	{  
		$uname = $_POST["username"];
		//echo "user name provided" . $uname;
		$password = $_POST["password"];	
		$retrieveUser = "SELECT uid,user_name,pwd FROM users WHERE user_name='$uname'";
		$data = $dataBase->getQuery($retrieveUser);
		checkuser($data,$password,$uname);
	}
}

function checkuser($temp,$pd,$un){
$temp_arr = $temp->fetchall(PDO::FETCH_ASSOC);
if(count($temp_arr)==0){
	$_SESSION['error'] = "User Name or Password Error";
}
else{
	$some = $temp_arr[0]['pwd'];
	//echo password_verify($pd,$some)? 'true' : 'false' ;
	if(password_verify($pd,$some)){
		unset($_SESSION["error"]);	
		$_SESSION['user_name'] = $temp_arr[0]['user_name'];
        $dataBase = new DB;
        date_default_timezone_set('Asia/Kolkata');
        $my_date = date("Y-m-d H:i:s");
        $sqlInsert = "UPDATE users SET last_login='$my_date' WHERE user_name = '{$_SESSION['user_name']}'";
        $dataBase->runQuery($sqlInsert);
		ob_start();
		header("Location: users.php");
		ob_end_flush();
		die();
	}
	else{
		$_SESSION['error'] = "User Name or Password Error";
	}
	
}

}

 ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>InfraStructure Management</title>
    <meta name="description" content="Customised InfraStructure Management Software for Organisation">
    <meta name="author" content="Gopinath">
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/skeleton.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="sixteen columns" style="margin-top:20%">
                <div class="four columns offset-by-four">
                    <form class="login-form" method="post" >
                        <div>
                            <span class="title-div">Infra Management Sys</span>
                            <div class="row">
                                <div class="column">
                           		<?php if(!empty(@$_SESSION['error'])): ?>
    							<div style="background-color: yellow">
        						<strong><center>Username or password is incorrect!</center></strong>
    							</div>
								<?php endif; ?>    
                                    <label for="uid">UserName</label>
                                    <input type="text" name="username" id="uid" class="u-full-width" required="true">
                                    <label for="pwd">Password</label>
                                    <input type="password" id="pwd" class="u-full-width" name="password" required="true">
                                    <div class="btns">
                                    	<div class="login_btn"><input type="submit" name ="login" class="button-primary" value="Login"></div>
                                    	<div class="register_btn"><input type="button" onclick="window.location='register.php'" value="Register"></div>
                                    </div>                                                             
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>