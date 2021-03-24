<?php 
	include 'Connection.php';
  	$con=new Connection;
  	session_start();
	
	if(!isset($_SESSION["userid"])){
	   header("Location: login.php");
	}
	$getId=$_GET['id'];

	$con->getAll("DELETE FROM `set_schedule` WHERE id='$getId'");
	header("location:Doctor_Set_Schedule.php");

?>
