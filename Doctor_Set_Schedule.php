<?php
	include "includes/db_connect.inc.php";
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	$userid=$_SESSION["userid"];
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$doctorid=$doctorName=$doctorMail=$specialty=$clinicid=$clinicName=$time=$date=$divission=$district=$thana="";
	$doctorid=$userid;

	$holdDashboardData=$con->getAll("SELECT * FROM `clinics`");
	$holdScheduleData=$con->getAll("SELECT * FROM `set_schedule` WHERE doctorid='$userid'");

	//if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(isset($_POST['submit'])){
  		if(!empty($_POST['clinic_id'])){
      		$clinicid = mysqli_real_escape_string($conn, $_POST['clinic_id']);
	    }
	    if(!empty($_POST['date'])){
	      	$date = mysqli_real_escape_string($conn, $_POST['date']);
	    }
	    if(!empty($_POST['time'])){
      		$time = mysqli_real_escape_string($conn, $_POST['time']);
   		}
   		//Clinic Value
	    $holdClinicData=$con->getAll("SELECT * FROM `clinics` WHERE userid='$clinicid'");
	    foreach($holdClinicData as $getData){
		 	$clinicName=$getData['name'];
		 	$divission=$getData['divission'];
		 	$district=$getData['district'];
		 	$thana=$getData['thana'];
	 	}
	 	//Doctor Value
	 	$holdDoctorData=$con->getAll("SELECT * FROM `doctors` WHERE userid='$doctorid'");
	   	foreach($holdDoctorData as $getData){
			 $doctorName=$getData['name'];
			 $doctorMail=$getData['email'];
			 $specialty=$getData['specialty'];
		 }

	    

   		$sql1 = "INSERT INTO set_schedule (doctorid,doctorName,doctorMail,specialty,clinicid,clinicName,date,time,divission,district,thana)
	                  VALUES ('$doctorid','$doctorName','$doctorMail','$specialty','$clinicid','$clinicName','$date','$time','$divission','$district','$thana');";
	    mysqli_query($conn, $sql1);
	    $holdScheduleData=$con->getAll("SELECT * FROM `set_schedule` WHERE doctorid='$userid'");

    }elseif (isset($_POST['reject'])) {
    	$id=$_POST['reject'];
  		$con->getAll("DELETE FROM `set_schedule` WHERE id='$id'");
  		//header("Location:Doctor_Show_All_Schedule.php?$userid");
    }
  	
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Doctor Set Schedule</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 	<link rel="stylesheet" href="">
 	<link rel="stylesheet" href="">
 
 </head>

  <style type="text/css">
	
	#ui{
		background-color: #333;
		padding: 15px;
		margin-top: 20px;
	}
	#ui label,h1{
		color: #fff;
	}

</style>
 <body>

 	<div class ="container">

		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">

				<div id="ui">
					<h1 class="text-center">Set Schedule</h1>
		              <form action="Doctor_Set_Schedule.php?<?php echo $_SESSION['userid']=$userid;?>" method="POST"accept-charset="utf-8">


			<label for="Clinic Name">Clinic Name:</label>
			<div class="row">
				<div class="col-lg-6">
					<select name="clinic_id" id="cid"  class="form-control">
						<?php foreach($holdDashboardData as $getData){ ?>
				<option value="<?php echo $getData['userid'] ?>"><?php echo $getData['name'] ?></option>
				<?php } ?>
							

			            </select>

				</div>
			</div>
				<br>

				<label for="date">Date:<input type="date" name="date" id="date" class="form-control" ></label><br>

				<label for="time">Time:</label>

			<div class="row">
				<div class="col-lg-6">
				
			<select name="time" id="time" class="form-control">
				<option selected disabled >Schedule Time</option>
				<option value="10AM">10AM</option>
				<option value="12PM">12PM</option>
				<option value="4PM">4PM</option>
				<option value="6PM">6PM</option>
				<option value="8PM">8PM</option>
			</select><br>
				</div>
			</div>	
 

			<input type="submit" name="submit" value="Add New Schedule" onClick="addMoreRows()" class="btn btn-primary btn-block btn-lg">

			
		
	</div>
</form>
</div>
</div>
</div>

            <button type="button" onclick="window.location='Doctor_Home_Page.php'">Home Page</button>
  	        <button type="button" onclick="window.location='logout.php'">Log Out</button><br><br><br>

 	

	 	<table style="width:100%; background-color: skyblue" border="2" id="myTable">
	 		<caption style="text-align: center;"><b>All Set Schedule</b></caption>
	 		<thead>
	 			<tr>
	 				<th>Id</th>
	 				<th>Clinic Id</th>
	 				<th>Clinic Name</th>
	 				<th>Date</th>
	 				<th>Time</th>
	 				<th>Divission</th>
	 				<th>District</th>
	 				<th>Thana</th>
	 				<th>Delete</th>
	 			</tr>
	 		</thead>
	 		<?php foreach($holdScheduleData as $getData){ ?>
	 		<tbody>
	 			<tr>
	 				<td><?php echo $getData['id'] ?></td>
	 				<td><?php echo $getData['clinicid'] ?></td>
	 				<td><?php echo $getData['clinicName'] ?></td>
	 				<td><?php echo $getData['date'] ?></td>
	 				<td><?php echo $getData['time'] ?></td>
	 				<td><?php echo $getData['divission'] ?></td>
	 				<td><?php echo $getData['district'] ?></td>
	 				<td><?php echo $getData['thana'] ?></td>
	 				<td><input type="button" value="Delete" onclick="window.location='Doctor_Delete_Schedule.php?id=<?php echo $getData['id']; ?>'" /></td>
	 			</tr>
	 		</tbody>
	 		<?php } ?>
	 	</table>


 </body>
 </html>