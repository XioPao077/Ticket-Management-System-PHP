<html>
<title>Select Option Example</title>
<body>
	<form action = "" method = "GET">
		Select Item:
		<select name = "items" required>
			<option value = "">--select item--</option>
			<option value = "Item1">Item1</option>
			<option value = "Item2">Item2</option>
			<option value = "Item3">Item3</option>
		</select> <br>
		<input type = "submit" name = "btnSubmit" value = "Submit">
	</form>
</body>
</html>
<?php
if(isset($_GET['btnSubmit'])){
	$item = $_GET['items'];
	$price = 0;
	if($item == "Item1"){
		$price = 500;
	}
	else if($item == "Item2"){
		$price = 300;
	}
	else{
		$price = 100;
	}
	echo "You have selected " . $item . " and its price is " . $price;
}
?>