<?php 
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	$userid=$_SESSION["userid"];
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$holdNotificationData="";
	$holdNotificationData=$con->getAll("SELECT * FROM `notification` WHERE patientId='$userid'");


 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Patient Notification</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<button type="button" onclick="window.location='Patient_Home_Page.php'">Home Page</button>
 	<button type="button" onclick="window.location='logout.php'">Log Out</button><br>
 	<table style="width:100%; background-color: skyblue" border="2" id="myTable">
	 		<caption>Notification</caption>
	 		<thead>
	 			<tr>
	 				<th>Notification</th>
	 				
	 			</tr>
	 		</thead>
	 		<?php foreach($holdNotificationData as $getData){ ?>
	 		<tbody>
	 			<tr>
	 				<td><?php echo $getData['notifi'] ?></td>
	 			</tr>
	 		</tbody>
	 		<?php } ?>
	 	</table>
 </body>
 </html>