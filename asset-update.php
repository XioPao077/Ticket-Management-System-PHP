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
		AssetNumber: <?php echo $account['AssetNumber']; ?> <br>
		SerialNumber: <input type = "text" name = "txtSerialNumber" value = "<?php echo $account['SerialNumber']; ?>" required> <br>
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
		Current Status: <?php echo $account['Status']; ?> <br>
		Change to: <select name = "cmbstat" id = "cmbstat" required>
			<option value = "">--Select Status--</option>
			<option value = "WORKING">WORKING</option>
			<option value = "ON-REPAIR">ON-REPAIR</option>
			<option value = "RETIRED">RETIRED</option>
		</select><br>

		<input type = "submit" name = "btnsubmit" value = "Update">
		<a href = "AccountManagement1.php">Cancel</a>
	</div></form>
</body>
</html>