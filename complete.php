<?php
require_once "config.php";
include("session-checker.php");
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'itc127b');

    if(isset($_POST['completedata']))
    {   
        $id = $_POST['complete_id'];
        $status = "FOR APPROVAL"; 
        $date = date("m/d/Y");


        $query = "UPDATE tbltickets SET  status = '$status', dateCompleted = '$date' WHERE ticketnumber='$id'";
        $query_run = mysqli_query($connection, $query);
        if($query_run)
        {
            echo '<script> alert("Ticket Completed"); </script>';
            header("Location:TechTickets.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>