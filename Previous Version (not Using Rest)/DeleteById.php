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
        mysqli_close($con);
        ?>
    </body>
</html>