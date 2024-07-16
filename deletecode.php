<?php
require_once "config.php";
include("session-checker.php");
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'itc127b');

if(isset($_POST['deletedata']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM tbltickets WHERE ticketnumber='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        echo '<script> alert("Data Deleted"); </script>';
        If($_SESSION['usertype'] = "ADMINISTRATOR"){
             header("Location:AdminTickets.php");
        }
        else{
            header("Location:TicketModal.php");
        }
    }
    else
    {
        echo '<script> alert("DELETION PROCESS FAILED"); </script>';
    }
}

?>