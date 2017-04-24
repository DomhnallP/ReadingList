<!DOCTYPE html>
<html>
    <head>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
            }

            table, td, th {
                border: 1px solid black;
                padding: 5px;
            }

            th {text-align: left;}
        </style>
    </head>
    <body>

        <?php
        $q = $_GET['q'];

        $con = mysqli_connect('localhost','root','','ReadingList');
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }

        mysqli_select_db($con,"ajax_demo");
        $sql="SELECT * FROM ReadingList WHERE name = '".$q."'";
        $result = mysqli_query($con,$sql);

        echo "<table>
<tr>
<th>Name</th>
<th>URL</th>
<th>Description</th>
</tr>";
        while($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['URL'] . "</td>";
            echo "<td>" . $row['theDesc'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        mysqli_close($con);
        ?>
    </body>
</html>