 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ReadingList";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, name, URL, theDesc FROM ReadingList";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    
    echo "<table>";
    echo "<tr><td>" . "ID" . "</td><td>" . "Name". "</td><td>" . "URL". "</td><td>" . "Description"."</td></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["URL"]. "</td><td>" . $row["theDesc"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?> 
<style>
table, th, td {
   border: 1px solid black;
}
</style>