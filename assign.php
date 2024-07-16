<?php
require_once "config.php";
include("session-checker.php");
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'itc127b');

    if(isset($_POST['assigndata']))
    {   
        $id = $_POST['assign_id'];
        $date = date("m/d/Y");
        $assign = $_POST['assign'];
        $status = "ON-GOING";

        $query = "UPDATE tbltickets SET assignedto='$assign',dateAssigned = '$date', status = '$status' WHERE ticketnumber='$id'";
        $query_run = mysqli_query($connection, $query);
        if($query_run)
        {
            echo '<script> alert("Ticket approved"); </script>';
            header("Location:AdminTickets.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>