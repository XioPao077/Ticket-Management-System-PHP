<!DOCTYPE.HTML>
<html>
<head><title>Asset Management Form - AUIT Management System</title></head>
<style>
	body{
				background-image: url(JSC.jpg);
				background-size: cover;1
				background-attachment: fixed;
			}
			.content{
				background: floralwhite;
				width: 25%;
				padding: 40px;
				margin:  100px auto;
				font-family: calibri;
				border-radius: 10px;
				size: relative;
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
			//redirect the user to the login form
			header("location: login.php");

		}
	?>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method = "POST">
		<a href = "Add-Asset.php"> Add Asset</a>
		<?php 
		if($_SESSION['usertype']== "TECHNICAL"){
			echo"<a href = 'TechTickets.php  ?>'> Back</a>";
		}
		
		if($_SESSION['usertype'] == "ADMINISTRATOR"){
			echo "<a href = 'AccountManagement1.php  ?>'> Accounts</a>";
		}
		?>
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
			echo "<th>Asset Number</th><th>Serial Number</th><th>Type</th><th>Department</th><th>Status</th><th>Action</th>";
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
				echo "<td>" ;
				echo "<a href = 'update-asset.php?AssetNumber=" . $row['AssetNumber'] . "'>Update </a>";
				echo "<a href = 'delete-asset.php?AssetNumber=" . $row['AssetNumber'] . "'>Delete </a>";
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