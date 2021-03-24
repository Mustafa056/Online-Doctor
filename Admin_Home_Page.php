<?php
  session_start();
  $userid=$_SESSION["userid"];
  if(!isset($_SESSION["userid"])){
    header("Location: login.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Home Page</title>
	<link rel="stylesheet" href="stylesheet.css">
</head>
<body>
	<header id="header" class="">
		<h1 style="text-align: center;"><i><b>Congratulations Admin</b></i></h1>
		<h2 style="text-align: center;">Admin Name: <?php echo $userid; ?></h2>
		<!-- this will be on to right side of the header -->
	</header><!-- /header -->

		
		<div id="admin_navbar" style="text-align: center;">
			<div class="dropdown">
			  <button class="dropbtn">Doctor</button>
			  <div class="dropdown-content">
			    <a href="Admin_Doctors_List.php?<?php echo $_SESSION['userid'] = $userid; ?>">Doctors List</a>
			    <a href="Admin_Doctor_Request.php?<?php echo $_SESSION['userid'] = $userid; ?>">Doctor's Request</a>
			  </div>
			</div>
			<div class="dropdown">
			  <button class="dropbtn">Patient</button>
			  <div class="dropdown-content">
			    <a href="Admin_Patients_List.php?<?php echo $_SESSION['userid'] = $userid; ?>">Patient List</a>
			    <a href="Admin_Patients_History.php?<?php echo $_SESSION['userid'] = $userid; ?>">Patient History</a>
			  </div>
			</div>
			<div class="dropdown">
			  <button class="dropbtn">Clinic</button>
			  <div class="dropdown-content">
			    <a href="Admin_Clinic_List.php?<?php echo $_SESSION['userid'] = $userid; ?>">Clinic List</a>
			    <a href="Admin_Clinic_Reg.php?<?php echo $_SESSION['userid'] = $userid; ?>">Clinic Registration</a>
			  </div>
			</div>
		</div>

		<br><br>
		<br><br>
		<br><br>

		

	<footer style="text-align: center;">
		<a href="logout.php"><b>Logout</b></a><!-- &copy; this will be on the middle of the footer source (https://www.w3schools.com/html/html_symbols.asp) -->
	</footer>
</body>
</html>

