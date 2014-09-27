<?php

if (isset ( $_GET ['action'] )) {
	require_once ('dbconnect.php');

	$action = $_GET ['action'];

	if ($action == "createtxn") {
		$date = $_GET ['date'];
		$paid = $_GET ['paid'];
		$item = $_GET ['item'];
		$share = $_GET ['share'];
		$amount = $_GET ['amount'];
		
		$date = DateTime::createFromFormat('d/m/Y', $date);
		$date = $date->format('Y-m-d');
		$noshares = sizeof($share);
		$share = implode($share, ",");
		
		$sql = "INSERT INTO item_purchase (ItemId, BoughtBy, BoughtDate, SharedBy, Cost) VALUES (:ItemId, :BoughtBy, :BoughtDate, :SharedBy, :Cost)";
 		$q = $db->prepare($sql);
 		$q->execute(array(':ItemId'=>$item, ':BoughtBy'=>$paid, ':BoughtDate'=>$date, ':SharedBy'=>$share, ':Cost'=>$amount));
 		$affected_rows = $q->rowCount();
 		
 		echo $affected_rows;
		
 		if($affected_rows == 1) {
 			$txnid = $db->lastInsertId('TxnId');
 			$eachshare = $amount/$noshares;
 			
 			$sql = "INSERT INTO balancesheet (TxnId, UserId, TxnDate, Share, Expense, Balance) VALUES (:TxnId, :UserId, :TxnDate, :Share, :Expense, :Balance)";
 			$q = $db->prepare($sql);
 			$q->execute(array(':TxnId'=>$txnid, ':UserId'=>$paid, ':TxnDate'=>$date, ':Share'=>0.00, ':Expense'=>$amount, ':Balance'=>-$amount));
 			
 			$users = explode(",", $share);
 			
 			foreach ($users as $user){
 				foreach ($db->query("select * from user_master where name='$user'") as $row)
 					$userid = $row['UserId'];
 				
 				$sql = "INSERT INTO balancesheet (TxnId, UserId, TxnDate, Share, Expense, Balance) VALUES ('$txnid', '$userid', '$date', '$eachshare', '0.00', '$eachshare') on duplicate key update Share = '$eachshare', Balance = $eachshare-$amount";
 				$db->exec($sql);
 			}
 		}
 	}
 	
 	if ($action == "edittxn") {
 		$txnid = $_GET ['txnid'];
 		$date = $_GET ['date'];
 		$paid = $_GET ['paid'];
 		$item = $_GET ['item'];
 		$share = $_GET ['share'];
 		$amount = $_GET ['amount'];
 	
 		$date = DateTime::createFromFormat('d/m/Y', $date);
 		$date = $date->format('Y-m-d');
 		$noshares = sizeof($share);
 		$share = implode($share, ",");
 	
 		$sql = "update item_purchase set ItemId = :ItemId, BoughtBy = :BoughtBy, BoughtDate = :BoughtDate, SharedBy = :SharedBy, Cost = :Cost where TxnId = :Txnid";
 		$q = $db->prepare($sql);
 		$q->execute(array(':ItemId'=>$item, ':BoughtBy'=>$paid, ':BoughtDate'=>$date, ':SharedBy'=>$share, ':Cost'=>$amount, ':Txnid'=>$txnid));
 		$affected_rows = $q->rowCount();
 			
 		if($affected_rows == 1) {
 			$sql = "delete from balancesheet where TxnId = '$txnid'";
 			$db->exec($sql);
 			
 			$eachshare = $amount/$noshares;
 	
 			$sql = "INSERT INTO balancesheet (TxnId, UserId, TxnDate, Share, Expense, Balance) VALUES ('$txnid', '$paid', '$date', '0.00', '$amount', '-$amount')";
 			$db->exec($sql);
 			
 			$users = explode(",", $share);
 	
 			foreach ($users as $user){
 				foreach ($db->query("select * from user_master where name='$user'") as $row)
 					$userid = $row['UserId'];
 					
 				$sql = "INSERT INTO balancesheet (TxnId, UserId, TxnDate, Share, Expense, Balance) VALUES ('$txnid', '$userid', '$date', '$eachshare', '0.00', '$eachshare') on duplicate key update Share = '$eachshare', Balance = $eachshare-$amount";
 				$affected_rows = $db->exec($sql);
 			}
 			echo $affected_rows;
 		}
 	}
 	
 	if ($action == "deletetxn") {
 		$txnid = $_GET ['txnid'];
 	
 		$sql = "delete item_purchase, balancesheet from item_purchase, balancesheet where item_purchase.TxnId=balancesheet.TxnId and item_purchase.TxnId = '$txnid'";
 		$affected_rows = $db->exec($sql);
 	
 		echo $affected_rows;
 	}
}