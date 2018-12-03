<?php   
include('Database.php');
require('config/conf.php');
session_start();

$pdo = new PDO("mysql:host=$hostname;dbname=$dbName", $username, $password, $options);
$dataBase = new DB;

if(isset($_POST["submit"])){
$dataBase = new DB;
$uname = $_POST["username"];
$retrieveUser = "SELECT user_name FROM users WHERE user_name='$uname'";
$data = $dataBase->getQuery($retrieveUser);
$temp_arr = $data->fetchall(PDO::FETCH_ASSOC);
if(count($temp_arr)==1){
    $_SESSION['status'] = "username_exists";
}
else{
$hashpwd = password_hash($_POST["password"], PASSWORD_DEFAULT);
$row = [
    'username' => $_POST["username"],
    'pwd' => $hashpwd
];
$sql = "INSERT INTO users SET user_name=:username, pwd=:pwd;";
$status = $pdo->prepare($sql)->execute($row);
if ($status) {
    $lastId = $pdo->lastInsertId();
    $_SESSION['status'] = "success";
}
}
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Register</title>
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
                           		<?php if(@$_SESSION['status']==="success"): ?>
    							<div style="background-color: yellow">
        						<strong><center>You have successfully registered!</center></strong>
    							</div>
								<?php endif; ?>
                                <?php if(@$_SESSION['status']==="username_exists"): ?>
                                <div style="background-color: red">
                                <strong><center>Username is already taked</center></strong>
                                </div>
                                <?php endif; ?>
                                    <label for="uid">UserName</label>
                                    <input type="text" name="username" id="uid" class="u-full-width" required="true">
                                    <label for="pwd">Password</label>
                                    <input type="password" id="pwd" class="u-full-width" name="password" required="true">
                                    <div class="btns">
                                    	<div class="login_btn"><input type="submit" name ="submit" class="button-primary" value="submit"></div>
                                        <?php if(@$_SESSION['status']==="success"): ?>
                                        <div class="register_btn"><input type="button" onclick="window.location='redirect.php'"  value="Go to Login"></div>
                                        <?php endif; ?>
                                        <?php if(@$_SESSION['status']==="username_exists"): ?>
                                        <div class="register_btn"><input type="button" onclick="window.location='redirect.php'"  value="Go to Login"></div>
                                        <?php endif; ?>
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