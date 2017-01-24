<html>

<?php
   include('session.php');
?>

  
   <head>
      <title>Welcome!</title>
   </head>
   
   <body>
      <h1>Welcome, <?php echo $login_session; ?></h1> 
      <h2>Submit a Friend Request </h2>

      <!--Get user id from user -->
      <form action = "submitfriendrequest2.php" method = "post">
      Submit Request to Username: <input type = "text" name = "username"> <br>
      <input type="submit">
      </form>
      <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>

   </body>




</html>
