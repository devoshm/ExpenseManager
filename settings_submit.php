<?php
if (isset ( $_GET ['action'] )) {
	require_once ('dbconnect.php');
	
	$action = $_GET ['action'];
	
	if ($action == "createuser") {
		$name = $_GET ['name'];
		
		if (isset ( $_GET ['subaction'] )) {
			$subaction = $_GET ['subaction'];
			
			if($subaction == "true") {
				$sql = "update user_master set flag_active = :Flag where name = :Name";
				$q = $db->prepare ( $sql );
				
				$q->execute ( array (
						':Name' => $name,
						':Flag' => 1
				) );
				
				$affected_rows = $q->rowCount ();
				echo $affected_rows;
			} else {
				$sql = "INSERT INTO user_master (Name, flag_active) VALUES (:Name, :Flag)";
				$q = $db->prepare ( $sql );
				
				$q->execute ( array (
						':Name' => $name,
						':Flag' => 1
				) );
				
				$affected_rows = $q->rowCount ();
				echo $affected_rows;
			}
		} else {
			$sql = "SELECT * FROM user_master where Name = '$name'";
			$stmt = $db->query ( $sql );
			$row = $stmt->fetchObject ();
			
			if ($row)
				echo $row->Name;
			else {
				$sql = "INSERT INTO user_master (Name, flag_active) VALUES (:Name, :Flag)";
				$q = $db->prepare ( $sql );
				$q->execute ( array (
						':Name' => $name,
						':Flag' => 1 
				) );
				$affected_rows = $q->rowCount ();
				
				echo $affected_rows;
			}
		}
	}
	
	if ($action == "edituser") {
		$userid = $_GET ['userid'];
		$name = $_GET ['name'];
		
		$sql = "update user_master set Name = :Name where UserId = :Userid";
		$q = $db->prepare ( $sql );
		
		$q->execute ( array (
				':Name' => $name,
				':Userid' => $userid 
		) );
		
		$affected_rows = $q->rowCount ();
		echo $affected_rows;
	}
	
	if ($action == "deleteuser") {
		$userid = $_GET ['userid'];
		
		$sql = "update user_master set flag_active = :Flag where UserId = :Userid";
		$q = $db->prepare ( $sql );
		
		$q->execute ( array (
				':Flag' => 0,
				':Userid' => $userid 
		) );
		
		$affected_rows = $q->rowCount ();
		echo $affected_rows;
	}
	
	if ($action == "createitem") {
		$name = $_GET ['name'];
	
		if (isset ( $_GET ['subaction'] )) {
			$subaction = $_GET ['subaction'];
				
			if($subaction == "true") {
				$sql = "update item_master set flag_active = :Flag where name = :Name";
				$q = $db->prepare ( $sql );
	
				$q->execute ( array (
						':Name' => $name,
						':Flag' => 1
				) );
	
				$affected_rows = $q->rowCount ();
				echo $affected_rows;
			} else {
				$sql = "INSERT INTO item_master (Name, flag_active) VALUES (:Name, :Flag)";
				$q = $db->prepare ( $sql );
	
				$q->execute ( array (
						':Name' => $name,
						':Flag' => 1
				) );
	
				$affected_rows = $q->rowCount ();
				echo $affected_rows;
			}
		} else {
			$sql = "SELECT * FROM item_master where Name = '$name'";
			$stmt = $db->query ( $sql );
			$row = $stmt->fetchObject ();
				
			if ($row)
				echo $row->Name;
			else {
				$sql = "INSERT INTO item_master (Name, flag_active) VALUES (:Name, :Flag)";
				$q = $db->prepare ( $sql );
				$q->execute ( array (
						':Name' => $name,
						':Flag' => 1
				) );
				$affected_rows = $q->rowCount ();
	
				echo $affected_rows;
			}
		}
	}
	
	if ($action == "edititem") {
		$itemid = $_GET ['itemid'];
		$name = $_GET ['name'];
	
		$sql = "update item_master set Name = :Name where ItemId = :Itemid";
		$q = $db->prepare ( $sql );
	
		$q->execute ( array (
				':Name' => $name,
				':Itemid' => $itemid
		) );
	
		$affected_rows = $q->rowCount ();
		echo $affected_rows;
	}
	
	if ($action == "deleteitem") {
		$itemid = $_GET ['itemid'];
	
		$sql = "update item_master set flag_active = :Flag where ItemId = :Itemid";
		$q = $db->prepare ( $sql );
	
		$q->execute ( array (
				':Flag' => 0,
				':Itemid' => $itemid
		) );
	
		$affected_rows = $q->rowCount ();
		echo $affected_rows;
	}
}