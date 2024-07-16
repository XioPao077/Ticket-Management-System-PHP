<html>
<head>
	<title>MDAS Calculator</title>
</head>
<h1> 
	<font color = 'white'> Program 4A</font>
</h1>
<br>
<h3> 
	<center>
		<font color = 'white'> Description: This program shows on how to get user input using textbox and processing it using PHP POST method</font> 
	</center>
</h3>
<br>
<center>
<body bgcolor = '#ff9f2b'>
<form action = "" method = "POST">
	Input number: <input type = "text" name = "txtfno" required><br>
	Input number: <input type = "text" name = "txtsno" required><br>
	<input type = "submit" name = "btnadd" value = "Add">
	<input type = "submit" name = "btnsub" value = "Subtract">
	<input type = "submit" name = "btnmul" value = "Multiply">
	<input type = "submit" name = "btndiv" value = "Divide">
</form>
</body>
</center>
<h1>
	<center>
		<font color = 'white'> ITC127 - 2022 </font>
		<br>
		<font color = 'white'> JOHN PAOLO TAMPOS </font>
	</center>
</h1>
</html>
<?php
	if(isset($_POST['btnadd'])){
		//input
		$fno = $_POST['txtfno'];
		$sno = $_POST['txtsno'];
		//process
		$result = $fno + $sno;
		//output 
		?> <font color = 'white'> <?php
			echo "First number:" . $fno. "<br>Second number:" .$sno."<br>Sum:". $result; ?></font> <?php
	}
?>