<?php
include ("session-checker.php");
require_once "config.php";
if(isset($_POST['btnsubmit'])){ //update
	$sql = "UPDATE tblequipment SET AssetNumber = ?, SerialNumber = ?, Type = ?, Manufacturer = ?, 
	YearModel = ?, Description = ?,Department = ?, Status = ?, LastUpdatedBy = ?	WHERE AssetNumber = ?";
	if($stmt = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt, "ssssssssss",$_POST['txtAssetNumber'], $_POST['txtSerialNumber'],$_POST['cmbtype'], $_POST['txtManufacturer'], 
			$_POST['txtYear'], $_POST['txtdescription'], $_POST['cmbdept'],$_POST['cmbstat'], $_SESSION['username'], $_GET['username']);
		if(mysqli_stmt_execute($stmt)){
			echo "Equipment updated!";
			header("location:AssetManagement.php");
			exit();
		}
		else{
			echo "Error on update statement";
		}
	}
}
else{ //loading current value of account
	if(isset($_GET['AssetNumber']) && !empty(trim($_GET['AssetNumber']))){
		$sql = "SELECT * FROM tblequipment WHERE AssetNumber= ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt, "s", $_GET['AssetNumber']);
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
	<p>Change the value on the form and submit to update the Equipment</p>
	<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
		Asset Number: <?php echo $account['AssetNumber']; ?> <br>
		Serial Number: <input type = "text" name = "txtSerialNumber" value = "<?php echo $account['SerialNumber']; ?>" required> <br>
		Current Type: <?php echo $account['Type']; ?> <br>
		Change to: <select name = "cmbtype" id = "cmbtype" required>
			<option value = "">--Select Asset Type--</option>
			<option value = "MONITOR">Monitor</option>
			<option value = "CPU">CPU</option>
			<option value = "KEYBOARD">Key Board</option>
			<option value = "MOUSE">Mouse</option>
			<option value = "AVR">AVR</option>
			<option value = "MAC">Mac</option>
			<option value = "PRINTER">Printer</option>
			<option value = "PROJECTOR">Projector</option>
		</select><br>
		Manufacturer: <input type = "text" name = "txtManufacturer" value = "<?php echo $account['Manufacturer']; ?>" required> <br>
		Year: <input type = "text" name = "txtYear" value = "<?php echo $account['YearModel']; ?>" required> <br>
		<textarea id="description" name="txtdescription" rows="6" cols="50"><?php echo $account['Description']; ?></textarea><br>
		Current Department:<?php echo $account['Department']; ?><br>
		Change to:<select name = "cmbdept" id = "cmbdept" required>
			<option value = "">--Select Department--</option>
			<option value = "BURSAR">Bursar</option>
			<option value = "IT DEPT">IT Department</option>
			<option value = "MAC LAB">Mac Lab</option>
			<option value = "COM LAB 1">Computer Lab 01</option>
			<option value = "COM LAB 2">Computer Lab 02</option>
			<option value = "REGISTRAR">Registrar</option>
			<option value = "LIBRARY">Library</option>
			<option value = "ATHLETICS">Athletics Department</option>
		</select><br>
		Current Status: <?php echo $account['Status']; ?> <br>
		Change to: <select name = "cmbstat" id = "cmbstat" required>
			<option value = "">--Select Status--</option>
			<option value = "WORKING">WORKING</option>
			<option value = "ON-REPAIR">ON-REPAIR</option>
			<option value = "RETIRED">RETIRED</option>
		</select><br>

		<input type = "submit" name = "btnsubmit" value = "Update">
		<a href = "AssetManagement.php">Cancel</a>
	</div></form>
</body>
</html>