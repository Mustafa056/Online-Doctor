<?php 
  include "includes/db_connect.inc.php";
  include 'Connection.php';
  $con=new Connection;
  session_start();
  $userid=$_SESSION["userid"];
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }
  $passwordDB=$userid=$uid="";
  $uuid=$udid=$name=$gender=$phoneNumber=$email=$dateOfBirth=$divission=$district=$thana=$specialty=$degree=$bmdcRegNo=$description=$password=$status="";

 
  $holdDashboardData=$con->getAll("SELECT * FROM temp_doc_request");

  if (isset($_POST['accept'])){
  	$uid=$_POST['accept'];
  	//echo $uid;
  	$holdTempDocData=$con->getAll("SELECT * FROM `temp_doc_request` WHERE userid='$uid'");
  	$holdTempUserData=$con->getAll("SELECT * FROM `temp_doc_user` WHERE userid='$uid'");
  	foreach($holdTempDocData as $getData){
  		$udid=$getData['userid'];
	 	$name=$getData['name'];
	 	$gender=$getData['gender'];
	 	$phoneNumber=$getData['phoneNumber'];
	 	$email=$getData['email'];
	 	$dateOfBirth=$getData['dateOfBirth'];
	 	$divission=$getData['divission'];
	 	$district=$getData['district'];
	 	$thana=$getData['thana'];
	 	$specialty=$getData['specialty'];
	 	$degree=$getData['degree'];
	 	$bmdcRegNo=$getData['bmdcRegNo'];
	 	$description=$getData['description'];

	 	$sql1 = "INSERT INTO doctors (userid,name,gender,phoneNumber,email,dateOfBirth,divission,district,thana,specialty,degree,bmdcRegNo,description)
                  VALUES ('$udid','$name','$gender','$phoneNumber', '$email','$dateOfBirth','$divission','$district','$thana', '$specialty','$degree','$bmdcRegNo','$description');";
    	mysqli_query($conn, $sql1);
    	$con->getAll("DELETE FROM `temp_doc_request` WHERE userid='$uid'");
  	}
  	foreach($holdTempUserData as $getData){
  		$uuid=$getData['userid'];
	 	$password=$getData['password'];
	 	$status=$getData['status'];

	 	$sql2 = "INSERT INTO users (userid,password,status) VALUES ('$uuid','$password','$status');";
    	mysqli_query($conn, $sql2);
    	$con->getAll("DELETE FROM `temp_doc_user` WHERE userid='$uid'");
  	}
  	$holdDashboardData=$con->getAll("SELECT * FROM temp_doc_request");
	
  }
  	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Admin Doctors Request</title>
 	<link rel="stylesheet" href="">
 </head>
 <body>
 	<form action="Admin_Doctor_Request.php?<?php echo $_SESSION['userid'] =$userid;?>" method="POST" accept-charset="utf-8">
	 	<table style="width:100%; background-color: skyblue" border="2" id="myTable">
	 		<caption>Doctor's Request List</caption>
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>User Id</th>
	 				<th>Name</th>
	 				<th>Gender</th>
	 				<th>Phone Number</th>
	 				<th>Email</th>
	 				<th>Date Of Birth</th>
	 				<th>Divission</th>
	 				<th>District</th>
	 				<th>Thana</th>
	 				<th>Specialty</th>
	 				<th>Degree</th>
	 				<th>Bmdc Reg. No.</th>
	 				<th>Description</th>
	 				<th>Accept</th>
	 				<th>Reject</th>
	 			</tr>
	 		</thead>
	 		<?php foreach($holdDashboardData as $getData){ ?>
	 		<tbody>
	 			<tr>
	 				<td><?php echo $getData['id'] ?></td>
	 				<td><?php echo $getData['userid'] ?></td>
	 				<td><?php echo $getData['name'] ?></td>
	 				<td><?php echo $getData['gender'] ?></td>
	 				<td><?php echo $getData['phoneNumber'] ?></td>
	 				<td><?php echo $getData['email'] ?></td>
	 				<td><?php echo $getData['dateOfBirth'] ?></td>
	 				<td><?php echo $getData['divission'] ?></td>
	 				<td><?php echo $getData['district'] ?></td>
	 				<td><?php echo $getData['thana'] ?></td>
	 				<td><?php echo $getData['specialty'] ?></td>
	 				<td><?php echo $getData['degree'] ?></td>
	 				<td><?php echo $getData['bmdcRegNo'] ?></td>
	 				<td><?php echo $getData['description'] ?></td>
	 				<!--<td><input type="button" name="" value="Delete" onclick="deleteRow(this)"></td> -->
	 				<td><input type="submit" id="delete" name="accept" value="<?php echo $getData['userid'] ?>" onclick="return confirm('are you sure?')"></td>
	 				<td><input type="button" name="" value="Delete" onclick="deleteRoww()"></td>
	 			</tr>
	 		</tbody>
	 		<?php } ?>
	 	</table>
	 </form>
	 
	 <script>
	 	function deleteRow(r){
	 		var i = r.parentNode.parentNode.rowIndex;
	 		document.getElementById("myTable").deleteRow(i);
	 	}
	 	function myFunction(){
	 		var selected=document.getElementById('delete').value;
	 		var s=document.getElementByName('reject').value;
	 		document.getElementById('a').innerHTML = selected;
	 		document.getElementById('b').innerHTML = s;
	 	}
	 </script>

 </body>
 </html>