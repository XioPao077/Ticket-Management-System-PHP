<html>
<head>
	<title>Triangle Calculator</title>
</head>
<h1><center><font color = 'white'> Activity 01</font></center></h1>
<br><center><body bgcolor = '#59e9ff'>
<form action = "" method = "POST">
	Input Adjacent: <input type = "text" name = "txtopp" required><br>
	Input Opposite: <input type = "text" name = "txtadj" required><br>
	Input Hypotenuse: <input type = "text" name = "txthyp" required><br>
	<input type = "submit" name = "btnsin" value = "Sine">
	<input type = "submit" name = "btncos" value = "Cosine">
	<input type = "submit" name = "btntan" value = "Tangent">
</form>
</body>
</center>
<h4>
	<center>
		<font color = 'white'> JOHN PAOLO TAMPOS </font><br>
		<font color = 'white'> ITC127 - 2022 </font>
	</center>
</h4>
</html>
<?php
	if(isset($_POST['btnsin'])){
		//input
		$opp = $_POST['txtopp'];
		$adj = $_POST['txtadj'];
		$hyp = $_POST['txthyp'];
		//process
		$sine = $opp / $hyp;
		//output 
		?> <center><font color = 'white'> <?php
			echo "Opposite:" . $opp. "<br>Hypotenuse:" .$hyp."<br>Sine:". $sine; ?></font></center><?php
	}
?>
<?php
	if(isset($_POST['btncos'])){
		//input
		$opp = $_POST['txtopp'];
		$adj = $_POST['txtadj'];
		$hyp = $_POST['txthyp'];
		//process
		$cos = $adj / $hyp;
		//output 
		?><center> <font color = 'white'> <?php
			echo "Adjacent:" . $adj. "<br>Hypotenuse:" .$hyp."<br>Cosine:". $cos; ?></font></center> <?php
	}
?>
<?php
	if(isset($_POST['btntan'])){
		//input
		$opp = $_POST['txtopp'];
		$adj = $_POST['txtadj'];
		$hyp = $_POST['txthyp'];
		//process
		$tan = $opp / $adj;
		//output 
		?><center> <font color = 'white'> <?php
			echo "Opposite:" . $opp. "<br>Adjacent:" .$adj."<br>Tangent:". $tan; ?></font></center> <?php
	}
?>