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
$result = $db->query("SELECT * FROM `PHOTOS` JOIN `CIRCLE` ON CIRCLE.cid=PHOTOS.cid WHERE uid= $login_uid");

echo "<i> Your recent pictures: </i><br>";


if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
 ?>

        <img src="<?php echo $row['photourl']; ?>" width = "350"/>
        
<?php
        echo $row["caption"] . "<br>";
        echo $row["ptimestamp"] . "<br>";
        echo $row["plong"] . ', ' . $row["plong"] . "<br>";
        echo "---------------- <br>";
    }
} else {
    echo "you haven't made any picture posts <br>";
}


?>

      <h2>
      <div> <a href = "bookmark.php"> <font size="3">Bookmarked posts</font></a> </div>
      <div> <a href = "submitphotos.php"> <font size="3">Post a picture</font></a> </div>
      <div> <a href = "welcome.php"> <font size="4">Back to home page</font></a> </div>
      </h2>
  
   </body>
   
</html>