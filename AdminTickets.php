<! DOCTYPE.html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>
		Account Management Form - AUIT Management System
	</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<style>
	body{
				background-image: url(JSC.jpg);
				background-size: cover;
				background-attachment: fixed;
			}

</style>
<body>
	<!-- Details Modal -->
	    <div class="modal fade" id="viewmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ticket Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="deletecode.php" method="POST">

                    <div class="modal-body">
                        Problem:
                        <input type="text" name="view_id" id="view_id"><br>
                        description:
                        <!-- <p id="fname"> </p> -->
                         <textarea class ="form-control" name="description" id="description" rows="6" cols="50"><?php echo $row['details']; ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> CLOSE </button>
                        <!-- <button type="submit" name="deletedata" class="btn btn-primary"> Yes !! Delete it. </button> -->
                    </div>
                </form>

            </div>
        </div>
    </div>
     <!-- DELETE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Ticket </h5>
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
                        <button type="submit" name="deletedata" class="btn btn-primary"> Yes </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
	<div class="container-fluid">
     <div class="jumbotron bg-dark">
            <div class="card">
                <h2> AUIT Ticket Management System</h2>
            </div>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
		<br><font style="color:white;"> Search:</font><input type = "text" name = "txtsearch">
		<input type = "submit" name = "btnsearch" value = "Search"><br>
	</form>
			<?php 
			function build_table($result){
				if(mysqli_num_rows($result) > 0){
					//create the table
					echo "<table id='datatableid' class='table table-sm table-bordered table-primary table-striped'>";
					//table header
					echo "<tr>";
					echo "<th>TicketNumber</th><th>Problem</th><th>Status</th><th>assigned to</th><th>Date Assigned</th><th>Date Completed</th><th>Date Closed</th><th>Details</th><th>Approve</th><th>Assign</th><th>Delete</th>";
					echo "</tr";
					echo "<br>";

					//table data (looping each of the data on the result)
					while($row = mysqli_fetch_array($result)){
						echo "<tr>";
						echo "<td>" . $row['ticketnumber'] . "</td>";
						echo "<td>" . $row['problem'] . "</td>";
						echo "<td>" . $row['status'] . "</td>";
						echo "<td>" . $row['assignedto'] . "</td>";
						echo "<td style='display:none';>".$row['details']. "</td>";
						echo "<td>" . $row['dateAssigned'] . "</td>";
						echo "<td>" . $row['dateCompleted'] . "</td>";
						echo "<td>" . $row['dateClosed'] . "</td>";
						echo "<td>" ;
						echo "<button type='button' class='btn btn-info viewbtn' > Details </button>";
						echo"</td>";
						echo "<td>";
						echo "<button type='button' class='btn btn-success apprvnbtn' > APPROVE </button>";
						echo"</td>";
						echo "<td>";
						echo "<button type='button' class='btn btn-warning assignbtn' > ASSIGN </button>";
						echo"</td>";
						echo "<td>";
						echo "<button type='button' class='btn btn-danger deletebtn' > DELETE </button>";	
						echo"</td>";
						echo "</tr>";
					}
					echo "</table>";
				}
				else{
					echo "No Data Found";
				}
			}
				//display the table
				require_once "config.php";
				include("session-checker.php");
				//search
				if(isset($_POST['btnsearch'])){
					$sql = "SELECT * FROM tbltickets WHERE ticketnumber <> ? AND (assignedto LIKE ? OR problem LIKE ? OR status LIKE ?) ORDER BY ticketnumber";
					if ($stmt = mysqli_prepare($link,$sql)){
						$searchValue = '%' . $_POST['txtsearch'] . '%';
						mysqli_stmt_bind_param($stmt, "ssss",$_SESSION['username'], $searchValue, $searchValue, $searchValue);
						if(mysqli_stmt_execute($stmt)){
							$result = mysqli_stmt_get_result($stmt);
							build_table($result);
						}
					}
					else{
						echo "Error on Search";
					}
				}
				//load the data
				else{
					$sql = "SELECT * FROM tbltickets WHERE ticketnumber <> ? ORDER BY ticketnumber";
					if($stmt = mysqli_prepare($link, $sql)){
						mysqli_stmt_bind_param($stmt,"s",$_SESSION['username']);
						if(mysqli_stmt_execute($stmt)){
							$result = mysqli_stmt_get_result($stmt);
							build_table($result);
							}
						}
					else{
						echo"Error on accounts load";
					}
				}
		?>
	<div class="container-1" align="left">
		  <div class="row justify-content-md-auto">
		    <div class="col col-md-auto">
		      <a class="btn btn-secondary" href = "AssetManagement.php"> Assets</a>
		    </div>
		    <div class="col col-md-auto">
		     <a class="btn btn-secondary" href="AccountManagement.php"> Accounts </a>
		    </div>
		    <div class="col col-md-auto">
		     <a class="btn btn-danger" href = "logout.php"> Logout </a>
		    </div>
		  </div>
	</div>
</div>
</div>
    <!-- APPROVE POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="approvemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Ticket </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="approve.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="approve_id" id="approve_id">

                        <h4> Do you want to Approve this Data ??</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> NO </button>
                        <button type="submit" name="approvedata" class="btn btn-primary"> Yes </button>
                    </div>
                </form>

            </div>
        </div>
    </div>	
     <!-- ASSIGN POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="assignmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete Ticket </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="assign.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="assign_id" id="assign_id">
                        Ticket Number: 
                        <input type="text" name="ticketnum" id="ticketnum"><br>
                        Problem:
                        <input type="text" name="problem" id="problem"><br>
                        description:
                        <!-- <p id="fname"> </p> -->
                         <textarea class ="form-control" name="desc" id="desc" rows="6" cols="50"></textarea>
                         	<h4> Assign Ticket To:</h4>
		                    <select class="form-control" name = "assign" required>
								<option value = "">--select Classification--</option>
								<option value = "DELACRUZ">Dela Cruz</option>
								<option value = "GARCIA">Garcia</option>
								<option value = "REYES">Reyes</option>
								<option value = "SANTOS">Santos</option>
								<option value = "VASQUEZ">Vasquez</option>
							</select>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> CANCEL </button>
                        <button type="submit" name="assigndata" class="btn btn-primary"> Assign </button>
                    </div>
                </form>

            </div>
        </div>
    </div>	

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {

            $('.viewbtn').on('click', function () {
                $('#viewmodal').modal('show');
             $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#view_id').val(data[1]);
                $('#description').val(data[4]);
            });

        });
    </script>
    <script>
        $(document).ready(function () {

            $('.apprvnbtn').on('click', function () {

                $('#approvemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#approve_id').val(data[0]);

            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('.deletebtn').on('click', function () {

                $('#deletemodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#delete_id').val(data[0]);

            });
        });
    </script>
    <script>
        $(document).ready(function () {

            $('.assignbtn').on('click', function () {

                $('#assignmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#assign_id').val(data[0]);
                $('#ticketnum').val(data[1]);
                $('#problem').val(data[2]);
                $('#desc').val(data[4]);

            });
        });
    </script>
</body>
</html>