<?php 
	//include "includes/db_connect.inc.php";
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$userid=$_SESSION["userid"];
	$holdPrescriptionData=$con->getAll("SELECT * FROM `prescription`  WHERE patientId='$userid'");


 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Patient History</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<button type="button" onclick="window.location='Patient_Home_Page.php'">Home Page</button>
 	<button type="button" onclick="window.location='logout.php'">Log Out</button><br>
 	<table style="width:100%; background-color: skyblue" border="2" id="myTable">
	 		<caption>Patient History</caption>
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Patient Id</th>
	 				<th>Doctor Id</th>
	 				<th>Date</th>
	 				<th>Time</th>
	 				<th>Clinic Name</th>
	 				<th>Clinic Id</th>
	 				<th>Divission</th>
	 				<th>District</th>
	 				<th>Thana</th>
	 				<th>Symptom</th>
	 				<th>Disease</th>
	 				<th>Test</th>
	 				<th>Test Clinic Name</th>
	 				<th>Test Clinic Id</th>
	 				<th>Report</th>
	 				<th>Medicines</th>
	 			</tr>
	 		</thead>
	 		<?php foreach($holdPrescriptionData as $getData){ ?>
	 		<tbody>
	 			<tr>
	 				<td><?php echo $getData['id'] ?></td>
	 				<td><?php echo $getData['patientId'] ?></td>
	 				<td><?php echo $getData['doctorId'] ?></td>
	 				<td><?php echo $getData['date'] ?></td>
	 				<td><?php echo $getData['time'] ?></td>
	 				<td><?php echo $getData['clinicName'] ?></td>
	 				<td><?php echo $getData['clinicId'] ?></td>
	 				<td><?php echo $getData['divission'] ?></td>
	 				<td><?php echo $getData['district'] ?></td>
	 				<td><?php echo $getData['thana'] ?></td>
	 				<td><?php echo $getData['symptom'] ?></td>
	 				<td><?php echo $getData['disease'] ?></td>
	 				<td><?php echo $getData['test'] ?></td>
	 				<td><?php echo $getData['testClinicName'] ?></td>
	 				<td><?php echo $getData['testClinicId'] ?></td>
	 				<td><?php echo $getData['report'] ?></td>
	 				<td><?php echo $getData['medicines'] ?></td>
	 			</tr>
	 		</tbody>
	 		<?php } ?>
	 	</table>
 </body>
 </html>