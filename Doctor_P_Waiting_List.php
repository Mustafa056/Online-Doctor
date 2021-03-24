<?php 

	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	$userid=$_SESSION["userid"];
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$holdWaitingListData="";
	$holdWaitingListData=$con->getAll("SELECT * FROM `patient_wating_list` WHERE doctorId='$userid'");

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Patients Waiting List</title>
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
	 				<th>Patient Name</th>
	 				<th>Patient Gender</th>
	 				<th>Patient Number</th>
	 				<th>Date Of Birth</th>
	 				<th>Date</th>
	 				<th>Time</th>
	 				<th>Clinic Id</th>
	 				<th>Clinic Name</th>
	 				<th>Divission</th>
	 				<th>District</th>
	 				<th>Thana</th>
	 				<th>Prescive</th>
	 			</tr>
	 		</thead>
	 		<?php foreach($holdWaitingListData as $getData){ ?>
	 		<tbody>
	 			<tr>
	 				<td><?php echo $getData['id'] ?></td>
	 				<td><?php echo $getData['patientId'] ?></td>
	 				<td><?php echo $getData['patientName'] ?></td>
	 				<td><?php echo $getData['patientGender'] ?></td>
	 				<td><?php echo $getData['patientNumber'] ?></td>
	 				<td><?php echo $getData['dateOfBirth'] ?></td>
	 				<td><?php echo $getData['date'] ?></td>
	 				<td><?php echo $getData['time'] ?></td>
	 				<td><?php echo $getData['clinicId'] ?></td>
	 				<td><?php echo $getData['clinicName'] ?></td>
	 				<td><?php echo $getData['divission'] ?></td>
	 				<td><?php echo $getData['district'] ?></td>
	 				<td><?php echo $getData['thana'] ?></td>
	 				<td><input type="button" value="Prescive" onclick="window.location='Prescription.php?Pid=<?php echo $getData['id']; ?>'" /></td>
	 			</tr>
	 		</tbody>
	 		<?php } ?>
	 	</table>
 </body>
 </html>