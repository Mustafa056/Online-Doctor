<?php 
	include "includes/db_connect.inc.php";
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$Pid=$_GET['Pid'];
	$userid=$_SESSION["userid"];
	$holdClinicData=$con->getAll("SELECT * FROM `clinics`");
	$holdTestData=$con->getAll("SELECT * FROM `test`");
	$holdDiseaseData=$con->getAll("SELECT * FROM `disease`");
	$holdPaWatingData=$con->getAll("SELECT * FROM `patient_wating_list` WHERE id='$Pid'");
	 

	$patientId=$patientName=$patientGender=$patientNumber=$dateOfBirth=$doctorId=$date=$time=$clinicName=$clinicId=$divission=$district=$thana=$symptom=$disease=$test=$testClinicName=$testClinicId=$report=$medicines="";

	if(isset($_POST['submit'])){
  		if(!empty($_POST['patientId'])){
      		$patientId = mysqli_real_escape_string($conn, $_POST['patientId']);
	    }
	    if(!empty($_POST['patientName'])){
	      	$patientName = mysqli_real_escape_string($conn, $_POST['patientName']);
	    }
	    if(!empty($_POST['patientGender'])){
      		$patientGender = mysqli_real_escape_string($conn, $_POST['patientGender']);
   		}
   		if(!empty($_POST['patientNumber'])){
      		$patientNumber = mysqli_real_escape_string($conn, $_POST['patientNumber']);
	    }
	    if(!empty($_POST['dateOfBirth'])){
	      	$dateOfBirth = mysqli_real_escape_string($conn, $_POST['dateOfBirth']);
	    }
	    if(!empty($_POST['doctorId'])){
      		$doctorId = mysqli_real_escape_string($conn, $_POST['doctorId']);
   		}
   		if(!empty($_POST['date'])){
      		$date = mysqli_real_escape_string($conn, $_POST['date']);
	    }
	    if(!empty($_POST['time'])){
      		$time = mysqli_real_escape_string($conn, $_POST['time']);
   		}
	    if(!empty($_POST['clinicId'])){
	      	$clinicId = mysqli_real_escape_string($conn, $_POST['clinicId']);
	    }
   		if(!empty($_POST['clinicName'])){
      		$clinicName = mysqli_real_escape_string($conn, $_POST['clinicName']);
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
	    if(!empty($_POST['symptom'])){
	      	$symptom = mysqli_real_escape_string($conn, $_POST['symptom']);
	    }
	    if(!empty($_POST['diseases'])){
      		$diseases = mysqli_real_escape_string($conn, $_POST['diseases']);
   		}
   		if(!empty($_POST['test'])){
      		$test = mysqli_real_escape_string($conn, $_POST['test']);
	    }
	    if(!empty($_POST['testClinicId'])){
	      	$testClinicId = mysqli_real_escape_string($conn, $_POST['testClinicId']);
	    }
	    $holdClinicName=$con->getAll("SELECT * FROM `clinics` WHERE userid='$testClinicId'");
	    foreach($holdClinicName as $getData){
	    	$testClinicName=$getData['name'];
	    }
	    if(!empty($_POST['report'])){
      		$report = mysqli_real_escape_string($conn, $_POST['report']);
   		}
   		if(!empty($_POST['medicines'])){
      		$medicines = mysqli_real_escape_string($conn, $_POST['medicines']);
	    }

	    $sql1 = "INSERT INTO `prescription` (patientId,patientName,patientGender,patientNumber,dateOfBirth,doctorId,date,time,clinicName,clinicId,divission,district,thana,symptom,disease,test,testClinicName,testClinicId,report,medicines)
	                  VALUES ('$patientId','$patientName','$patientGender','$patientNumber', '$dateOfBirth','$doctorId','$date','$time','$clinicName','$clinicId','$divission','$district','$thana','$symptom','$diseases','$test','$testClinicName','$testClinicId','$report','$medicines');";
		mysqli_query($conn, $sql1);

///////////////////////////////watch microsoft patient history
		$text="You have a new Prescription from Doctor ";
		$notification="You have a new Prescription from Doctor $doctorId";
		$sql3 = "INSERT INTO `notification` (patientId,notifi) VALUES ('$patientId','$notification');";
		mysqli_query($conn, $sql3);
		$con->getAll("DELETE FROM `patient_wating_list` WHERE id='$Pid'");
   		header("Location: Doctor_P_Waiting_List.php");
   	}


 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Prescription</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	  <form action="" method="POST" accept-charset="utf-8">
		<?php foreach($holdPaWatingData as $getData){ ?>
	 	  	<input type="hidden" name="patientId" value="<?php echo $getData['patientId'] ?>">
			<label style="color: red;">Patient Name:<input type="hidden" name="patientName" value="<?php echo $getData['patientName'] ?>"><?php echo $getData['patientName'] ?></label><br>
			<label style="color: red;">Gender:<input type="hidden" name="patientGender" value="<?php echo $getData['patientGender'] ?>" ><?php echo $getData['patientGender'] ?></label><br>
			<input type="hidden" name="patientNumber" value="<?php echo $getData['patientNumber'] ?>">
			<label style="color: red;">Date Of Birth:<input type="hidden" name="dateOfBirth" value="<?php echo $getData['dateOfBirth'] ?>"><?php echo $getData['dateOfBirth'] ?></label><br>
			<input type="hidden" name="doctorId" value="<?php echo $getData['doctorId'] ?>">
			<input type="hidden" name="date" value="<?php echo $getData['date'] ?>">
			<input type="hidden" name="time" value="<?php echo $getData['time'] ?>">
			<input type="hidden" name="clinicId" value="<?php echo $getData['clinicId'] ?>">
			<input type="hidden" name="clinicName" value="<?php echo $getData['clinicName'] ?>">
			<input type="hidden" name="divission" value="<?php echo $getData['divission'] ?>">
			<input type="hidden" name="district" value="<?php echo $getData['district'] ?>">
			<input type="hidden" name="thana" value="<?php echo $getData['thana'] ?>">
		<?php } ?>
		<label>Symptom<input type="text" name="symptom" value=""></label><br>
		<label>Diseases:</label>
		<select name="diseases" id="did">
				<?php foreach($holdDiseaseData as $getData){ ?>
				<option value="<?php echo $getData['disease'] ?>"><?php echo $getData['disease'] ?></option>
				<?php } ?>
		</select><br>
		<label>Test:</label>
		<select name="test" id="tid">
				<?php foreach($holdTestData as $getData){ ?>
				<option value="<?php echo $getData['test'] ?>"><?php echo $getData['test'] ?></option>
				<?php } ?>
		</select><br>
		<label>Test Clinic Name:</label>
		<select name="testClinicId" id="cid">
				<?php foreach($holdClinicData as $getData){ ?>
				<option value="<?php echo $getData['userid'] ?>"><?php echo $getData['name'] ?></option>
				<?php } ?>
		</select><br>
		<label>Report:<input type="text" name="report" value="" placeholder="Report" disabled></label><br>
		<label>Medicines:<input type="text" name="medicines" value="" placeholder="Medicines"></label><br><br>
		<input type="submit" name="submit" value="Prescive">
 	  </form>
 </body>
 </html>