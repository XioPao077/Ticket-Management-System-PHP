<html>
<head>
	<title> Sine, Cosine, Tangent Calculator</title>
</head>
<h1>
	<font color = 'red'>
		<?php echo "Program 9<br>"; ?>
	</font>
</h1>

<h3>
	<center>
		<font color = 'blue'>
			<?php echo "This program shows how to validate user's input using HTML forms and GET Method<br>"; ?>
		</font>
	</center>
</h3>
<form action = "" method = "GET">
	Input Adjacent Side: <input type = "text" name = "txtAdjacent" required><br>
	Input Hypotenuse Side: <input type = "text" name = "txtHypotenuse" required><br>
	Input Opposite Side: <input type = "text" name = "txtOpposite" required><br>
	<input type = "checkbox" name = "cbSin">Sine<br>
	<input type = "checkbox" name = "cbCos">Cosine<br>
	<input type = "checkbox" name = "cbTan">Tangent<br>
	<input type = "submit" name = "btnSubmit" value = "Submit">
</form>
</html>

	<?php
		$errorCount = 0;
		function isNotNumeric($object, $message){
			if(!is_numeric($object)){
				echo"<font color = 'red'>". $message . "<br></font>";
				return 1;
			}
			return 0;
	}	
	if(isset($_GET['btnSubmit'])){
		$errorCount += isNotNumeric($_GET['txtAdjacent'], "Adjacent Side must be numeric");
		$errorCount += isNotNumeric($_GET['txtOpposite'], "Opposite Side must be numeric");
		$errorCount += isNotNumeric($_GET['txtHypotenuse'], "Hypotenuse Side must be numeric");
		if(isset($_GET['cbSin'])){
			if($errorCount == 0){
			$sine = $_GET['txtOpposite']/ $_GET['txtHypotenuse'];
			echo"<font color = 'blue'> Sine = " . $sine . "<br></font>";
			}
		}
		if(isset($_GET['cbCos'])){
			if($errorCount == 0){
			$cosine = $_GET['txtAdjacent']/ $_GET['txtHypotenuse'];
			echo"<font color = 'blue'> Sine = " . $cosine . "<br></font>";
			}
		}
		if(isset($_GET['cbTan'])){
			if($errorCount == 0){
			$tangent = $_GET['txtOpposite']/ $_GET['txtAdjacent'];
			echo"<font color = 'blue'> Sine = " . $tangent . "<br></font>";
		}		
	}
}


?>