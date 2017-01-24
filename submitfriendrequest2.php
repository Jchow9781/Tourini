<html>

<?php
   include('session.php');

   $to_username = mysqli_real_escape_string($db,$_POST['username']);

   $sql = "SELECT uid FROM USER WHERE user_name = '$to_username'";
   $result = mysqli_query($db,$sql);
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $active = $row['active'];
   $count = mysqli_num_rows($result);

//   echo $row["uid"];
//   echo "your mom";
   $touid = $row["uid"];
//   echo $touid;


   if($count == 1) {
      mysqli_query($db, "INSERT INTO REQUESTS (fromuid, touid) VALUES ($login_uid, $touid)");
      echo "Success!";
   }
   else{
      echo "User was not found";
   }
?>
<p> <a href ="welcome.php">Home</a> </p>
</html>	