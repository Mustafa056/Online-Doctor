<?php
//include "includes/db_connect.inc.php";
include 'Connection.php';
$conn=new Connection;
session_start();
$password = $userid =$status = $message = "";

/* mysqli_real_escape_string() helps prevent sql injection */
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	/*
	if(!empty($_POST['userid'])){
		$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	}
	if(!empty($_POST['password'])){
		$password = mysqli_real_escape_string($conn, $_POST['password']);
	}*/

	$userid=$_POST['userid'];
	$password=$_POST['password'];

	$sqlUserCheck =$conn->login( "SELECT * FROM users WHERE userid = '$userid'");

	//$result = mysqli_query($conn, $sqlUserCheck);
	//$rowCount = mysqli_num_rows($result);

	//if($rowCount < 1){
	  if(count($sqlUserCheck)){
		//$message = "User does not exist!";
		foreach ($sqlUserCheck as $row) {
			$passwordDB = $row['password'];
			$status = $row['status'];

			if(password_verify($password, $passwordDB)){
				if($status == 1){
					$_SESSION['userid'] = $userid;
					header("Location: Admin_Home_Page.php");
				}else if($status == 2){
					$_SESSION['userid'] = $userid;
					header("Location: Doctor_Home_Page.php");
				}else{
					$_SESSION['userid'] = $userid;
					header("Location: Patient_Home_Page.php");
				}
			}
			else{
				$message = "Wrong Password!";
			}
		}
	}
	else{
		$message = "User does not exist!";
		
	}






}

?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
     <link rel="stylesheet" href="./css/login.css">
  </head>
  <body>
    <form action="login.php" method="post">
      


      <div class="login-box">
  <h1>Welcome</h1>
  <div class="textbox">
    <i class="fas fa-user"></i>
    <input type="text" name="userid" placeholder="Username" required>
  </div>

  <div class="textbox">
    <i class="fas fa-lock"></i>
    <input type="password" name="password" placeholder="Password" required>
  </div>

   <button type="submit" name="login" class="btn">Login</button>
  <span style="color:red"><?php echo $message; ?></span><br>
  <span><b>Or Register <a href="homepage.php">here</a></b></span>
  
</div>


    </form>
  </body>
</html>
