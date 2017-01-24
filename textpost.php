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
$result = $db->query("SELECT  * 
FROM  `MESSAGE` 
JOIN  `CIRCLE` ON CIRCLE.cid = MESSAGE.cid
WHERE uid =$login_uid");

echo "<i> Your recent text posts: </i><br>";


if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        echo $row["text"] . "<br>";
        echo $row["Mtimestamp"] . "<br>";
        if($row["mlong"] != NULL && $row["mlat"] != NULL){
            echo 'Location: ' . $row["mlong"] . ', ' . $row["mlat"] . '<br>';
        }
        echo "---------------- <br>";
    }
} else {
    echo "you havent made any text posts <br>";
}


?>

      <h2>
      <div> <a href = "submittext.php"> <font size="4">Submit a post</font></a> </div>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>