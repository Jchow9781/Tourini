<?php
   include('session.php');
?>
<html>
   
   <head>
      <title>Welcome <?php echo $username;?> You are logged in to TOURINI!</title>
   </head>
   
   <body>
      <center> <img src="https://i.gyazo.com/ef6a99447b5e67bb044a2df22bbb1622.png" alt="yourmom"> </center>
      <h1><center>Welcome <?php echo $login_session; ?>, you are logged in to TOURINI!</center></h1> 
      <h3>Friend Requests:</h3>

<?php
$result = $db->query("SELECT name FROM `REQUESTS` JOIN `USER` ON touid=USER.uid WHERE fromuid = $login_uid");

//----------------------------------------------------------------------------------------------
//----------------------------------FRIEND REQUESTS SENT----------------------------------------
//----------------------------------------------------------------------------------------------


echo "<i><b>  Friend requests sent: </b></i><br>";


if ($result->num_rows > 0) {
    // output data of each row
    
    while($row = $result->fetch_assoc()) {
        echo $row["name"] . "<br>";     
    }
} 
else {
    echo "No Pending Friend Requests Sent <br>";
}

//----------------------------------------------------------------------------------------------
//--------------------------------FRIEND REQUESTS RECEIVED--------------------------------------
//----------------------------------------------------------------------------------------------

echo "<i><b><br> Friend requests received: </b></i><br>";

$result2 = $db->query("SELECT name, fromuid FROM `REQUESTS` JOIN `USER` ON fromuid=USER.uid WHERE touid = $login_uid");
//$fromuid = $db->query("SELECT fromuid FROM `REQUESTS` JOIN `USER` ON fromuid=USER.uid WHERE touid = $login_uid");
//$row2 = t->fetch_assoc()

if ($result2->num_rows > 0) {
    // output data of each row
   
    while($row = $result2->fetch_assoc()) {
        echo $row["name"] . "<br>"; ?>

    <form action = '' method = 'POST'>
    <input type = 'submit' name = 'accept' value = 'Accept'/>
    <input type = 'submit' name = 'decline' value = 'Decline'/>
    </form>

<?php
    
   if(isset($_POST['accept'])){ 
   mysqli_query($db, "DELETE FROM REQUESTS WHERE touid = '".$login_uid."' AND fromuid ='" .$row['fromuid']."' ");
   mysqli_query($db, "INSERT INTO FRIENDS VALUES ('".$login_uid."', '".$row['fromuid']."')");
   mysqli_query($db, "INSERT INTO FRIENDS VALUES ('" .$row['fromuid']."', '".$login_uid."')");
   }

   
   if(isset($_POST['decline'])){ 
   mysqli_query($db, "DELETE FROM REQUESTS WHERE touid = '".$login_uid."' AND fromuid ='" .$row['fromuid']."' ");
   }
  }
} 
else {
    echo "no new friend requests received <br>";
}

//----------------------------------------------------------------------------------------------
//----------------------------------------TEXT POSTS--------------------------------------------
//----------------------------------------------------------------------------------------------

$result_text1 = $db->query(sprintf("SELECT *
FROM MESSAGE
JOIN CIRCLE ON CIRCLE.cid = MESSAGE.cid AND CIRCLE.uid!= %s
JOIN USER ON CIRCLE.uid=USER.uid
WHERE CIRCLE.`call`
Limit 0,5",$login_uid));


$result_text2 = $db->query(sprintf("SELECT *
FROM (SELECT uid1 FROM FRIENDS WHERE uid2 = %s) AS F
JOIN (
SELECT name, CIRCLE.uid,`text`, mtimestamp
FROM MESSAGE
JOIN CIRCLE ON CIRCLE.cid = MESSAGE.cid
JOIN USER ON CIRCLE.uid = USER.uid
WHERE CIRCLE.cfriend 
) AS Q ON Q.uid = uid1",$login_uid));


$result_text3 = $db->query(sprintf("SELECT *
FROM MESSAGE
JOIN CIRCLE ON CIRCLE.cid = MESSAGE.cid AND CIRCLE.uid!= %s
JOIN USER ON CIRCLE.uid=USER.uid
JOIN CMEMBERS ON CIRCLE.cid= CMEMBERS.cid
WHERE members = %s", $login_uid, $login_uid));

echo "<h3>Newest Text Posts From All Users:<br></h3>";
if ($result_text1->num_rows > 0) {
    // output data of each row
    
    while($row = $result_text1->fetch_assoc()) {
        echo "By:  " . $row["name"] . "|| At: " . $row["mtimestamp"] . "<br>";
        echo "Post:  ". $row["text"] . "<br>";
        if($row["mlong"] != NULL && $row["mlat"] != NULL){
            echo 'Location: ' . $row["mlong"] . ', ' . $row["mlat"] . '<br>';
        }
        echo "<br>";
    }
}
else {
   echo "Nothing has been posted yet";}


echo "<h3>Newest Text Posts From Your Friends:<br></h3>";
if($result_text2->num_rows > 0) {
    while($row = $result_text2->fetch_assoc()) {
        echo "By:  " . $row["name"] . "|| At: " . $row["mtimestamp"] . "<br>";
        echo "Post:  ". $row["text"] . "<br>";
        if($row["mlong"] != NULL && $row["mlat"] != NULL){
            echo 'Location: ' . $row["mlong"] . ', ' . $row["mlat"] . '<br>';
        }
        echo "<br>";
    }
}
else {
   echo "Nothing has been posted yet";}


echo "<h3>Newest Text Posts From Members of Your Circles:<br></h3>";
if($result_text3->num_rows > 0){
    while($row = $result_text3->fetch_assoc()) {
        echo "By:  " . $row["name"] . "|| At: " . $row["mtimestamp"] . "<br>";
        echo "Post:  ". $row["text"] . "<br>";
        if($row["mlong"] != NULL && $row["mlat"] != NULL){
            echo 'Location: ' . $row["mlong"] . ', ' . $row["mlat"] . '<br>';
        }
        echo "<br>";
    }
}
else {
   echo "Nothing has been posted yet :( <br>";}

?>


<p></p>
<div> <a href = "textpost.php"><font size="3">See your message posts</font></a>

<?php

//----------------------------------------------------------------------------------------------
//-------------------------------------PICTURE POSTS--------------------------------------------
//---------------------------------------------------------------------------------------------- 

$arb_counter;

$result_photo1 = $db->query(sprintf("SELECT *
FROM PHOTOS
JOIN CIRCLE ON CIRCLE.cid = PHOTOS.cid AND CIRCLE.uid!= %s
JOIN USER ON CIRCLE.uid=USER.uid
WHERE CIRCLE.`call`",$login_uid));


$result_photo2 = $db->query(sprintf("SELECT *
FROM (SELECT uid1 FROM FRIENDS WHERE uid2 = %s) AS F
JOIN (
SELECT name, CIRCLE.uid,`text`, mtimestamp
FROM PHOTOS
JOIN CIRCLE ON CIRCLE.cid = PHOTOS.cid
JOIN USER ON CIRCLE.uid = USER.uid
WHERE CIRCLE.cfriend
) AS Q ON Q.uid = uid1",$login_uid));



$result_photo3 = $db->query(sprintf("SELECT *
FROM PHOTOS
JOIN CIRCLE ON CIRCLE.cid = PHOTOS.cid AND CIRCLE.uid!= %s
JOIN USER ON CIRCLE.uid=USER.uid
JOIN CMEMBERS ON CIRCLE.cid= CMEMBERS.cid
WHERE members = %s", $login_uid, $login_uid));



echo "<h3>Newest Picture Posts From All Users:<br></h3>";
if ($result_photo1->num_rows > 0) {
    // output data of each row
    while($row = $result_photo1->fetch_assoc()) {
        echo "By:  " . $row["name"] ."<br>"; ?>

        <img src="<?php echo $row['photourl']; ?>" width = "350"/>
        <form action = '' method = 'POST'>
        <input type='submit' name = 'bookmark' value = 'Bookmark'/>
        </form>

<?php if(isset($_POST['bookmark'])){
     mysqli_query($db,"INSERT INTO BOOKMARK (`buid`, `bpid`) ( VALUES ('$login_uid', '".$row["pid"]."')");
 
}
        
        echo $row["pid"];
        echo "<br>Caption:  ". $row["caption"] . "<br>";
        if($row["plong"] != NULL && $row["plat"] != NULL){
            echo 'Location: ' . $row["plong"] . ', ' . $row["plat"] . '<br>';
        }
		echo '<br>';
     }
}
else {
    echo "Nothing has been posted yet :( <br>";
}


echo "<h3>Newest Picture Posts From Your Friends:<br></h3>";
if ($result_photo2->num_rows > 0) {
    // output data of each row

    while($row = $result_photo2->fetch_assoc()) {
        echo "By:  " . $row["name"] .  "<br>"; ?>

        <img src="<?php echo $row['photourl']; ?>" width = "350"/>

        <form action = '' method = 'POST'>
        <input type='submit' name = 'bookmark' value = 'Bookmark'/>
        </form>

<?php if(isset($_POST['bookmark'])){
     mysqli_query($db,"INSERT INTO `BOOKMARK` (`buid`, `bpid`) ( VALUES ('".$login_uid."', '" .$row['pid']."',)");
 
}
        
        echo "Caption:  ". $row["caption"] . "<br>";
        if($row["plong"] != NULL && $row["plat"] != NULL){
            echo 'Location: ' . $row["plong"] . ', ' . $row["plat"] . '<br>';
        }
        echo "<br>";
    }
}
else {
   echo "Nothing has been posted yet :( <br>";}


echo "<h3>Newest Picture Posts From Members of Your Circles:<br></h3>";
if ($result_photo3->num_rows > 0) {
    // output data of each row

    while($row = $result_photo3->fetch_assoc()) {
        echo "By:  " . $row["name"] . "|| From: " . $row["mcoordinate"] . "<br>"; ?>

        <img src="<?php echo $row['photourl']; ?>" width = "350"/>
        <form action = '' method = 'POST'>
        <input type='submit' name = 'bookmark' value = 'Bookmark'/>
        </form>

<?php if(isset($_POST['bookmark'])){
     mysqli_query($db,"INSERT INTO `BOOKMARK` (`buid`, `bpid`) ( VALUES ('".$login_uid."', '" .$row['pid']."',)");
 
}

        echo "Caption:  ". $row["caption"] . "<br>";
        if($row["plong"] != NULL && $row["plat"] != NULL){
            echo 'Location: ' . $row["plong"] . ', ' . $row["plat"] . '<br>';
        }
        echo "<br>";
    }
}
else {
   echo "Nothing has been posted yet :( <br>";}

?>

<p></p>
<div> <a href = "photopost.php"><font size="3">See your pictures</font></a>

<?php

//----------------------------------------------------------------------------------------------
//------------------------------------LOCATION POSTS--------------------------------------------
//---------------------------------------------------------------------------------------------- 
 
echo "<h3>Where some friends have been:<br></h3>";

$result_location = $db->query("SELECT *
FROM `ULOCATION`
JOIN FRIENDS ON uid1=luid
JOIN USER ON uid=luid
WHERE uid2=2
LIMIT 0,15");


if ($result_location->num_rows > 0) {
    // output data of each row

    while($row = $result_location->fetch_assoc()) {
        echo $row["name"] . " has been to " . $row["ulong"] .", " . $row["ulat"] ." at ". $row["ltimestamp"] . "<br>";
    }
} else {
    echo "No Friends Have Gone Anywhere Interesting <br>";
}
?>

<p></p>
<div> <a href = "locationpost.php"><font size="3">Places You Have Been</font></a>


      <h2>
      <div> <a href = "friends.php"><font size="4">See your friends</font></a> </div>
      <div> <a href = "submitfriendrequest.php"> <font size="4">Submit a friend request</font></a> </div>
      <a href = "logout.php"><font size="4">Sign Out</font></a>
      </h2>
  
   </body>
   
</html>