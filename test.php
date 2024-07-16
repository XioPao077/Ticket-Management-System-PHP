<!DOCTYPE.html>
<html>
	<head>
		<title> Prelim Exam </title>
		<style type = "text/css">
			body{
				background-image: url(backdrop.jpg);
				background-size: cover;
				background-attachment: fixed;
			}
			.content{
				background: floralwhite;
				width: 25%;
				padding: 40px;
				margin:  100px auto;
				font-family: calibri;
				border-radius: 10px;
			}
			.Input{
				position: relative;
				align-content: justified;
			}
			.Tag{
				font-weight: bold;
				font-family: sans-serif;
				font-size: 30px;
			}
			p{
				font-size:  25px;
				color:  black;
			}
		</style>
	</head>
	<body>
		<div class ="content">
			<center><div class ="Tag"> TOTI'S AIRLINE</div><br>
				 		FLIGHT RATE(S): <br>
				<table>
					<tr>
						<th> CODE: </th>
						<th> CLASSIFICATION </th>
						<th> SEAT FARE </th>
					</tr>
					<tr>
						<th> A </th>
						<th> SPECIAL </th>
						<th> PHP 5000 </th>
					</tr>
					<tr>
						<th> B </th>
						<th> ECONOMY</th>
						<th> PHP7000 </th>
					</tr>
					<tr>
						<th> C </th>
						<th> FIRST CLASS</th>
						<th> PHP9000 </th>
					</tr>
					<tr>
						<th> D </th>
						<th> EXECUTIVE</th>
						<th> PHP15000 </th>
					</tr>
				</table><br>
			<div class ="input"><form action = "" method = "GET">
			Please input number of seat(s):<br> <input type = "text" name = "txtseats" required><br>
			<input type = "radio" name ="rbitems" value = "trip1" checked> One Way <br>
			<input type = "radio" name ="rbitems" value = "trip2" > Two Way<br>
			Select Flight Class:<br>
			<select name = "items" required>
			<option value = "">--select Classification--</option>
			<option value = "A">Class A</option>
			<option value = "B">Class B</option>
			<option value = "C">Class C</option>
			<option value = "D">Class D</option>
			</select> <br><br>

			<input type = "submit" name = "btnSubmit" value = "Submit">
			</form></div></center>
		</div>
	</body>
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
				$errorCount += isNotNumeric($_GET['txtseats'], "Input ");
				$price = 0;	
				$class = $_GET['items'];
				if($class == "A"){
				$price = 5000;
				}
				else if($class == "B"){
				$price = 7000;
				}
				else if($class == "C"){
				$price = 9000;
				}
				else{
				$price = 15000;
				}
				$trip = $_GET['rbitems'];
				if($trip == "trip2"){
					$price * 2;
				}
				$gross = $_GET['txtseats'] * $price;
				$tax = $gross * 0.12;
				$net = $gross + $tax;
				$trip = $_GET['rbitems'];

		echo"<script>alert('Your Gross Fare is = PHP $gross with a Tax of = PHP $tax, Your Net Fare is = PHP $net')</script>";
	}
?>