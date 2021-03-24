<?php

  include "includes/db_connect.inc.php";
  session_start();
  $userid=$_SESSION["userid"];
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }
  /////
  $status=3;
  $con_password=$pass_error=$userid_error= "" ;
  $userid=$name=$gender=$bloodGroup=$phoneNumber=$email=$dateOfBirth=$divission=$district=$thana=$password="";
	
	
	/* mysqli_real_escape_string() helps prevent sql injection */
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(!empty($_POST['userid'])){
      $userid = mysqli_real_escape_string($conn, $_POST['userid']);
    }
    if(!empty($_POST['name'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
    }
    if(!empty($_POST['gender'])){
      $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    }
    if(!empty($_POST['bloodGroup'])){
      $bloodGroup = mysqli_real_escape_string($conn, $_POST['bloodGroup']);
    }
    if(!empty($_POST['phoneNumber'])){
      $phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
    }
    if(!empty($_POST['email'])){
      $email = mysqli_real_escape_string($conn, $_POST['email']);
    }
    if(!empty($_POST['dateOfBirth'])){
      $dateOfBirth = mysqli_real_escape_string($conn, $_POST['dateOfBirth']);
    }
    if(!empty($_POST['divission'])){
      $divission = mysqli_real_escape_string($conn, $_POST['divission']);
    }
    if(!empty($_POST['district'])){
      $district = mysqli_real_escape_string($conn, $_POST['district']);
    }
    if(!empty($_POST['thana'])){
      $thana = mysqli_real_escape_string($conn, $_POST['thana']);
    }
    if(!empty($_POST['specialty'])){
      $specialty = mysqli_real_escape_string($conn, $_POST['specialty']);
    }
    if(!empty($_POST['degree'])){
      $degree = mysqli_real_escape_string($conn, $_POST['degree']);
    }
    if(!empty($_POST['bmdcRegNo'])){
      $bmdcRegNo = mysqli_real_escape_string($conn, $_POST['bmdcRegNo']);
    }
    if(!empty($_POST['description'])){
      $description = mysqli_real_escape_string($conn, $_POST['description']);
    }
    if(!empty($_POST['password'])){
      $password = mysqli_real_escape_string($conn, $_POST['password']);
    }
    if(!empty($_POST['con_password'])){
      $con_password = mysqli_real_escape_string($conn, $_POST['con_password']);
    }
    //Password
    if(strcmp($password,$con_password)==0){
      $password = password_hash($password, PASSWORD_DEFAULT);
      //
        $holdUserid = "SELECT * FROM users WHERE userid = '$userid'";
        $result = mysqli_query($conn, $holdUserid);
        $rowCount = mysqli_num_rows($result);
      
        if($rowCount < 1){//start1
            $sql2 = "INSERT INTO users (userid,password,status) VALUES ('$userid','$password', '$status');";
              mysqli_query($conn, $sql2);
            $sql1 = "INSERT INTO patients (userid,name,gender,bloodGroup,phoneNumber,email,dateOfBirth,divission,district,thana)
                  VALUES ('$userid','$name','$gender','$bloodGroup','$phoneNumber', '$email','$dateOfBirth','$divission','$district','$thana');";
              mysqli_query($conn, $sql1);
              header("Location: Patient_Home_Page.php");
                  
        }else{//end1
          $userid_error = "Userid already exist!";
        }
      //
    	
    }else{
    	$pass_error="Password Doesn't Match!";
    }

  }

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Update info</title>
  <link rel="stylesheet" href="./css/patient_reg.css">
</head>
<body>
  <div class="inputfield terms" style="text-align: center;">

       <button type="button"  onclick="window.location='Patient_Home_Page.php'"><b>Home Page</b></button>
      <button type="button"  onclick="window.location='logout.php'"><b>Log Out</b></button><br>
       </div>

      <div class="wrapper">
            <div class="title">
      Update Information
    </div>
    <form action="Patient_Registration.php" method="POST" accept-charset="utf-8">

    <div class="form">
       <div class="inputfield">
          <label>User Id</label>
          <input type="text" class="input" name="userid" required>
          <span style="color:red;"><?php echo $userid_error; ?></span>
       </div> 
       <div class="inputfield">
          <label>User Name</label>
          <input type="text" class="input" name="username" required>
          
       </div> 
       <div class="inputfield">
          <label>Password</label> <input type="password" name="password" class="input">
       </div>  
      <div class="inputfield">
          <label>Confirm Password</label><input type="password" name="con_password"class="input">
            <span style="color:red;"><?php echo $pass_error; ?></span>
            </div>  

        <div class="inputfield">
             <label>Gender</label>
        <input type="radio" name="gender" value="male" checked>Male
        <input type="radio" name="gender" value="female" >Female 
          </div>

      <div class="inputfield">
          <label>Email</label><input type="email" name="email" class="input" required>
      </div>

      <div class="inputfield">
          
      <label for="pnumber">Phone Number</label><input type="text" name="phoneNumber" class="input" required><br>
      </div>

      <div class="inputfield">
          <label for="dateofbirth">Date Of Birth</label><input type="date" name="dateOfBirth" >
      
      </div>


          <div class="inputfield">

    <label for="bloodGroup">Blood Group:</label>
    <div class="custom_select">
      <select name="bloodGroup">
        <option selected disabled >Select Blood Group</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="O-">O-</option>
      </select><br>
    </div>
  </div>

      <div class="inputfield">
        <label for="address">Address:</label>
        <div class="custom_select">
      <select name="divission">
        <option selected disabled >Select Division</option>
        
        <option value="Rajshahi">Rajshahi</option>
        <option value="Dhaka" >Dhaka</option>
        <option value="Borisal" >Borisal</option>
        <option value="Khulna">Khulna</option>
        <option value="Chittagong">Chittagong</option>
      </select>
    </div><br>
    <div class="custom_select">
      <select name="district">
        <option selected disabled >Select District</option>
        <option value="Rajshahi">Rajshahi</option>
        <option value="Dhaka" >Dhaka</option>
        <option value="Borisal" >Borisal</option>
        <option value="Khulna">Khulna</option>
        <option value="Chittagong">Chittagong</option>
      </select>
    </div><br>
    <div class="custom_select">
      <select name="thana">
        <option selected disabled >Select Thana</option>
        <option value="Rajshahi">Rajshahi</option>
        <option value="Dhaka" >Dhaka</option>
        <option value="Borisal" >Borisal</option>
        <option value="Khulna">Khulna</option>
        <option value="Chittagong">Chittagong</option>
      </select><br>
    </div><br>
  </div>






     <div class="inputfield terms">
          <label class="check">
            <input type="checkbox" name="check">
            <span class="checkmark"></span>
          </label>
          <p>Agreed to terms and conditions</p>
       </div> 
      <div class="inputfield">
        <input type="submit" name="submit"value="Update" class="btn">
      </div>
      </div>
    </form>

       </div>
      
       <br>
       



     </body>
</html>


