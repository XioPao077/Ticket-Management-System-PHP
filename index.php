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

     <div class="jumbotron bg-primary">
            <div class="card">
                <center><h2> AUIT Ticket Management System</h2></center>
            </div>
      </div>
<div class="container">
  <div class="row">
    <div class="col">
      <img src="aulogo.png" width="350" height="350">
    </div>
    <div class="col">
    <br>
      <div class="card bg-primary">
<?php
		session_start();
		//check if there is a session created using the login form
		if(isset($_SESSION['username'])){
			echo"<div class = 'card'>";
			echo "<h1>Welcome, ".$_SESSION['usertype']."</h1>";
			echo "<h4>Name:".$_SESSION['username']."</h4>";
			echo "</div>";
		}
		else{
			//redirect the user to the login for,
			header("location: login.php");

		}
	?>
	<div class ="card bg-primary">
		<?php 
			if($_SESSION['usertype'] == 'ADMINISTRATOR'){
					echo"<div class = 'card bg-primary'>";
					echo"<div class = 'card'>";
					echo"<a class='btn' href = 'AdminTickets.php'> Ticket Management</a>";
					echo"</div>";
					echo"<div class = 'card'>";
					echo"<a class='btn' href = 'AccountManagement.php'> Account Management</a>";
					echo"</div>";
					echo"<div class = 'card'>";
					echo"<a class='btn' href = 'AssetManagement.php'> Assett Management</a>";
					echo "</div>";
					echo"<div class = 'card'>";
					echo"<a class='btn btn-danger' href = 'logout.php'> Logout </a>";
					echo "</div>";
					}
				elseif($_SESSION['usertype'] == 'TECHNICAL'){
					echo"<div class = 'card bg-primary'>";
					echo"<div class = 'card'>";
					echo"<a class='btn form-control' href = 'AssetManagement.php'> Asset Management</a>";
					echo"</div>";
					echo"<div class = 'card'>";
					echo"<a class='btn' href = 'TechTickets.php'> Ticket Management</a>";
					echo "</div>";
					echo"<div class = 'card'>";
					echo"<a class='btn btn-danger' href = 'logout.php'> Logout </a>";
					echo "</div>";
				}
				else{
					echo"<div class = 'card bg-primary'>";
					echo"<div class = 'card'>";
					echo"<a class='btn' href = 'AssetManagement.php'> View Assets </a>";
					echo"</div>";
					echo"<div class = 'card'>";
					echo"<a class='btn' href = 'TicketModal.php'> Ticket Management System</a>";
					echo "</div>";
					echo"<div class = 'card'>";
					echo"<a class='btn btn-danger' href = 'logout.php'> Logout </a>";
					echo "</div>";
				}	
		?>
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
