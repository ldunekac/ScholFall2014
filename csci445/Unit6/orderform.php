<!--
Luke Dunekacke 
-->
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
	.error {color: #FF0000;}
	#images {display: inline-block;}
	img {margin: auto;}
	table {margin: auto; border-style: solid;}
	tr, td {border-style: solid;}
</style>
<title>Luke's Microcontroller Shop</title>
</head>

<body>
<h1>Luke's Microcontroller Shop</h1>

<?php
require 'products.php';
$a_inventory = load_products();
$nameError = $amountError = "";
$name = "";
$amount = "";
$error = false;
$microcontrollerSelected = "";

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(empty($_POST["name"]))
	{
		$nameError = "Name is quired";
		$error = true;
	}
	else if (preg_match('/^[a-zA-Z \']*$/', $_POST["name"]) == false)
	{
		$nameError = "Only chracters, white space and ' are allowed";
		$error = true;
	}
	else
	{
		$name = $_POST["name"];
	}

	if(empty($_POST["amount"]))
	{
		$error = true;
		$amountError = "Amount is quired";
	}
	else if(!is_numeric($_POST["amount"]) || intval($_POST["amount"]) < 0)
	{
		$error = true;
		$amountError = "Must enter a number greather than zero";
	}
	else
	{
		$amount = test_input($_POST["amount"]);
	}

	$microcontrollerSelected = test_input($_POST["microcontrollerOptions"]);

	if($error == false)
	{
		header("Location: processorder.php?name=$name&amount=$amount&microcontrollerOptions=$microcontrollerSelected");
		exit();
	}
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
?>

<?php
	$number1 = rand(1,6);
	$number2 = rand(1,6);
	$number3 = rand(1,6);
	while($number1 == $number2)
	{
		$number2 = rand(1,6);
	}
	while($number3 == $number1 || $number3 == $number2)
	{
		$number3 = rand(1,6);
	}
	$image1 = "mc" . $number1 .".jpg";
	$image2 = "mc" . $number2 .".jpg";
	$image3 = "mc" . $number3 .".jpg";
?>

<?php 
	
?>
<div id="images">
	<img src="<?php echo $image1; ?>" width="200" height="200">
	<img src="<?php echo $image2; ?>" width="200" height="200">
	<img src="<?php echo $image3; ?>" width="200" height="200">
</div>

<table>
	<tr>
		<td>Microcontroller</td><td>Cost</td>
	</tr>
	<?php
		for($i = 0; $i < count($a_inventory); $i++)
		{
			echo "<tr>";
				echo "<td>";
					echo $a_inventory[$i]["Description"];
				echo "</td>";
				echo "<td>";
					echo $a_inventory[$i]["Cost"];
				echo "</td>";
			echo "</tr>";
		}
	?>
</table>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Name: <input type="text" name="name" value=<?php echo $name; ?>><span class="error">* <?php echo $nameError;?></span><br>
Amount: <input type="number" name="amount" min="0" maxlength="4" size="4" value=<?php echo $amount ?>> <span class="error">* <?php echo $amountError;?></span>

<br>

Please pick a Microcontroller! 
<?php 
	print_inventory_options($a_inventory, $microcontrollerSelected);
?>

<br>
<input type="submit">
</form>

</body>
</html>