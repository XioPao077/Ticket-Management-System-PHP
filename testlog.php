<?php
if(isset($_POST['btnlogin'])){
	require_once"Config.php";
	$sql = "SELECT * FROM tblaccounts WHERE username = ? AND password = ? AND status = 'ACTIVE'";
	
	if($stmt = mysqli_prepare($link,$sql)){
		mysqli_stmt_bind_param($stmt,"ss",$_POST['txtusername'],$_POST['txtpassword']);
		if(mysqli_stmt_execute($stmt)){
			$result = mysqli_stmt_get_result($stmt); 
			if(mysqli_num_rows($result) > 0){
				echo"Log in SUCCESSFUL";
			}
			else{
				echo"INCORRECT LOGIN CREDENTIALS or account is INACTIVE";
				}
			}
		}
	else{
		echo"Error on select Statement";
	}
}
?>