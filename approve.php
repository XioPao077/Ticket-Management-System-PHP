<?php
require_once "config.php";
include("session-checker.php");
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'itc127b');

    if(isset($_POST['approvedata']))
    {   
        $id = $_POST['approve_id'];
        $status = "CLOSED"; 
        $date = date("m/d/Y");
        $approved = $_SESSION['username'];

        $query = "UPDATE tbltickets SET approvedby='$approved', status = '$status', dateClosed = '$date' WHERE ticketnumber='$id'";
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