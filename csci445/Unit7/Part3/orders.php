<?php
require './config.php';
function load_previous_orders()
{
	$peopleOrders = [];
	$db = new mysqli($GLOBALS["HOST"], $GLOBALS["USER_NAME"], $GLOBALS["PASSWORD"], $GLOBALS["DATA_BASE"]);
	if($db->connect_errno > 0)
	{
    	echo ('Unable to connect to database [' . $db->connect_error . ']');
		return $peopleOrders;
	}
	$query = "SELECT * FROM `orders`";
	$result = $db->query($query) or die($db->error.__LINE__);

	while(($data = $result->fetch_assoc())!=null)
	{
		$name = $data['name'];
		$orderDetals = array($data['time'], $data['amount'], $data['product'], $data['total']);
		if(array_key_exists($name, $peopleOrders))
		{
			array_push($peopleOrders[$name], $orderDetals);
		}
		else
		{
			$peopleOrders[$name] = array($orderDetals);
		}
	}
	$db->close();
	return $peopleOrders;
}

$orders = load_previous_orders();
?>

<html>
<head>
	<title>Previous Orders</title>
</head>
<body>
<h1> Luke's Microcontroller Shop <h1>

<h2> Customer Orders </h2>
	<?php
		$grandTotal = 0; 
		if(count($orders) == 0)
		{
			echo "There are no orders to view. ";
		}
		foreach($orders as $key => $value)
		{
			echo "Orders for <b>" . $key . "</b><br>";
			echo "<ul>";
			for($i = 0; $i < count($value); $i++)
			{
				$grandTotal += floatval($value[$i][3]);
				echo "<li>";
				echo "On " . $value[$i][0] . " ordered " . $value[$i][1] . " " . $value[$i][2] . " for a total of $" . $value[$i][3] . ".";
				echo "</li>";
			}
			echo "</ul>";
		}
		if(count($orders) > 0)
		{
			echo "Grand Total: " . $grandTotal;	
		}
	?>
</body>
</html>
