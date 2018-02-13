<?php

function getItemName($itemID){
	global $db;

	$selectQuery = "SELECT Name FROM Item where iditem = '$itemID'";
	$result = $db->query($selectQuery);
	$record = $result->fetchArray();
	return $name = $record['Name'];

}