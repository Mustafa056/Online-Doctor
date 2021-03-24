<?php

$dbServerName = "localhost";
$dbUserName = "root";
$dbPassword = "";
$dbName = "webtec_19";
//$dbName = "web_test";
$conn = mysqli_connect($dbServerName, $dbUserName, $dbPassword, $dbName);

if(mysqli_connect_errno()){
  echo "Error: ".mysqli_connect_err();
}

?>
