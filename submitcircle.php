<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Welcome <?php echo $username;?> You are logged in to TOURINI!</title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?>, you are logged in to TOURINI!</h1> 



<p> </p>

<form action="submitcircle2.php" method="post">
Create new circle <br>
Insert new circle name: <input type="text" name="add_circle"><br>
<br>
<br>

Or modify a circle:
<select name="cid">

<?php
$result = $db->query(sprintf("SELECT cid, cname FROM `CIRCLE` WHERE uid= '%s'",$login_uid));


if ($result->num_rows > 0) {
    // output data of each row
    
    
    while($row = $result->fetch_assoc()) {
        $name = $row["cname"];
        $cid = $row["cid"];
        echo sprintf('<option value="%d">%s</option>', $cid, $name);
    }
}
?>
</select>

Select the friend you wish to add into the circle (leave none if you don't want to add anyone)
<select name="new_member">

<?php
$result2 = $db->query(sprintf("SELECT uid2, name FROM `FRIENDS` JOIN `USER` ON USER.uid = uid2 WHERE uid1= '%s'",$login_uid));


if ($result2->num_rows > 0) {
    // output data of each row
    echo sprintf('<option value="NULL">none</option>', $fuid, $fname);
    while($row = $result2->fetch_assoc()) {
        $fname = $row["name"];
        $fuid = $row["uid2"];
        echo sprintf('<option value="%s">%s</option>', $fuid, $fname);
    }
    
}
?>

<input type="submit">
</form>





      <h2>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>