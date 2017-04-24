<?php
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'),true);
$link = mysqli_connect('localhost','root','','ReadingList');
mysqli_set_charset($link,'utf8');


if($method=='POST'){
	$name = $_POST['NAME'];
	$url = $_POST['URL'];
	$thedesc = $_POST['THEDESC'];
	$sql = "INSERT INTO ReadingList (theDate, Name, URL, theDesc) VALUES (CURDATE(), '$name', '$url', '$thedesc')";
}
else if($method=='GET'){
	if(isset($_GET['qName'])) {
		$q = $_GET['qName'];
		$con = mysqli_connect('localhost','root','','ReadingList');
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		mysqli_select_db($con,"ajax_demo");
		$sql="SELECT * FROM ReadingList WHERE name = '".$q."'";
		$result = mysqli_query($con,$sql);
		echo "<table>
<tr>
<th>Date</th>
<th>Name</th>
<th>URL</th>
<th>Description</th>
</tr>";
		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['theDate'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['URL'] . "</td>";
			echo "<td>" . $row['theDesc'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else if(isset($_GET['qId'])) {
		$q = $_GET['qId'];
		$con = mysqli_connect('localhost','root','','ReadingList');
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		mysqli_select_db($con,"ajax_demo");
		$sql="SELECT * FROM ReadingList WHERE ID = '".$q."'";
		$result = mysqli_query($con,$sql);
		echo "<table>
<tr>
<th>Date</th>
<th>Name</th>
<th>URL</th>
<th>Description</th>
</tr>";
		while($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['theDate'] . "</td>";
			echo "<td>" . $row['name'] . "</td>";
			echo "<td>" . $row['URL'] . "</td>";
			echo "<td>" . $row['theDesc'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	else if(isset($_GET['values'])){
		$id = $_GET['values'];
		$myArray = explode(',',$id);
		$con = mysqli_connect('localhost','root','','ReadingList');
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		if($myArray[1]!='' ||$myArray[2]!='' || $myArray[3]!=''){
			mysqli_select_db($con,"ajax_demo");
			if($myArray[1]!='' && $myArray[2]!='' && $myArray[3]!=''){
				$sql="UPDATE ReadingList SET name='".$myArray[1]."', URL='".$myArray[2]."', theDesc='".$myArray[3]."' WHERE id=".intval($myArray[0]);
			}
			else if($myArray[1]!='' && $myArray[2]!='' && $myArray[3]==''){
				$sql="UPDATE ReadingList SET URL='".$myArray[2]."', name='".$myArray[1]."' WHERE id=".intval($myArray[0]);
			}
			else if($myArray[2]=='' && $myArray[1]!='' && $myArray[3]!=''){
				$sql="UPDATE ReadingList SET name='".$myArray[1]."', theDesc='".$myArray[3]."' WHERE id=".intval($myArray[0]);
			}
			else if($myArray[3]!='' && $myArray[2]!='' &&$myArray[1]==''){
				$sql="UPDATE ReadingList SET theDesc='".$myArray[3]."', URL='".$myArray[2]."' WHERE id=".intval($myArray[0]);
			}
			else if($myArray[3]=='' && $myArray[2]=='' &&$myArray[1]!=''){
				$sql="UPDATE ReadingList SET name='".$myArray[1]."' WHERE id=".intval($myArray[0]);
			}
			else if($myArray[3]=='' && $myArray[2]!='' &&$myArray[1]==''){
				$sql="UPDATE ReadingList SET URL='".$myArray[2]."' WHERE id=".intval($myArray[0]);
			}
			else if($myArray[3]!='' && $myArray[2]=='' &&$myArray[1]!=''){
				$sql="UPDATE ReadingList SET theDesc='".$myArray[3]."' WHERE id=".intval($myArray[0]);
			}
			$result = mysqli_multi_query($con,$sql);
			if(!mysqli_query($con,$sql)) 
			{
				die('Error: ' . mysqli_error($con));
			}
			else
			{
				echo 'Success! ';
			}   
		}
		else{
			echo 'Please enter some values';
		}
	}
	else if(isset($_GET['id'])){
		$id = $_GET['id'];
		$con = mysqli_connect('localhost','root','','ReadingList');
		if (!$con) {
			die('Could not connect: ' . mysqli_error($con));
		}
		mysqli_select_db($con,"ajax_demo");
		$sql="DELETE FROM ReadingList WHERE id=".intval($id);
		$result = mysqli_query($con,$sql);
		if(!mysqli_query($con,$sql)) 
		{
			die('Error: ' . mysqli_error($con));
		}
		else
		{
			echo 'Success! ';
		}   
	}
}
$result = mysqli_query($link,$sql);
if (!$result) {
	http_response_code(404);
	die(mysqli_error());
}
else if(isset($_GET['qId']) || isset($_GET['qName'])) {
	echo 'Number of returned Results: ', mysqli_affected_rows($link);
}
mysqli_close($link);
?>
<html>
	<head>
		<style>
			table {
				width: 100%;
				border-collapse: collapse;
			}

			table, td, th {
				border: 1px solid white;
				padding: 5px;
			}

			th {text-align: left;}
		</style>
	</head>
</html>