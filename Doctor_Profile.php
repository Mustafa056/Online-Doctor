<?php

  include "includes/db_connect.inc.php";
  include 'Connection.php';
  $con=new Connection;
  session_start();
  $passwordDB=$userid="";

  $userid=$_SESSION["userid"];
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }
  
  $holdAllData =$con->getAll("SELECT * FROM doctors WHERE userid = '$userid'");
  $holdLoginData =$con->getAll("SELECT * FROM users WHERE userid = '$userid'");
  foreach ($holdLoginData as $Data) {
    $passwordDB = $Data['password'];
    //$s = $Data['status'];
  }
  
  //$result = mysqli_query($conn, $holdAllData);
  //$getDataa = mysqli_fetch_assoc($result);

  $con_password=$temp_password=$pass_error=$userid_error=$pass_errorr= "" ;
  $name=$gender=$phoneNumber=$email=$dateOfBirth=$divission=$district=$thana=$specialty=$degree=$bmdcRegNo=$description=$password=$oldPassword=$doctorArrayData=$userArrayData="";
	
	
	/* mysqli_real_escape_string() helps prevent sql injection */
  
  if($_SERVER["REQUEST_METHOD"]=="POST"){

    $userid = $_POST['userid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];  
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $dateOfBirth = $_POST['dateOfBirth'];
    $divission = $_POST['divission']; 
    $district = $_POST['district'];
    $thana = $_POST['thana'];
    $specialty = $_POST['specialty'];
    $degree = $_POST['degree'];
    $bmdcRegNo = $_POST['bmdcRegNo'];
    $description = $_POST['description'];
    $oldPassword= $_POST['oldPassword'];
    $password= $_POST['password'];
    $con_password= $_POST['con_password'];
 
    //Password  ->https://www.sitepoint.com/hashing-passwords-php-5-5-password-hashing-api/
    if(password_verify($oldPassword, $passwordDB)){
      if(strcmp($password,$con_password)==0){
        $password = password_hash($password, PASSWORD_DEFAULT);
          $sql2="UPDATE users SET password='$password' WHERE userid='$userid'";
          mysqli_query($conn, $sql2);

          $sql1="UPDATE doctors SET name='$name',phoneNumber='$phoneNumber',email='$email',divission='$divission',district='$district',thana='$thana',specialty='$specialty',degree='$degree',description='$description' WHERE userid='$userid'";
          mysqli_query($conn, $sql1);
          header("Location: Doctor_Home_Page.php");
          //$userArrayData=array(':password'=> $password,':status'=>$s);

          //$doctorArrayData = array(':name' => $name,':phoneNumber' => $phoneNumber,':email' => $email,':divission' => $divission,':district' => $district,':thana' => $thana,':specialty' => $specialty,':degree' => $degree,'description' => $description);

          //$con->update("UPDATE doctors SET name = :name, phoneNumber = :phoneNumber, email = :email, divission = :divission, district = :district, thana = :thana, specialty = :specialty, degree = :degree, description =:description WHERE userid=$userid",$doctorArrayData);

          //$con->update("UPDATE users SET password=:password, status=:status WHERE userid=$userid",$userArrayData);
      }else{
      	$pass_error="Password Doesn't Match!";
      }
    }else{
      $pass_errorr="Old Password is not correct!";
    }
  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Doctor Profile</title>
	<link rel="stylesheet" href="./css/doctor_profile.css">
</head>
<body>
	<button type="button" onclick="window.location='Doctor_Home_Page.php'">Home Page</button>
  	<button type="button" onclick="window.location='logout.php'">Log Out</button><br>

    <div class="Registration-box">
		<legend style="text-align: center;"><b>Update Your Profile</b> </legend>
    	<h2>Doctor id: <?php echo $userid; ?></h2>
		<form action="Doctor_Profile.php?<?php echo $_SESSION['userid'] = $userid; ?>" method="POST" accept-charset="utf-8">
        <?php foreach($holdAllData as $row) { ?>

          <div><label for="userid">User Id:<br><input type="text" name="userid" value="<?php echo $row['userid'];?>"></label><br></div><br>
          <div><label for="username">Name:<br><input type="text" name="name" value="<?php echo $row['name'];?>"></label><br></div><br>
    			<div><label for="gender">Gender:<br><input type="text" name="gender" value="<?php echo $row['gender'];?>"></label><br></div><br>
          <div><label for="password">Old Password:<br><input type="password" name="oldPassword" value=""></label>
          <span style="color:red;"><?php echo $pass_errorr; ?></span><br></div><br>
          <div><label for="password">New Password:<br><input type="password" name="password" value=""></label><br></div><br>
          <div><label for="conpassword">Confirm Password:<br><input type="password" name="con_password" value=""></label>
            <span style="color:red;"><?php echo $pass_error; ?></span></div><br>		
          <div><label for="pnumber">Phone Number:<br><input type="text" name="phoneNumber" value="<?php echo $row['phoneNumber'];?>"></label></div><br>  
          <div><label for="email">Email:<br><input type="email" name="email" value="<?php echo $row['email'];?>"></label></div><br>	
    			<div><label for="dateofbirth">Date Of Birth:<br><input type="text" name="dateOfBirth" value="<?php echo $row['dateOfBirth'];?>"></label></div>
          <div><label for="address">Address:<br></label></div><br>
          
    			<div>    			
    			<select name="divission">
            <option value="<?php echo $row['divission'];?>"><?php echo $row['divission'];?></option>
    				<option value="Rajshahi">Rajshahi</option>
    				<option value="Dhaka" >Dhaka</option>
    				<option value="Borisal" >Borisal</option>
    				<option value="Khulna">Khulna</option>
    				<option value="Chittagong">Chittagong</option>
    			</select>
    			<select name="district">
    				<option value="<?php echo $row['district'];?>"><?php echo $row['district'];?></option>
    				<option value="Rajshahi">Rajshahi</option>
    				<option value="Dhaka" >Dhaka</option>
    				<option value="Borisal" >Borisal</option>
    				<option value="Khulna">Khulna</option>
    				<option value="Chittagong">Chittagong</option>
    			</select>
    			<select name="thana">
    				<option value="<?php echo $row['thana'];?>"><?php echo $row['thana'];?></option>
    				<option value="Rajshahi">Rajshahi</option>
    				<option value="Dhaka" >Dhaka</option>
    				<option value="Borisal" >Borisal</option>
    				<option value="Khulna">Khulna</option>
    				<option value="Chittagong">Chittagong</option>
    			</select>
          </div><br>

          <div> <label for="specialty">Specialty:<br> <input type="text" name="specialty" value="<?php echo $row['specialty'];?>"></label>
          </div><br>

    			<div><label>Degree:<br><input type="text" name="degree" value="<?php echo $row['degree'];?>"></label></div><br>
          <div><label>BMDCRegno: <br><input type="text" name="bmdcRegNo" value="<?php echo $row['bmdcRegNo'];?>"></label><br></div><br>
          <div><label>Description:<br><input type="text" name="description" value="<?php echo $row['description'];?>"></label><br>
        <?php } ?></div><br><br>
          <div><input type="checkbox" name="check">I agree with terms and conditions of this Software.I hereby declare that the above given details are true to the best of my Knowlage.<br><br></div>
          <div><input type="submit" name="submit" value="Update"></div>
    		
    			

          
          
		</form>
  </div>

</body>
</html>