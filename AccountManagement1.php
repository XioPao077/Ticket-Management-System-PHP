<!DOCTYPE.HTML>
<html>
<head><title>Account Management Form - AUIT Management System</title></head>
<style>
	body{
				background-image: url(JSC.jpg);
				background-size: cover;1
				background-attachment: fixed;
			}
			.content{
				background: floralwhite;
				width: 30%;
				padding: 40px;
				margin:  100px auto;
				font-family: calibri;
				border-radius: 10px;
			}

			table, th, td {
 			 border: 1px solid black;
 			 border-collapse: collapse;
 			 width: relative;
			}

</style>
<body>
	<div class="content">
	<?php
		session_start();
		//check if there is a session created using the login form
		if(isset($_SESSION['username'])){
			echo "<h1>Welcome, ".$_SESSION['username']."</h1>";
			echo "<h4>UserType:".$_SESSION['usertype']."</h4>";
		}
		else{
			//redirect the user to the login for,
			header("location: login.php");

		}
	?>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
		<a href = "logout.php"> Log out </a>
		<a href = "Create-account.php"> Add new User</a>
		<a href = "AssetManagement.php"> Assets</a>
		<a href = "AdminTickets.php"> Tickets</a>
		<br> Search: <input type = "text" name = "txtsearch">
		<input type = "submit" name = "btnsearch" value = "Search"><br>
	</form>
	<div>
</body>
</html>
<?php 
	function build_table($result){
		if(mysqli_num_rows($result) > 0){
			//create the table
			echo "<table>";
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
				echo "<a href = 'update-account.php?username=" . $row['username'] . "'>Update </a>";
				echo "<a href = 'activate-account.php?username=" . $row['username'] . "'>Activate</a>";
				echo "<a href = 'deactivate-account.php?username=" . $row['username'] . "'>Deactivate</a>";
				echo "<a href = 'delete-account.php?username=" . $row['username'] . "'>Delete </a>";
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