<?php 
	include 'Connection.php';
	  $con=new Connection;
	  session_start();

	  $userid=$_SESSION["userid"];
	  if(!isset($_SESSION["userid"])){
	    header("Location: login.php");
	  }
	  $holdPaymentData=$con->getAll("SELECT * FROM `payment` WHERE patientId='$userid'");

 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Payment History</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<button type="button" onclick="window.location='Patient_Home_Page.php'">Home Page</button>
 	<button type="button" onclick="window.location='logout.php'">Log Out</button><br>
 	<table style="width:100%; background-color: skyblue" border="2">
 		<caption>Payment History</caption>
 		<thead>
 			<tr>
 				<th>Doctor Id</th>
 				<th>Payment Date</th>
 				<th>Card Name</th>
 				<th>Card Number</th>
 				<th>Amount</th>
 				<th>Exp Month</th>
 				<th>Exp Year</th>
 				<th>Cvv</th>
 			</tr>
 		</thead>
 		<?php foreach($holdPaymentData as $getData){ ?>
 		<tbody>
 			<tr>
 				<td><?php echo $getData['doctorId'] ?></td>
 				<td><?php echo $getData['payDate'] ?></td>
 				<td><?php echo $getData['cardName'] ?></td>
 				<td><?php echo $getData['cardNumber'] ?></td>
 				<td><?php echo $getData['amount'] ?></td>
 				<td><?php echo $getData['expMonth'] ?></td>
 				<td><?php echo $getData['expYear'] ?></td>
 				<td><?php echo $getData['cvv'] ?></td>
 			</tr>
 		</tbody>
 		<?php } ?>
 	</table>
 </body>
 </html>