<?php
   include('session.php');
?>

<html">
   
   <head>
      <title>Welcome, <?php echo $username;?>. !</title>
   </head>
   
   <body>
      <h1>Welcome, <?php echo $login_session; ?></h1> 
      <h2>Your Friends: </h2>
          
      <?php 
      //Outputting the friends list
      $sql = "SELECT name
              FROM USER JOIN FRIENDS ON uid=uid2
              WHERE uid1 = $login_uid";

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
      <div> <a href = "friendsoffriends.php"><font size="4">See your friends of friends</font></a> </div>
      <div> <a href = "submitcircle.php"><font size="4">create or modify a circle</font></a> </div>
      <h2><a href = "welcome.php">Go Back</a></h2>
  
   </body>
   
</html>