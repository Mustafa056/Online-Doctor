<?php 
  include "includes/db_connect.inc.php";
  include 'Connection.php';
  $con=new Connection;
  session_start();
  $passwordDB=$userid="";

  $userid=$_SESSION["userid"];
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }
  $holdDashboardData=$con->getAll("SELECT * FROM patients");
  $holdUserid = "SELECT * FROM patients";
  $result = mysqli_query($conn, $holdUserid);
  $rowCount = mysqli_num_rows($result);


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Admin Patients List</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<table style="width:100%; background-color: skyblue" border="2">
 		<caption>Doctor's Request List</caption>
 		<thead>
 			<tr>
 				<th>Id</th>
 				<th>User Id</th>
 				<th>Name</th>
 				<th>Gender</th>
        <th>Blood Group</th>
 				<th>Phone Number</th>
 				<th>Email</th>
 				<th>Date Of Birth</th>
 				<th>Divission</th>
 				<th>District</th>
 				<th>Thana</th>
 			</tr>
 		</thead>
 		<?php foreach($holdDashboardData as $getData){ ?>
 		<tbody>
 			<tr>
 				<td><?php echo $getData['id'] ?></td>
 				<td><?php echo $getData['userid'] ?></td>
 				<td><?php echo $getData['name'] ?></td>
 				<td><?php echo $getData['gender'] ?></td>
        <td><?php echo $getData['bloodGroup'] ?></td>
 				<td><?php echo $getData['phoneNumber'] ?></td>
 				<td><?php echo $getData['email'] ?></td>
 				<td><?php echo $getData['dateOfBirth'] ?></td>
 				<td><?php echo $getData['divission'] ?></td>
 				<td><?php echo $getData['district'] ?></td>
 				<td><?php echo $getData['thana'] ?></td>
 			</tr>
 		</tbody>
 		<?php } ?>
 	</table>
  <h2>Total Patients: <?php echo $rowCount ?></h2>
 </body>
 </html>