<!DOCTYPE html>
<html>
<head>
<title>Luke's Microcontroller Shop</title>
</head>

<body>
<h1>Luke's Microcontroller Order From</h1>

<?php 
	require 'products.php';
	$pricePerMicrocontroller = get_price(load_products(), $_GET["microcontrollerOptions"]);
	$subtotal = (intval($_GET["amount"]) * $pricePerMicrocontroller);

	$saved = save_order_to_file($_GET["name"], get_time_stamp(), $_GET["amount"], $_GET["microcontrollerOptions"], get_total($subtotal));

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

function save_order_to_file($name, $date, $amount, $item, $totalPrice)
{
	$handle = fopen("orders.txt", "a");
	if(is_null($handle))
	{
		return "Could not write to order file at this time.";
	}
	else
	{
		fwrite($handle, $name . "\t" . $date . "\t" . $amount . "\t" . $item . "\t" . $totalPrice . "\n");
		fclose($handle);
	}
	return "Order written.";
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