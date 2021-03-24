<?php 

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title>Doctor Set Schedule</title>
 	<link rel="stylesheet" href="">
  <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
  
<script type="text/javascript">
    $( document ).ready(function() {
        console.log( "ready!" );

        $( ".tblRows" ).click(function() {
            var row_data = $(this).attr("data");
            alert(row_data);
        });
    });
</script>
 </head>
 <body>
 <?php
    $employee[] = array('id'=>'111', 'name'=>'Mango');
    $employee[] = array('id'=>'222', 'name'=>'Apple');

    echo '<table border=1>';
    foreach ($employee as $key => $value) {
        echo "<tr class='tblRows' data='".$value['id']."-".$value['name']."'>";
            echo "<td>".$value['id']."</td>";
            echo "<td>".$value['name']."</td>";
        echo "</tr>";
    }
    echo '</table>';
?>



 </body>
 </html>