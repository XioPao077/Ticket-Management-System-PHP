<!DOCTYPE.HTML>
<html>
<head>
	<title>Account Management Form - AUIT Management System</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
</head>
<style>
	body{
				background-image: url(JSC.jpg);
				background-size: cover;1
				background-attachment: fixed;
			}

</style>
<body>
		<?php
		session_start();
		//check if there is a session created using the login form
		if(isset($_SESSION['username'])){
		}
		else{
			//redirect the user to the login for,
			header("location: login.php");

		}
	?>
	<div class="container">
      <div class="jumbotron bg-dark">
            <div class="card">
               <center><h2> AUIT Ticket Management System</h2></center>
            </div>

	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
		<br>		
		<a class ="btn btn-success" href = "Create-account.php"> Add new User</a><br>
		<br><font color="white"> Search: </font><input type = "text" name = "txtsearch">
		<input type = "submit" name = "btnsearch" value = "Search"><br>
	</form>
	<div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>		
<?php 
	function build_table($result){
		if(mysqli_num_rows($result) > 0){
			//create the table
			echo "<table id='datatableid' class='table table-bordered table-primary table-striped'>";
			//table header
			echo "<tr>";
			echo "<th>username</th><th>usertype</th><th>Status</th><th> Created by</th><th>Last updated by</th><th>Action</th>";
			echo "</tr";
			echo "<br>";
			//table data (looping each of the data on the result)
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" . $row['username'] . "</td>";
				echo "<td>" . $row['usertype'] . "</td>";
				echo "<td>" . $row['status'] . "</td>";
				echo "<td>" . $row['createdby'] . "</td>";
				echo "<td>" . $row['lastUpdatedBy'] . "</td>";
				echo "<td>" ;
				echo "<a class = 'btn btn-info' href = 'update-account.php?username=" . $row['username'] . "'>Update </a>";
				echo "<a class = 'btn btn-primary' href = 'activate-account.php?username=" . $row['username'] . "'>Activate</a>";
				echo "<a class = 'btn btn-secondary' href = 'deactivate-account.php?username=" . $row['username'] . "'>Deactivate</a>";
				echo "<a class = 'btn btn-danger' href = 'delete-account.php?username=" . $row['username'] . "'>Delete </a>";
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
		//search
		if(isset($_POST['btnsearch'])){
			$sql = "SELECT * FROM tblaccounts WHERE username <> ? AND (username LIKE ? OR usertype LIKE ?) ORDER BY username";
			if ($stmt = mysqli_prepare($link,$sql)){
				$searchValue = '%' . $_POST['txtsearch'] . '%';
				mysqli_stmt_bind_param($stmt, "sss",$_SESSION['username'], $searchValue, $searchValue);
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
			$sql = "SELECT * FROM tblaccounts WHERE username <> ? ORDER BY username";
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
		     <a class="btn btn-secondary" href="AdminTickets.php"> Tickets</a>
		    </div>
		    <div class="col col-md-auto">
		     <a class="btn btn-danger" href = "logout.php"> Logout </a>
		    </div>
		  </div>
	</div>
</div>
</div>
<footer class="page-footer font-small blue">
  <!-- Copyright -->
  <div class="footer-copyright text-center py-3">© 2022 Copyright:
    <a href="johnpaolo.tampos@arellano.edu.ph"> johnpaolo.tampos@arellano.edu.ph</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->	
</body>
</html>