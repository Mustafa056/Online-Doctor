<?php
	include "includes/db_connect.inc.php";
	session_start();
  	$userid=$_SESSION["userid"];
  	if(!isset($_SESSION["userid"])){
    	header("Location: login.php");
  	}
  	$status=4;
  	$con_password=$temp_password=$pass_error=$userid_error= "" ;
  	$userid=$name=$phoneNumber=$divission=$district=$thana=$password="";

  	if($_SERVER["REQUEST_METHOD"]=="POST"){
  		if(!empty($_POST['userid'])){
      		$userid = mysqli_real_escape_string($conn, $_POST['userid']);
	    }
	    if(!empty($_POST['name'])){
	      	$name = mysqli_real_escape_string($conn, $_POST['name']);
	    }
	    if(!empty($_POST['password'])){
      		$password = mysqli_real_escape_string($conn, $_POST['password']);
   		}
    	if(!empty($_POST['con_password'])){
      		$con_password = mysqli_real_escape_string($conn, $_POST['con_password']);
    	}
	    if(!empty($_POST['phoneNumber'])){
	      	$phoneNumber = mysqli_real_escape_string($conn, $_POST['phoneNumber']);
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
    	
    	if(strcmp($password,$con_password)==0){
      		$password = password_hash($password, PASSWORD_DEFAULT);

	        $holdUserid = "SELECT * FROM users WHERE userid = '$userid'";
	        $result = mysqli_query($conn, $holdUserid);
	        $rowCount = mysqli_num_rows($result);
	      
	        if($rowCount < 1){//start1
	            $sql2 = "INSERT INTO users (userid,password,status) VALUES ('$userid','$password', '$status');";
	              mysqli_query($conn, $sql2);
	            $sql1 = "INSERT INTO clinics (userid,name,phoneNumber,divission,district,thana)
	                  VALUES ('$userid','$name','$phoneNumber','$divission','$district','$thana');";
	              mysqli_query($conn, $sql1);
                  
	        }else{//end1
	          $userid_error = "Userid already exist!";
	        }
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
 	<title>Clinic Registration</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

 	<link rel="stylesheet" href="">
 </head>

  <style type="text/css">
	
	#ui{
		background-color: #333;
		padding: 30px;
		margin-top: 50px;
	}
	#ui label,h1{
		color: #fff;
	}
</style>
 <body>
 	
 		<div class ="container">

		<div class="row">
			<div class="col-lg-3"></div>

			<div class="col-lg-6">
				<div id="ui">
					<h1 class="text-center">Clinic Registration</h1>
 		<form action="Admin_Clinic_Reg.php?<?php echo $_SESSION['userid']=$userid;?>" method="POST" accept-charset="utf-8" class="form-group">
 			<div class="row">
							<div class="col-lg-6">
								<label>Clinic Id:</label>
								<input type="text" name="userid" class="form-control" placeholder="Enter your id.." required>
								<span style="color:red;"><?php echo $userid_error; ?></span><br>

		
							</div>

							<div class="col-lg-6">
								<label>Clinic Name:</label>
								<input type="text" name="name" class="form-control" placeholder="Enter Clinic Name.." required>

		
							</div>
							
						</div>

						<div class="row">
							<div class="col-lg-6">
								<label>Password:</label>
								<input type="password" name="password" class="form-control" placeholder="Enter password..">

		
							</div>

							<div class="col-lg-6">
								<label>Re-type Password:</label>
								<input type="password" name="con_password" class="form-control" placeholder="Re-type password">
								<span style="color:red;"><?php echo $pass_error; ?></span>

		
							</div>
							
						</div>
			<label for="pnumber">Phone Number:<input type="text" class="form-control" name="phoneNumber" placeholder="Phone Number" required></label><br>

			<label for="address">Clinic Address:</label>

						<div class="row">
							<div class="col-lg-6">
							<select name="divission" class="form-control">
							<option selected disabled >Select Division</option>
				            <option value="Rangpur" required> Rangpur </option>
				            <option value="Rajshahi">Rajshahi</option>
				            <option value="Dhaka" >Dhaka</option>
				            <option value="Borisal" >Borisal</option>
				            <option value="Khulna">Khulna</option>
				            <option value="Chittagong">Chittagong</option>

			                </select>

							</div>

							<div class="col-lg-6">
							<select name="district" class="form-control">
							<option selected disabled >Select District</option>
				            <option value="Rangpur"> Rangpur </option>
				            <option value="Dhaka">Dhaka</option>
				            <option value="Borisal" >Borisal</option>
				            <option value="Khulna">Khulna</option>
				            <option value="Chittagong">Chittagong</option>


			                </select>

			                <label> </label>

							</div>

							<div class="col-lg-6">
							<select name="thana" class="form-control">
							<option selected disabled >Select Thana</option>	
				            <option value="Dhamrai"> Dhamrai </option>
				            <option value="Dohar">Dohar</option>
				            <option value="Gazipur Sadar" >Gazipur Sadar</option>
				            <option value="Sreepur">Sreepur</option>
				            <option value="Kashiani">Kashiani</option>
				            <option value="Amtoli">Amtoli</option>
				            <option value="Feni Sadar">Feni Sadar</option>
				            

			                </select>

							</div>


							
						</div>
						<br>


		               <input type="submit" name="submit" value="Add Clinic" class="btn btn-primary btn-block btn-lg">>
 		</form>
 	
 </body>
 </html>

