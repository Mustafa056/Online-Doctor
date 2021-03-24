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
	<title>Doctor Home Page</title>
	<link rel="stylesheet" href="stylesheet_doc.css">
</head>
<body>
	<header class="header">
		<!-- this will be on to right side of the header -->
	</header><!-- /header -->

	<div class="sidenav">	<!-- https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_sidenav_dropdown -->
	  <a href="Doctor_Profile.php?<?php echo $_SESSION['userid'] = $userid; ?>">Profile</a>
	  <a href="Doctor_Set_Schedule.php">Set Schedule</a>
	  <!--<a href="Doctor_Show_All_Schedule.php?">Show All Schedule</a>-->
	  <!--<a href="#clients">Requested Appointment</a>-->
	  <a href="Doctor_P_Waiting_List.php">Patient Waiting List</a>
	  <!--
	  <button class="dropdown-btn">Dropdown 
	    <i class="fa fa-caret-down"></i>
	  </button>
	  <div class="dropdown-container">
	    <a href="#">Link 1</a>
	    <a href="#">Link 2</a>
	    <a href="#">Link 3</a>
	  </div>
	-->
	  <a href="Doctor_Patients_Records.php?<?php echo $_SESSION['userid'] = $userid; ?>">Patients Records</a>
	</div>

	<div class="main" >
	  <h2 style="text-align: center;">Welcome Mr: <?php echo  $userid; ?>.</h2>
	  <p style="text-align: center;">Now Time is <?php echo  date("h:i:sa"); ?></p>
	</div>

	<script>
	/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
	/*
	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
	  dropdown[i].addEventListener("click", function() {
	  this.classList.toggle("active");
	  var dropdownContent = this.nextElementSibling;
	  if (dropdownContent.style.display === "block") {
	  dropdownContent.style.display = "none";
	  } else {
	  dropdownContent.style.display = "block";
	  }
	  });
	}
	*/
	</script>	
		

	<footer class="footer" style="text-align: right;">
		<a href="logout.php"><b>Logout</b></a>
	</footer>
</body>
</html>

