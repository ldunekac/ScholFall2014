<?php

function load_previous_orders()
{
	$peopleOrders = [];
	$handle = fopen("orders.txt", "r");
	while(($data = fgetcsv($handle, 1000, "\t")) !== FALSE)
	{
		$name = $data[0];
		$orderDetals = array($data[1], $data[2], $data[3], $data[4]);
		if(array_key_exists($name, $peopleOrders))
		{
			array_push($peopleOrders[$name], $orderDetals);
		}
		else
		{
			$peopleOrders[$name] = array($orderDetals);
		}
	}
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