<?php

if (isset ( $_GET ['action'] )) {
	require_once ('dbconnect.php');
	
	$action = $_GET ['action'];
	
	if ($action == "getusers") {
		$users = array();
		
		foreach ( $db->query ( 'SELECT * FROM user_master where flag_active = 1' ) as $row ) {
			array_push ($users, array('id' => $row ['UserId'], 'name' => $row ['Name']));
		}
		
		echo json_encode ($users);
	}
	
	if ($action == "getitems") {
		$items = array();
	
		foreach ( $db->query ( 'SELECT * FROM item_master where flag_active = 1' ) as $row ) {
			array_push ($items, array('id' => $row ['ItemId'], 'name' => $row ['Name']));
		}
	
		echo json_encode ($items);
	}
}
 
