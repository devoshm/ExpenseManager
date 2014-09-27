<?php

if (isset ( $_GET ['action'] )) {
	require_once ('dbconnect.php');
	
	$action = $_GET ['action'];
	
	if ($action == "getalltransactions") {
		$txns = array();
		
		foreach ( $db->query ( 'select a.TxnId,a.BoughtDate, b.Name as UserName, c.Name as ItemName, a.Cost, a.SharedBy from item_purchase a left join user_master b on (a.BoughtBy = b.UserId) left join item_master c on (a.ItemId = c.ItemId) order by a.TxnId desc' ) as $row ) {
			array_push ($txns, array('txnid' => $row ['TxnId'], 'date' => $row ['BoughtDate'], 'paid' => $row ['UserName'], 'item' => $row ['ItemName'], 'amt' => "₹ ".$row ['Cost'], 'share' => $row ['SharedBy']));
		}
		
		echo json_encode ($txns);
	}
	
	if ($action == "getbalancesheet") {
		$balsheet = array();
		
		foreach ( $db->query ( 'select a.name, sum(b.share) as share, sum(b.expense) as expense, sum(b.balance) as balance from user_master a right join balancesheet b on (a.userid=b.userid) group by b.userid ' ) as $row ) {
			array_push ($balsheet, array('name' => $row ['name'], 'share' => "₹ ".$row ['share'], 'expense' => "₹ ".$row ['expense'], 'balance' => "₹ ".$row ['balance']));
		}
	
		echo json_encode ($balsheet);
	}
}
 
