<html>
   <head> 
      <font size="6">Your account has been created! </font>
   </head>
   <p></p>
   <img src="http://www.clker.com/cliparts/2/k/n/l/C/Q/transparent-green-checkmark-md.png" alt="some_text">
   <p></p>


<?php

//Displaying information
echo 'Username: ', $_POST["username"]."<br>";
echo 'Password: Omitted for privacy' ."<br>";
echo 'First and Last Name: ', $_POST["name"]."<br>";
echo 'Short Bio: ', $_POST["description"]. "<br>";
?>


<a href="http://noot.esy.es/Project%20Part%202/login.php">Log in now!</a>
<?php>
// Create connection with DB

$conn = new mysqli("mysql.hostinger.ph", "u987611180_12345", "password", "u987611180_prjct");
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$uname = $_POST['username'];
$pw = $_POST['password'];
$name = $_POST['name'];
$description = $_POST['description'];

//get new user id

$result = $conn->query("SELECT MAX(`uid`) AS max_uid FROM `USER`");
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $id_num = $row["max_uid"]+1;
    }

}
$fetch_circleID= $conn->query("SELECT MAX(`cid`) AS max_cid FROM `CIRCLE`");
if ($fetch_circleID->num_rows > 0) {
    // output data of each row
    while($row = $fetch_circleID->fetch_assoc()) {
        $cid_num = $row["max_cid"]+1;
    }

}


//insert into the database
// uid, user_name, password, name, profile
$sql_new_user = sprintf(" INSERT INTO `USER` (uid, user_name, password, name, profile) VALUES(%s, '%s', '%s', '%s', '%s')", $id_num, $uname, $pw, $name, $description);
if ($conn->query($sql_new_user) === TRUE) {
    echo "New record created successfully <br>";
} else {
    echo "Error: " . $sql_new_user . "<br>" . $conn->error. "<br>";
}

$sql_default_circle0 = sprintf("INSERT INTO `CIRCLE` (cid, uid, cname, `call`, cfriend) VALUES(%s, %s, 'Public', 1 , 0)", $cid_num, $id_num);
if ($conn->query($sql_default_circle0) === TRUE) {
    echo "Public circle has been generated";
} else {
    echo "Error: " . $sql_default_circle0 . "<br>" . $conn->error. "<br>";
}

$sql_default_circle1 = sprintf("INSERT INTO `CIRCLE` (cid, uid, cname, `call`, cfriend) VALUES( %s, %s, 'Friends', 0 , 1)", $cid_num+1, $id_num);
if ($conn->query($sql_default_circle1) === TRUE) {
    echo "Friend circle has been generated";
} else {
    echo "Error: " . $sql_default_circle1 . "<br>" . $conn->error. "<br>";
}


$conn->close();
?>

</html>