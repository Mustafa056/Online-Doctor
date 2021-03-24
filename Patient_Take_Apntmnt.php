<?php 
	//include "includes/db_connect.inc.php";
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	$userid=$_SESSION["userid"];
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$holdScheduleData="";
	$holdScheduleData=$con->getAll("SELECT * FROM `set_schedule` ");
	if(isset($_POST['srcid'])){
		$holdSearchText=$_POST['search'];
		$holdScheduleData=$con->getAll("SELECT * FROM `set_schedule` WHERE doctorid LIKE '$holdSearchText%'");
	}elseif (isset($_POST['srcname'])) {
		$holdSearchText=$_POST['search'];
		$holdScheduleData=$con->getAll("SELECT * FROM `set_schedule` WHERE doctorName LIKE '%$holdSearchText%'");
	}else{
		$holdScheduleData=$con->getAll("SELECT * FROM `set_schedule` ");
	}

 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Take Appointment</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<button type="button" onclick="window.location='Patient_Home_Page.php'">Home Page</button>
 	<button type="button" onclick="window.location='logout.php'">Log Out</button><br>
 	<label>Search By Doctor Id:</label>
 	<form action="" method="POST">
		<input type="text" name="search">
		<input style="color:blue" type="submit" name="srcid" value="search">
	</form><br>
	<label>Search By Doctor Name:</label>
	<form action="" method="POST">
		<input type="text" name="search">
		<input style="color:blue" type="submit" name="srcname" value="search">
	</form>
 	<table style="width:100%; background-color: skyblue" border="2" id="myTable">
	 		<caption>All Set Schedule</caption>
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Doctor Id</th>
	 				<th>Doctor Name</th>
	 				<th>Doctor Mail</th>
	 				<th>Specialty</th>
	 				<th>Clinic Id</th>
	 				<th>Clinic Name</th>
	 				<th>Date</th>
	 				<th>Time</th>
	 				<th>Divission</th>
	 				<th>District</th>
	 				<th>Thana</th>
	 				<th>Send</th>
	 			</tr>
	 		</thead>
	 		<?php foreach($holdScheduleData as $getData){ ?>
	 		<tbody>
	 			<tr>
	 				<td><?php echo $getData['id'] ?></td>
	 				<td><?php echo $getData['doctorid'] ?></td>
	 				<td><?php echo $getData['doctorName'] ?></td>
	 				<td><?php echo $getData['doctorMail'] ?></td>
	 				<td><?php echo $getData['specialty'] ?></td>
	 				<td><?php echo $getData['clinicid'] ?></td>
	 				<td><?php echo $getData['clinicName'] ?></td>
	 				<td><?php echo $getData['date'] ?></td>
	 				<td><?php echo $getData['time'] ?></td>
	 				<td><?php echo $getData['divission'] ?></td>
	 				<td><?php echo $getData['district'] ?></td>
	 				<td><?php echo $getData['thana'] ?></td>
	 				<td><input type="button" value="Send" onclick="window.location='Payment.php?Sid=<?php echo $getData['id']; ?>'" /></td>
	 			</tr>
	 		</tbody>
	 		<?php } ?>
	 	</table>
 </body>
 </html>