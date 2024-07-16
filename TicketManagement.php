<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Ticket Management AUIT</title>
</head>
<style>
	body{
				background-image: url(JSC.jpg);
				background-size: cover;1
				background-attachment: fixed;
			}
</style>
<body>
    <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Student Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="delete_id" id="delete_id">

                        <h4> Do you want to Delete this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="deletedata" class="btn btn-primary"> YES </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="jumbotron">

            <div class="row">
                <div class="col-md-6">
                    <h2>Ticket Management</h2>
                        <br> Search: <input type = "text" name = "txtsearch">
                        <input type = "submit" name = "btnsearch" value = "Search"><br>
                </div>
                <div class="col-md-6">
                    <a href="add-ticket.php" class="btn btn-success" style="margin-left: 80%;"> ADD TICKET </a>    
                </div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>

            <?php
                $connection = mysqli_connect("localhost","root","");
                $db = mysqli_select_db($connection, 'itc127b');

                $query = "SELECT * FROM tbltickets";
                $query_run = mysqli_query($connection, $query);
            ?>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered" style="background-color: white;">
                        <thead class="table-dark">
                            <tr>
                                <th> Ticket Number </th>
                                <th> Problem </th>
                                <th> Date </th>
                                <th> Time </th>
                                <th> Status </th>
                                <th> Details </th>
                                <th> Edit</th>
                                <th> Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                                        
                        <?php
                        if($query_run)
                        {
                            while($row = mysqli_fetch_array($query_run))
                            {
                                ?>
                                    <tr>
                                        <th> <?php echo $row['ticketnumber']; ?> </th>
                                        <th> <?php echo $row['problem']; ?> </th>
                                        <th> <?php echo $row['datelog']; ?> </th>
                                        <th> <?php echo $row['timelog']; ?> </th>
                                        <th> <?php echo $row['status']; ?> </th>
                                        <th> 
                                            <form action="details.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['ticketnumber'] ?>">
                                                <input type="submit" name="details" class="btn btn-info" value="DETAILS">
                                            </form>
                                        </th>
                                        <th> 
                                            <form action="updatedata.php" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['ticketnumber'] ?>">
                                                <input type="submit" name="edit" class="btn btn-success" value="EDIT">
                                            </form>
                                        </th>                                        
                                        <th> 
                                            <form action="deletemodal" method="post">
                                                <input type="hidden" name="id" value="<?php echo $row['ticketnumber'] ?>">
                                                <input type="submit" class="btn btn-danger deletebtn" value="DELETE"> 
                                            </form>
                                        </th>
                                    </tr>
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                    <tr>    
                                        <th colspan="6"> No Record Found </th>
                                    </th>
                                <?php
                            }
                        ?>

                    </table>
                </div>
            </div>

        </div>
    </div>
</body>
</html>