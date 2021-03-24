<?php 

  include "includes/db_connect.inc.php";
  include 'Connection.php';
    $con=new Connection;
    session_start();
  
  if(!isset($_SESSION["userid"])){
     header("Location: login.php");
  }
  $Sid=$_GET['Sid'];
  $Pid=$_SESSION["userid"];
  $holdSidData=$con->getAll("SELECT * FROM `set_schedule` WHERE id=$Sid");
  $holdPidData=$con->getAll("SELECT * FROM `patients` WHERE userid='$Pid'");
  //variables
  $patientId=$PatientName=$patientGender=$patientNumber=$dateOfBirth=$doctorId=$date=$time=$clinicName=$clinicId=$divission=$district=$thana="";


  /////////////////////////////////////////

  $cardName=$cardNumber=$amount=$expMonth=$expYear=$cvv=$payDate="";
  if(isset($_POST['submit'])){
      $cardName=$_POST['cardName'];
      $cardNumber=$_POST['cardNumber'];
      $amount=$_POST['amount'];
      $expMonth=$_POST['expMonth'];
      $expYear=$_POST['expYear'];
      $cvv=$_POST['cvv'];
      $payDate= date("Y-m-d");
      //$payDate= "dfsf";
      
      ///////////////////////////////
      foreach($holdSidData as $getData){
        $doctorId=$getData['doctorid'];
        $date=$getData['date'];
        $time=$getData['time'];
        $clinicId=$getData['clinicid'];
        $clinicName=$getData['clinicName'];
        $divission=$getData['divission'];
        $district=$getData['district'];
        $thana=$getData['thana'];
      }
      foreach($holdPidData as $getData){
        $patientId=$getData['userid'];
        $PatientName=$getData['name'];
        $patientGender=$getData['gender'];
        $patientNumber=$getData['phoneNumber'];
        $dateOfBirth=$getData['dateOfBirth'];
      }

      $sql1 = "INSERT INTO `payment` (patientId,doctorId,payDate,cardName,cardNumber,amount,expMonth,expYear,cvv)
                    VALUES ('$Pid','$doctorId','$payDate','$cardName','$cardNumber','$amount', '$expMonth','$expYear','$cvv');";
      mysqli_query($conn, $sql1);
      
      $sql1 = "INSERT INTO `patient_wating_list` (patientId,patientName,patientGender,patientNumber,dateOfBirth,doctorId,date,time,clinicId,clinicName,divission,district,thana)
                        VALUES ('$patientId','$PatientName','$patientGender','$patientNumber', '$dateOfBirth','$doctorId','$date','$time','$clinicId', '$clinicName','$divission','$district','$thana');";
      mysqli_query($conn, $sql1);
      header("location:Patient_Take_Apntmnt.php");
    }

?>








<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<h2>Payment For Take a Appointment</h2>
<p><p>Please Fill up the Informtion and Proceed For Checkout</p>
<div class="row">
  <div class="col-75">
    <div class="container">
      <form action="" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardName" placeholder="Card Name" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardNumber" placeholder="Card Number" required>
            <label for="expmonth">Amount</label>
            <input type="radio" id="expmonth" name="amount" value="300" checked>Old:300 tk
            <input type="radio" id="expmonth" name="amount" value="500">New:500 tk
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expMonth" placeholder="Expare Month" required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expYear" placeholder="Expare Year" required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="CVV" required>
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Take a Printout and Download
        </label>
        
        <input type="submit" name="submit" value="Continue to Appointment" class="btn"  />
      </form>
    </div>
  </div>
</div>

</body>
</html>
