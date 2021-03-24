<?php

  include "includes/db_connect.inc.php";

  $status=2;
  $con_password=$temp_password=$pass_error=$userid_error= "" ;
  $userid=$name=$gender=$phoneNumber=$email=$dateOfBirth=$divission=$district=$thana=$specialty=$degree=$bmdcRegNo=$description=$password="";
	
	
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


    /*Varification userid , password, email*/
    //Userid
    /*
    $holdUserid = "SELECT * FROM users WHERE userid = '$userid'";
    $result = mysqli_query($conn, $holdUserid);
    $rowCount = mysqli_num_rows($result);
  
    if($rowCount < 1){//start1
        $sql1 = "INSERT INTO doctors (userid,name,gender,phoneNumber,email,dateOfBirth,divission,district,thana,specialty,degree,bmdcRegNo,description)
              VALUES ('$userid','$name','$gender','$phoneNumber', '$email','$dateOfBirth','$divission','$district','$thana', '$specialty','$degree','$bmdcRegNo','$description');";
          mysqli_query($conn, $sql1);
          $sql2 = "INSERT INTO users (userid,password,status) VALUES ('$userid','$password', '$status');";
          mysqli_query($conn, $sql2);    
    }else{//end1
      $userid_error = "Userid already exist!";
    }
    */
    //Password
    if(strcmp($password,$con_password)==0){
      $password = password_hash($password, PASSWORD_DEFAULT);
      //
        $holdUserid = "SELECT * FROM users WHERE userid = '$userid'";
        $result = mysqli_query($conn, $holdUserid);
        $rowCount = mysqli_num_rows($result);
      
        if($rowCount < 1){//start1
            $sql2 = "INSERT INTO temp_doc_user (userid,password,status) VALUES ('$userid','$password', '$status');";
              mysqli_query($conn, $sql2);
            $sql1 = "INSERT INTO temp_doc_request (userid,name,gender,phoneNumber,email,dateOfBirth,divission,district,thana,specialty,degree,bmdcRegNo,description)
                  VALUES ('$userid','$name','$gender','$phoneNumber', '$email','$dateOfBirth','$divission','$district','$thana', '$specialty','$degree','$bmdcRegNo','$description');";
              mysqli_query($conn, $sql1);
              header("location: homepage.php");
                  
        }else{//end1
          $userid_error = "Userid already exist!";
        }
      //
    	
    }else{
    	$pass_error="Password Doesn't Match!";
    }

    /*
    $sql1 = "INSERT INTO doctors (userid,name,gender,phoneNumber,email,dateOfBirth,divission,district,thana,specialty,degree,bmdcRegNo,description)
              VALUES ('$userid','$name','$gender','$phoneNumber', '$email','$dateOfBirth','$divission','$district','$thana', '$specialty','$degree','$bmdcRegNo','$description');";
      mysqli_query($conn, $sql1);
    $sql2 = "INSERT INTO users (userid,password,status) VALUES ('$userid','$password', '$status');";
      mysqli_query($conn, $sql2);
   */
  }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Doctor Registration</title>
	<link rel="stylesheet" href="./css/Doctor_Registration.css">
</head>
<body>
	<div style="text-align: center;">
	<button type="button" onclick="window.location='Logout.php'"><b>Home Page</b></button>
</div>
      <div class="wrapper">
            <div class="title">
      Registration Form
    </div>
    <form action="Doctor_Registration.php" method="POST" accept-charset="utf-8">

    <div class="form">
       <div class="inputfield">
          <label>User Id</label>
          <input type="text" class="input" name="userid" required>
          <span style="color:red;"><?php echo $userid_error; ?></span>
       </div> 
       <div class="inputfield">
          <label>User Name</label>
          <input type="text" class="input" name="name" required>
          
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

    <div class="inputfield">
          <label for="specialty">Specialty</label><input type="text" name="specialty" class="input" required>
      
      </div>
    <div class="inputfield">
          <label>Degree</label> <input type="text" name="degree" value="" class="input">
      
      </div>
    <div class="inputfield">
          <label>BMDCRegno</label> <input type="text" name="bmdcRegNo" placeholder="10 Digits"><br>
      
      </div>
    <div class="inputfield">
          <label>Description</label> <input type="text" name="description" value=""><br>
      
      </div>

     <div class="inputfield terms">
          <label class="check">
            <input type="checkbox" name="check">
            <span class="checkmark"></span>
          </label>
          <p>Agreed to terms and conditions</p>
       </div> 
      <div class="inputfield">
        <input type="submit" name="submit"value="Sign-Up" class="btn">
      </div>
      
      </div>
    </form>

       </div>
       </body>
</html> 
       	
			