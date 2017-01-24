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

$circle_name = $_POST["add_circle"];
$target_cid = $_POST["cid"];
$new_member= $_POST["new_member"];


$result = $db->query("SELECT MAX(`cid`) AS max_cid FROM `CIRCLE` ORDER BY cid");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $max_cid =($row["max_cid"]+1);
    }

}


if($circle_name != NULL){
    $sql = sprintf("INSERT INTO `CIRCLE` (cid, uid, cname) VALUES(%s, %s, '%s')", $max_cid, $login_uid, $circle_name);
    if ($db->query($sql) === TRUE) {
    echo "<i> Post successfully made </i><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error. "<br>";
    }
} elseif($new_member != NULL){
    $sql = sprintf("INSERT INTO `CMEMBERS` (cid, members) VALUES(%s, %s)", $target_cid, $new_member);
    if ($db->query($sql) === TRUE) {
    echo "<i> User added to circle </i><br>";
    } else {
        echo "Error: " . $sql . "<br>" . $db->error. "<br>";
    }
}
?>

      <h2>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>