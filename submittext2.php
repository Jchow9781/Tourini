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

$input_text = $_POST["text"];
$target_cid = $_POST["cid"];
$mlong = $_POST["mlong"];
$mlat = $_POST["mlat"];

if ($mlong == NULL || $mlat == NULL){
    $sql = sprintf("INSERT INTO `MESSAGE` (cid, `text`, mlong, mlat) VALUES(%s, '%s')", $target_cid, $input_text);
} else {
    $sql = sprintf("INSERT INTO `MESSAGE` (cid, `text`, mlong, mlat) VALUES(%s, '%s', %s, %s)", $target_cid, $input_text, $mlong, $mlat);
}
if ($db->query($sql) === TRUE) {
    echo "<i> Post successfully made </i><br>";
} else {
    echo "Error: " . $sql . "<br>" . $db->error. "<br>";
}
?>

      <h2>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>