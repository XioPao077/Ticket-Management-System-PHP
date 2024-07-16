<?php
require_once "config.php";
include("session-checker.php");
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'itc127b');

    if(isset($_POST['updatedata']))
    {   
        $id = $_POST['update_id'];
        
        $problem = $_POST['updtprob'];
        $details = $_POST['updtdescription'];
        $status = "PENDING";
        $date = date("m/d/Y");
        $time = date("h:i:sa");
        $lastupdate = $_SESSION['username'];

        $query = "UPDATE tbltickets SET problem='$problem', details='$details',status ='$status', datelog='$date', timelog=' $time', lastUpdatedBy='$lastupdate'WHERE ticketnumber='$id'";
        $query_run = mysqli_query($connection, $query);
        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
            header("Location:TicketModal.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    }
?>