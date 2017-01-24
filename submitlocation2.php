<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Welcome <?php echo $username;?> You are logged in to TOURINI!</title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session;?> </h1> 



<?php

$llong = $_POST["llong"];
$llat = $_POST["llat"];
$target_cid = $_POST["cid"];

$sql = sprintf("INSERT INTO `ULOCATION` (cid, ulong, ulat) VALUES(%s, %s, %s)", $target_cid,$llong,$llat);
if ($db->query($sql) === TRUE) {
    echo "<i> Visit successfully shared </i><br>";
} else {
    echo "Error: " . $sql . "<br>" . $db->error. "<br>";
    echo '<div> <a href = "submitlocation.php"> <font size="4">try again</font></a> </div> <br>';
}
?>

      <h2>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>