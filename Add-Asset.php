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
<body>
	<div class = "content">
	<p>Fill up form and submit to add new Equipment</p>
	<form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		Asset Number: <input type = "text" name = "txtAssetNumber" required><br>
		Serial Number: <input type = "text" name = "txtSerialNumber" required><br>
		Equipment Type:<select name = "cmbtype" id = "cmbtype" required>
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
		Manufacturer: <input type = "text" name = "txtmanufacturer" required><br>
		Year Model: <input type = "text" name = "txtyear" required><br>
		<textarea id="description" name="txtdescription" rows="6" cols="50">
		</textarea><br>
		Department:<select name = "cmbdept" id = "cmbdept" required>
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
		<input type = "submit" name ="btnsubmit" value = "Save">
		<a href = "AssetManagement.php"> Cancel </a>
</div></body>
</form>
</html>
<?php 
	include("session-checker.php");
	require_once "config.php";
	if(isset($_POST['btnsubmit'])){
		//check if username exists
		$sql="SELECT * FROM tblequipment WHERE  AssetNumber = ?";
		if($stmt = mysqli_prepare($link, $sql)){
			mysqli_stmt_bind_param($stmt,"s", $_POST['txtAssetNumber']);
			if(mysqli_execute($stmt)){
				$result = mysqli_stmt_get_result($stmt);
				if(mysqli_num_rows($result) !=1){
					$sql = "INSERT INTO tblequipment(AssetNumber,SerialNumber,Type,Manufacturer,YearModel,Description,Department,Status,CreatedBy) VALUES(?,?,?,?,?,?,?,?,?)";
					if($stmt = mysqli_prepare($link,$sql)){
						$status = "WORKING";
						mysqli_stmt_bind_param($stmt, "sssssssss", $_POST['txtAssetNumber'], $_POST['txtSerialNumber'], $_POST['cmbtype'],$_POST['txtmanufacturer'],$_POST['txtyear'],$_POST['txtdescription'],$_POST['cmbdept'],$status, $_SESSION['username']);
						if(mysqli_stmt_execute($stmt)){
							header("location: AssetManagement.php");
							echo "New Asset Added!";
							exit();
						}
						else{
							echo "Error on insert statement";
						}
					}
				}
				else{
					echo "Asset already exists.";
				}
			}
			else{
				echo "Error on select Statement";
			}
		}
	}
?>
