<?php 
	include("session-checker.php");
	require_once "config.php";
	if(isset($_POST['btnsubmit'])){
		//check if username exists
		$sql="SELECT * FROM tblaccounts WHERE username = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt,"s", $_POST['txtusername']);
			if(mysqli_execute($stmt)){
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result) !=1){
					$sql = "INSERT INTO tblaccounts (username, password, usertype,status,createdby) VALUES
					(?,?,?,?,?)";
					if($stmt = mysqli_prepare($link,$sql)){
						$status = "ACTIVE";
						mysqli_stmt_bind_param($stmt, "sssss", $_POST['txtusername'], $_POST['txtpassword'], $_POST['cmbusertype'],
							$status, $_SESSION['username']);
						if(mysqli_stmt_execute($stmt)){
							header("location: AccountManagement.php");
							echo "User Account Added!";
							exit();
						}else{
							echo "Error on insert statement";
						}
					}
				}else{
					echo "User Account already exists.";
				}
			}else{
				echo "Error on select Statement";
			}
		}
	}
?>
<!DOCTYPE.HTML>
<html>
<head>
		<title> Add new account </title>
</head>
		<style type = "text/css">
			body{
				background-image: url(LoginBG.jpg);
				background-size: cover;
				background-attachment: fixed;
			}
			.content{
				justify-content: space-around;
				justify-items: space-around;
				background: floralwhite;;
				width: 25%;
				padding: 40px;
				margin:  350px;
				float: right;
				font-family: calibri;
				border-radius: 10px;
			}
		</style>
<body><div class = "content"><p>Fill up form and submit to add new user</p>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		Username: <input type = "text" name = "txtusername" required><br>
		Password: <input type = "text" name = "txtpassword" required><br>
		User type:<select name = "cmbusertype" id = "cmbusertype" required>
			<option value = "">--Select User Type--</option>
			<option value = "ADMINISTRATOR">Administrator</option>
			<option value = "TECHNICAL">Technical</option>
			<option value = "USER">User</option></select>
			<br><input type = "submit" name ="btnsubmit" value = "Submit">
		<a href = "AccountManagement.php"> Cancel </a></div></body>
</form>
</html>

