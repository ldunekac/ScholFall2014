<?php

function load_products() 
{
	$a_inventory = [];
	if(($handle = fopen("products.txt", "r")) !== FALSE)
	{
		while(($data = fgetcsv($handle, 1000, ",")) !== FALSE)
		{
			$num = count($data);
			if($num == 2)
			{
				$a_products["Description"] = $data[0];
				$a_products["Cost"] = floatval(trim($data[1]));
				array_push($a_inventory, $a_products);
			}
		}
	}
	fclose($handle);
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