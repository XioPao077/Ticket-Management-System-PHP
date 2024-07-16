<?php
	require_once "config.php";
	include("session-checker.php");
	if(isset($_POST['btnsubmit'])){
		$sql = "UPDATE tblaccounts SET status = 'ACTIVE', lastUpdatedBy = ? WHERE username = ?";
		if($stmt = mysqli_prepare($link,$sql)){
			mysqli_stmt_bind_param($stmt, "ss", $_SESSION['username'],trim($_POST['username']));
			if(mysqli_stmt_execute($stmt)){
				header("location: AccountManagement.php");
				echo "User Account UPDATED!";
				exit();
		}
		else{
			echo "Error on update statement";
		}
	}
}
?>
<!DOCTYPE.HTML>
<html>
<title>Activate Account</title>
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
	<div class ="content">
	<form action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<input type = "hidden" name = "username" value ="<?php echo trim($_GET['username']); ?>"/>
		<p> Are you sure you want to activate this account?</p><br>
		<input type = "submit" name = "btnsubmit" value = "yes">
		<a href = "AccountManagement.php">No</a>
	</form>
	</div>
</body>
</html>