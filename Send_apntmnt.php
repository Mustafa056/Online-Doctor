<?php 

	include "includes/db_connect.inc.php";
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	//$Sid=$_GET['Sid'];
	$Pid=$_SESSION["userid"];
	$Sid=$_SESSION["Sid"];
	$holdSidData=$con->getAll("SELECT * FROM `set_schedule` WHERE id=$Sid");
	$holdPidData=$con->getAll("SELECT * FROM `patients` WHERE userid='$Pid'");
	//variables
	$patientId=$PatientName=$patientGender=$patientNumber=$dateOfBirth=$doctorId=$date=$time=$clinicName=$clinicId=$divission=$district=$thana="";

	foreach($holdSidData as $getData){
		$doctorId=$getData['doctorid'];
		$date=$getData['date'];
		$time=$getData['time'];
		$clinicId=$getData['clinicid'];
		$clinicName=$getData['clinicName'];
		$divission=$getData['divission'];
		$district=$getData['district'];
		$thana=$getData['thana'];
	}
	foreach($holdPidData as $getData){
		$patientId=$getData['userid'];
		$PatientName=$getData['name'];
		$patientGender=$getData['gender'];
		$patientNumber=$getData['phoneNumber'];
		$dateOfBirth=$getData['dateOfBirth'];
	}
	$sql1 = "INSERT INTO `patient_wating_list` (patientId,patientName,patientGender,patientNumber,dateOfBirth,doctorId,date,time,clinicId,clinicName,divission,district,thana)
	                  VALUES ('$patientId','$PatientName','$patientGender','$patientNumber', '$dateOfBirth','$doctorId','$date','$time','$clinicId', '$clinicName','$divission','$district','$thana');";
	mysqli_query($conn, $sql1);
	header("location:Patient_Take_Apntmnt.php");

?>
