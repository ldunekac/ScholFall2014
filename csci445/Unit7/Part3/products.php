<?php
require './config.php';
function load_products() 
{
	$a_inventory = [];
	$db = new mysqli($GLOBALS["HOST"], $GLOBALS["USER_NAME"], $GLOBALS["PASSWORD"], $GLOBALS["DATA_BASE"]);
	
	if($db->connect_errno > 0)
	{
    	die('Unable to connect to database [' . $db->connect_error . ']');
	}

	$query = "SELECT * FROM `products`";
	$result = $db->query($query) or die($db->error.__LINE__);
	
	while(($data = $result->fetch_assoc())!=null)
	{
		$a_products["Description"] = $data['name'];
		$a_products["Cost"] = $data['cost'];
		array_push($a_inventory, $a_products);
	}
	
	$db->close();
	return $a_inventory;
}

function get_price($a_inventory, $s_productName)
{
	$inventory_length = count($a_inventory);
	for($i = 0; $i < $inventory_length; $i++) 
	{
		if($a_inventory[$i]["Description"] == $s_productName)
		{
			return $a_inventory[$i]["Cost"];
		}
	}
	trigger_error("Item not found");
}

function print_inventory_options($a_inventory, $microcontrollerSelected)
{
	echo '<select name="microcontrollerOptions">';
	for($i = 0; $i < count($a_inventory); $i++)
	{
		echo "<option value =" . $a_inventory[$i]["Description"]; 
		if($a_inventory[$i]["Description"] == $microcontrollerSelected)
		{
			echo ' selected="selected" ';
		}
		echo ">" . $a_inventory[$i]["Description"] . "</option>";
	}
	echo '</select>';
}

?>