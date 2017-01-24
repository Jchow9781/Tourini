<?php
   include('session.php');
?>

<html">
   
   <head>
      <title>Welcome, <?php echo $username;?>. !</title>
   </head>
   
   <body>
      <h1>Welcome, <?php echo $login_session; ?></h1> 
      <h2>Friends of friends: </h2>
          
      <?php 
      //Outputting the friends list
      $sql = sprintf("SELECT name
FROM ((SELECT uid2
FROM FRIENDS
WHERE uid1 = %s)
UNION (
SELECT DISTINCT ff.uid2
FROM FRIENDS f
JOIN FRIENDS ff ON ff.uid1 = f.uid2
WHERE f.uid1 = %s)) AS foff 
JOIN USER on uid=uid2", $login_uid, $login_uid);

      $result = $db->query($sql);
      if ($result->num_rows > 0) {
      // output data of each row
         while($row = $result->fetch_assoc()) {
            echo " ".$row["name"]." <br>";
        }
      }
      else {
         echo "0 results";
      }
      ?>
<br>
<br>
      <div> <a href = "friends.php"><font size="4">back to friends</font></a> </div>
      <h2><a href = "welcome.php">Go Back</a></h2>
  
   </body>
   
</html>