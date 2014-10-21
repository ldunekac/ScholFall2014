<!DOCTYPE html>
<html>
<head>
<title>Luke's Microcontroller Shop</title>
</head>

<body>
<h1>Luke's Microcontroller Order From</h1>

<?php 
	require 'config.php';
	require 'products.php';
	$pricePerMicrocontroller = get_price(load_products(), $_GET["microcontrollerOptions"]);
	$subtotal = (intval($_GET["amount"]) * $pricePerMicrocontroller);

	$saved = save_order_to_database($_GET["name"], get_time_stamp(), $_GET["amount"], $_GET["microcontrollerOptions"], get_total($subtotal));

function get_time_stamp() 
{
	date_default_timezone_set('America/Denver');
	$now = getdate();
	$hour = intval($now["hours"]);
	$amOrPm = "am";
	if($hour > 12)
	{
		$amOrPm = "pm";
		$hour = $hour - 12;
	}
	return $now["weekday"] . " " . $now["month"] . " " . $now["mday"]
	. " at " . $hour . ":" . $now["minutes"] . " " . $amOrPm;
}

function save_order_to_database($name, $date, $amount, $item, $totalPrice)
{
	$db = new mysqli($GLOBALS["HOST"], $GLOBALS["USER_NAME"], $GLOBALS["PASSWORD"], $GLOBALS["DATA_BASE"]);
	if($db->connect_errno > 0)
	{
    	return "Could not write order to database.";	
	}
	$query = "INSERT INTO `orders`(`name`, `time`, `amount`, `product`, `total`) VALUES ('$name','$date',$amount,'$item',$totalPrice)";
	$result = $db->query($query);
	$db->close();

	if($result)
	{
		return "Order written to database."; 
	}
	else
	{
		return "Could not write order to database.";
	}	
}

function get_total($subtotal)
{
	return round((($subtotal *.1) + $subtotal),2);
}

?>

Thank you for your order, <?php echo $_GET["name"]; ?>. We hope you enjory your Microcontrolers!
<br>
<br>

Microcontroller type: <?php 
	echo $_GET["microcontrollerOptions"]; 
?>
<br>
Price for each microcontroller: $<?php 
	echo $pricePerMicrocontroller;
?>
<br>
Number of Microcontrollers: <?php 
	echo $_GET["amount"];
?>
<br>

Subtotal: $<?php 
	echo $subtotal;
?>
<br>
Total including tax: $<?php 
	echo get_total($subtotal);
?>
<br>
<br>
Order processed on 
<?php 
	echo get_time_stamp();
?>
<br>
<br>
<?php echo $saved;?>
<br><br>
<a href="orders.php"> View Previous Orders! </a>
</body>
</html>