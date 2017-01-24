<?php
   include('config.php');
   session_start();
   
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select user_name from USER where user_name = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['user_name'];
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
   

   //find uid
   $ses_sql2 = mysqli_query($db,"select uid from USER where user_name = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql2,MYSQLI_ASSOC);
   
   $login_uid = $row['uid'];

?>