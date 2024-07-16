<?php
include ("session-checker.php");
require_once "config.php";
if(isset($_POST['btnsubmit'])){ //update
	$sql = "UPDATE tblaccounts SET password = ?, usertype = ?, lastUpdatedBy = ? WHERE username = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "ssss", $_POST['txtpassword'], $_POST['cmbusertype'], $_SESSION['username'], 
			$_GET['username']);
		if(mysqli_stmt_execute($stmt)){
			echo "User account updated!";
			header("location:AccountManagement.php");
			exit();
		}
		else{
			echo "Error on update statement";
		}
	}
}
else{ //loading current value of account
	if(isset($_GET['username']) && !empty(trim($_GET['username']))){
		$sql = "SELECT * FROM tblaccounts WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $_GET['username']);
			if(mysqli_stmt_execute($stmt)){
				$result = mysqli_stmt_get_result($stmt);
				$account = mysqli_fetch_array($result, MYSQLI_ASSOC);
			}
			else{
				echo "Error on select statement";
			}
		}
	}
}
?>
<!DOCTYPE.HTML>
<html>
<title>Update Account Form - AU IT Ticket Management System</title>
<style type = "text/css">
			body{
				background-image: url(JSC.jpg);
				background-size: cover;1
				background-attachment: fixed;
			}
			.content{
				align: center;
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
	<p>Change the value on the form and submit to update the account</p>
	<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
		Username: <?php echo $account['username']; ?> <br>
		Password: <input type = "text" name = "txtpassword" value = "<?php echo $account['password']; ?>" required> <br>
		Current Usertype: <?php echo $account['usertype']; ?> <br>
		Change to: <select name = "cmbusertype" id = "cmbusertype" required>
			<option value = "">--Select User type--</option>
			<option value = "ADMINISTRATOR">Administrator</option>
			<option value = "TECHNICAL">Technical</option>
			<option value = "USER">User</option>
		</select><br>
		<input type = "submit" name = "btnsubmit" value = "Update">
		<a href = "AccountManagement.php">Cancel</a>
	</div></form>
</body>
</html>