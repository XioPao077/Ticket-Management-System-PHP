<!DOCTYPE.HTML>
<html>
<head>
	<title>Asset Management Form - AUIT Management System</title>
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
			//redirect the user to the login form
			header("location: login.php");

		}
	?>
	<div class="container">
      <div class="jumbotron bg-dark">
            <div class="card">
                <center><h2> AUIT Ticket Management System</h2></center>
            </div>
				<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
					<?php
					if($_SESSION['usertype'] == "TECHNICAL" || $_SESSION['usertype'] == "ADMINISTRATOR"){
						echo"<a class = 'btn btn-primary' href = 'Add-Asset.php'> Add Asset </a>";
					}
					if($_SESSION['usertype']== "USER"){
						echo"<br><a class = 'btn btn-secondary' href = 'index.php'> Back </a>";
					}
					if($_SESSION['usertype']== "TECHNICAL"){
						echo"<a class = 'btn btn-secondary' href = 'TechTickets.php'> Back </a>";
					}
					
					if($_SESSION['usertype'] == "ADMINISTRATOR"){
						echo "<a class = 'btn btn-info' href = 'AccountManagement.php'> Accounts </a>";
					}
					 ?>
					<br>
					<br><font color = "white"> Search:</font><input type = "text" name = "txtsearch">
					<input type = "submit" name = "btnsearch" value = "Search"><br>
				</form>
			<?php 
				function build_table($result){
					if(mysqli_num_rows($result) > 0){
						//create the table
						echo "<table id='datatableid' class='table table-bordered table-primary table-striped'>";
						//table header
						echo "<tr>";
						echo "<th>Asset Number</th><th>Serial Number</th><th>Type</th><th>Department</th><th>Status</th>";
						if($_SESSION['usertype'] == "TECHNICAL" || $_SESSION['usertype'] == "ADMINISTRATOR"){
						echo"<th>Action</th>";
						}
						echo "</tr";
						echo "<br>";
						//table data (looping each of the data on the result)
						while($row = mysqli_fetch_array($result)){
							echo "<tr>";
							echo "<td>" . $row['AssetNumber'] . "</td>";
							echo "<td>" . $row['SerialNumber'] . "</td>";
							echo "<td>" . $row['Type'] . "</td>";
							echo "<td>" . $row['Department'] . "</td>";
							echo "<td>" . $row['Status'] . "</td>";
							if($_SESSION['usertype'] == "TECHNICAL" || $_SESSION['usertype'] == "ADMINISTRATOR"){
							echo "<td>" ;
							echo "<a class = 'btn btn-warning' href = 'update-asset.php?AssetNumber=" . $row['AssetNumber'] . "'>Update </a>";
							echo "<a class = 'btn btn-danger' href = 'delete-asset.php?AssetNumber=" . $row['AssetNumber'] . "'>Delete </a>";
							echo"</td>";
							echo "</tr>";
						}

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
						$sql = "SELECT * FROM tblequipment WHERE AssetNumber <> ? AND (AssetNumber LIKE ? OR SerialNumber LIKE ? OR Type LIKE ? OR Department LIKE ?) ORDER BY AssetNumber";
						if ($stmt = mysqli_prepare($link,$sql)){
							$searchValue = '%' . $_POST['txtsearch'] . '%';
							mysqli_stmt_bind_param($stmt,"sssss",$_SESSION['username'], $searchValue, $searchValue, $searchValue,$searchValue);
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
						$sql = "SELECT * FROM tblequipment WHERE AssetNumber <> ? ORDER BY AssetNumber";
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>			
</body>
</html>