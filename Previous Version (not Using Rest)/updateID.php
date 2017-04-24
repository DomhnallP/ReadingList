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
        $id = $_GET['values'];
        $myArray = explode(',',$id);
        $con = mysqli_connect('localhost','root','','ReadingList');
        if (!$con) {
            die('Could not connect: ' . mysqli_error($con));
        }
        //echo $myArray[0];
        //echo $myArray[1];
        //echo $myArray[2];
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
            mysqli_close($con);
        }
        else{
            echo 'Please enter some values';
        }
        ?>
    </body>
</html>