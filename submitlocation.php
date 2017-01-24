<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Welcome <?php echo $username;?> You are logged in to TOURINI!</title>
   </head>
   
   <body>
      <h1>Welcome <?php echo $login_session; ?>, you are logged in to TOURINI!</h1> 


<i> What would you like to say?: </i><br>
<p> </p>

<form action="submitlocation2.php" method="post">
Where have you recently been? <br>
Longitude: <input type="text" name="llong"><br>
Latitude: <input type="text" name="llat"><br>


<select name="cid">
<?php
$result = $db->query("SELECT cid, cname FROM `CIRCLE` WHERE uid= $login_uid");

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


<input type="submit">
</form>





      <h2>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>