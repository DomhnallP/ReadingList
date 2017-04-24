<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "ReadingList");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 $name = $_POST['NAME'];
$url = $_POST['URL'];
$thedesc = $_POST['THEDESC'];
// Attempt insert query execution
$sql = "INSERT INTO ReadingList (theDate, Name, URL, theDesc) VALUES (CURDATE(), '$name', '$url', '$thedesc')";
if(mysqli_query($link, $sql)){
    echo "Records inserted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>