<?php
require_once "config.php";
include("session-checker.php");
if(isset($_POST['btnsubmit'])){
	$sql = "DELETE FROM tblequipment WHERE AssetNumber = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "s", trim($_POST['txtAssetNumber']));
		if(mysqli_stmt_execute($stmt)){
			$sql = "INSERT INTO tbldeletelogs (datelog, timelog, ID, performedBy, module) VALUES (?, ?, ?, ?, ?)";
			if($stmt = mysqli_prepare($link, $sql)){
				$module = "Equipments";
				mysqli_stmt_bind_param($stmt, "sssss", date("m/d/Y"), date("h:i:sa"), $_POST['txtAssetNumber'], $_SESSION['username'], $module);
				if(mysqli_stmt_execute($stmt)){
					echo "Equipment deleted!";
					header("location:AssetManagement.php");
					exit();
				}
				else{
					echo "Error on insert logs";
				}
			}
		}
		else{
			echo "Error on delete statement";
		}
	}
}
?>
<!DOCTYPE.HTML>
<html>
<title>Delete Asset-AU IT Ticket Management System</title>
	<style type = "text/css">
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
			}
		</style>

<body>
	<div class = "content">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<input type = "hidden" name = "txtAssetNumber" value ="<?php echo trim($_GET["AssetNumber"]); ?>" />
		<p>Are you sure you want to delete this Equipment? </p><br>
		<center><input type = "submit" name = "btnsubmit" value = "Yes">
		<a href = "AssetManagement.php">No</a></center>
	</div></form>
</body>
</html>
