<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Create Ticket</title>
</head>
<style>
    body{
                background-image: url(JSC.jpg);
                background-size: cover;1
                background-attachment: fixed;
            }
</style>
<body>
    <div class="container">
        <div class="jumbotron">
            <div class="row">
                <div class="col-md-12">
                  
                    <h2> Add Ticket</h2>
                    <hr>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for=""> Problem:</label>
                            <input type="text" name="problem" class="form-control" placeholder="What seems to be the problem?" required>
                        </div>
                        <div class = "form-group">
                            <label for=""> Description:</label>
                            <textarea id="description" class ="form-control" name="txtdescription" rows="6" cols="50"></textarea>
                        </div>
                        <button type="submit" name="insert" class="btn btn-primary"> Save Data </button>

                        <a href="TicketManagement.php" class="btn btn-danger"> BACK </a>
                    </form>
                      
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
require_once "config.php";
include("session-checker.php");
$connection = mysqli_connect("localhost","root","");
$db = mysqli_select_db($connection, 'itc127b');
$qry= "SELECT ticketnumber from tbltickets order by ticketnumber desc";
$result = mysqli_query($connection,$qry);
$row = mysqli_fetch_array($result);
$lastid = $row['ticketnumber'];

if(empty($lastid)){
    $number = 1;
}
else{
    $number = $lastid + 1;
}
if(isset($_POST['insert']))
{
    $problem = $_POST['problem'];
    $description = $_POST['txtdescription'];
    $status = "PENDING";
    $date = date("m/d/Y");
    $time = date("h:i:sa");
    $cb = $_SESSION['username'];


    $query = "INSERT INTO tbltickets(ticketnumber,problem,details,status,datelog,timelog,createdby) VALUES ('$number','$problem','$description','$status','$date','$time','$cb')";
    $query_run = mysqli_query($connection,$query);

    if($query_run)
    {
        echo '<script> alert("Data Saved"); </script>';
        header("location: TicketManagement.php");
    }
    else
    {
        echo '<script> alert("Data Not Saved"); </script>';
    }
}
?>