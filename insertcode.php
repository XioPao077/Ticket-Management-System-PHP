<?php
require_once "config.php";
include("session-checker.php");
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'itc127b');
$inq= "SELECT ticketnumber from tbltickets order by ticketnumber desc";
$result = mysqli_query($connection,$inq);
$row = mysqli_fetch_array($result);
$lastid = $row['ticketnumber'];

if(empty($lastid)){
    $number = $row['ticketnumber'] + 1;
}
else{
    $number = $lastid + 1;
}
if(isset($_POST['insertdata']))
{
    $problem = $_POST['prob'];
    $description = $_POST['txtdescription'];
    $status = "PENDING";
    $date = date("m/d/Y");
    $time = date("h:i:sa");
    $cb = $_SESSION['username'];

try{
 $query = "INSERT INTO tbltickets(ticketnumber,problem,details,status,datelog,timelog,createdby) VALUES ('$number','$problem','$description','$status','$date','$time','$cb')";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header("location: TicketModal.php");
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}catch (mysqli_sql_exception $e) { 
      var_dump($e);
      exit; 
   } 
   
}
?>