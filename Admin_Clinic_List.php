<?php
  include "includes/db_connect.inc.php";
  include 'Connection.php';
  $con=new Connection;
  session_start();

  $userid=$_SESSION["userid"];
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }
  $holdClinicData=$con->getAll("SELECT * FROM clinics");
  $holdUserid = "SELECT * FROM clinics";
  $result = mysqli_query($conn, $holdUserid);
  $rowCount = mysqli_num_rows($result);

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Admin Clinic List</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<table style="width:100%; background-color: skyblue" border="2">
 		<caption>Clinic List</caption>
 		<thead>
 			<tr>
 				<th>Id</th>
 				<th>Clinic Id</th>
 				<th>Clinic Name</th>
 				<th>Phone Number</th>
 				<th>Divission</th>
 				<th>District</th>
 				<th>Thana</th>
 			</tr>
 		</thead>
 		<?php foreach($holdClinicData as $getData){ ?>
 		<tbody>
 			<tr>
 				<td><?php echo $getData['id'] ?></td>
 				<td><?php echo $getData['userid'] ?></td>
 				<td><?php echo $getData['name'] ?></td>
 				<td><?php echo $getData['phoneNumber'] ?></td>
 				<td><?php echo $getData['divission'] ?></td>
 				<td><?php echo $getData['district'] ?></td>
 				<td><?php echo $getData['thana'] ?></td>
 			</tr>
 		</tbody>
 		<?php } ?>
 	</table>
  <h2>Total Clinic: <?php echo $rowCount ?></h2>
 </body>
 </html>