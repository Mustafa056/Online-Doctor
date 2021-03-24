<?php 
	//include "includes/db_connect.inc.php";
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$userid=$_SESSION["userid"];
	$holdPrescriptionData=$con->getAll("SELECT * FROM `prescription`  WHERE doctorId='$userid'");


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
 	<button type="button" onclick="window.location='Doctor_Home_Page.php'">Home Page</button>
  	<button type="button" onclick="window.location='logout.php'">Log Out</button><br>
 	<table style="width:100%; background-color: skyblue" border="2" id="myTable">
	 		<caption>All Set Schedule</caption>
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Patient Id</th>
	 				<th>Gender</th>
	 				<th>Phone Number</th>
	 				<th>Date Of Birth</th>
	 				<th>Date</th>
	 				<th>Time</th>
	 				<th>Symptom</th>
	 				<th>Disease</th>
	 				<th>Test</th>
	 				<th>Report</th>
	 				<th>Medicines</th>
	 			</tr>
	 		</thead>
	 		<?php foreach($holdPrescriptionData as $getData){ ?>
	 		<tbody>
	 			<tr>
	 				<td><?php echo $getData['id'] ?></td>
	 				<td><?php echo $getData['patientId'] ?></td>
	 				<td><?php echo $getData['patientGender'] ?></td>
	 				<td><?php echo $getData['patientNumber'] ?></td>
	 				<td><?php echo $getData['dateOfBirth'] ?></td>
	 				<td><?php echo $getData['date'] ?></td>
	 				<td><?php echo $getData['time'] ?></td>
	 				<td><?php echo $getData['symptom'] ?></td>
	 				<td><?php echo $getData['disease'] ?></td>
	 				<td><?php echo $getData['test'] ?></td>
	 				<td><?php echo $getData['report'] ?></td>
	 				<td><?php echo $getData['medicines'] ?></td>
	 			</tr>
	 		</tbody>
	 		<?php } ?>
	 	</table>
 </body>
 </html>