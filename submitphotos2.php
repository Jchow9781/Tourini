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

$input_text = $_POST["caption"];
$target_cid = $_POST["cid"];
$plong= $_POST["plong"];
$plat= $_POST["plat"];
$photourl= $_POST["photourl"];

$result = $db->query("SELECT MAX(`pid`) AS max_pid FROM `PHOTOS` ORDER BY pid");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $max_pid = $row["max_pid"]+1;
    }

}
if ($plong == NULL || $plat == NULL){
    $sql = sprintf("INSERT INTO `PHOTOS` (pid, cid, `caption`, photourl, plong, plat) VALUES(%s, %s, '%s', '%s')", $max_pid, $target_cid, $input_text, $photourl);
} else { 
    $sql = sprintf("INSERT INTO `PHOTOS` (pid, cid, `caption`, photourl, plong, plat) VALUES(%s, %s, '%s', '%s', %s, %s)", $max_pid, $target_cid, $input_text, $photourl, $plong, $plat);
}
if ($db->query($sql) === TRUE) {
    echo "<i> Picture successfully shared </i><br>";
} else {
    echo "Error: " . $sql . "<br>" . $db->error. "<br>";
    echo '<div> <a href = "submitphotos.php"> <font size="4">try again</font></a> </div><br>';
}
?>

      <h2>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>