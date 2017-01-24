<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Welcome <?php echo $username;?> You are logged in to TOURINI!</title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?>, you are logged in to TOURINI!</h1> 


<?php
$result = $db->query(sprintf("SELECT * FROM `ULOCATION` JOIN `CIRCLE` ON CIRCLE.cid = ULOCATION.cid WHERE uid= '%s'",$login_uid));

echo "<i> Your recent locations: </i><br>";


if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        echo $row["ltimestamp"] . "<br>";
        echo $row["ulong"] . " , " . $row["ulat"] . "<br>";
        echo "---------------- <br>";
    }
} else {
    echo "you haven't gone anywhere <br>";
}

?>
<div> <a href = "submitlocation.php"> <font size="4">Share a recent trip</font></a> </div>

      <h2>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>