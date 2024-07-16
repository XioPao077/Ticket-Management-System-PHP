<html>
<title> Radio Button Example</Title>
<h1> 
	<font color = 'red'>
		<?php echo "Program 7<br>";?>
	</font>
</h1>

<h3> 
	<center>
		<font color = 'blue'>
			<?php echo "This program shows how to use radiobuttons on PHP<br>"; ?>
		</font>
	</center>
</h3>
<body>
	<form action = "" method = "GET">
		<input type = "radio" name ="rbitems" value = "item1" checked> Item 1 Price = 500 <br>
		<input type = "radio" name ="rbitems" value = "item2" > Item 1 Price = 300 <br>
		<input type = "radio" name ="rbitems" value = "item3" > Item 1 Price = 100 <br>
		<input type = "Submit" name ="btnsubmit" value = "Submit" >
	</form>
</body>
</html>
<?php
	if(isset($_GET['btnsubmit'])){
		$price = 0;
		$item = $_GET['rbitems'];
		if($item == "item1"){
			$price = 500;
		}
		else if($item == "item2"){
			$price = 300;
		}
		else{
			$price = 100;
		}
		?><font color ='red'><?php
		echo "You have selected " . $item . "<br>Price is " . $price; 
	}
?>		</font>