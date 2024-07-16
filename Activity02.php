<html>
<head>
<title> Salary Calculator</Title>
</head>
<h1> 
	<font color = 'white'>
		<?php echo "Activity 02<br>";?>
	</font>
</h1>
<h3><center><font color = 'white'>
			<?php echo "This program Computes for the Salary and Deductions of a regular and a contractual employee.<br>"; ?>
</font></center></h3>
<body background ="bg.jpg "></body>
<form action = "" method = "GET"><center>
	Enter Employee rate: <input type = "text" name = "txtRate" required><br>
	Enter Hours Worked: <input type = "text" name = "txtHours" required><br></center>

	<input type = "radio" name ="rbitems" value = "item1" checked> Regular<br>
	<input type = "radio" name ="rbitems" value = "item2" > Contractual <br>
	<input type = "checkbox" name = "cbSSS">SSS<br>
	<input type = "checkbox" name = "cbPagibig">Pagibig<br>
	<input type = "checkbox" name = "cbPhil">PhilHealth<br>
	<center><input type = "submit" name = "btnSubmit" value = "Submit"></center>
</form>
</html>
<?php
	$errorCount = 0;
		function isNotNumeric($object, $message){
			if(!is_numeric($object)){
				echo"<font color = 'red'><center>". $message . "<br></center></font>";
				return 1;
			}
			return 0;	
		}
		if(isset($_GET['btnSubmit'])){
		$errorCount += isNotNumeric($_GET['txtRate'], "Rate must be numeric");
		$errorCount += isNotNumeric($_GET['txtHours'], "Hours worked must be numeric");
		$item = $_GET['rbitems'];
			if($errorCount == 0){
				$gross = $_GET['txtRate'] * $_GET['txtHours'];
				$SSS = $gross * 0.10;
				$Pagibig = $gross * 0.06;
				$Philhealth = $gross * 0.05;
				$tax = $gross * 0.12;
				$deduction = $SSS + $Pagibig +$Philhealth + $tax;
				$net = $gross - $deduction;	
				echo"<script>alert('Your Salary is = $net with deductions of : Tax = $tax  ,SSS = $SSS ,PAGIBIG = $Pagibig ,Philhealth = $Philhealth')</script>";
			if($item == "item1"){
				$net + 500; 
			}
			if(isset($_GET['cbSSS'])){
				if($errorCount == 0){
				echo"<font color = 'blue'>SSS = ". $SSS . "<br></font>";
				}
			}

			if(isset($_GET['cbPagibig'])){
				if($errorCount == 0){
				echo"<font color = 'blue'>PAGIBIG = ". $Pagibig . "<br></font>";
				}
			}

			if(isset($_GET['cbPhil'])){
				if($errorCount == 0){
				echo"<font color = 'blue'> Philhealth = ". $Philhealth . "<br></font>";
				}
			}
			}
		}
		
?>;