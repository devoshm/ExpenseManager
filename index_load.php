<?php

if (isset ( $_GET ['action'] )) {
	require_once ('dbconnect.php');
	
	$action = $_GET ['action'];
	
	if ($action == "getrecenttxns") {
		$txns = array();
		
		foreach ( $db->query ( 'select a.BoughtDate, b.Name as UserName, c.Name as ItemName, a.Cost from item_purchase a left join user_master b on (a.BoughtBy = b.UserId) left join item_master c on (a.ItemId = c.ItemId) order by a.TxnId desc limit 10' ) as $row ) {
			array_push ($txns, array('date' => $row ['BoughtDate'], 'paid' => $row ['UserName'], 'item' => $row ['ItemName'], 'amt' => "₹ ".$row ['Cost']));
		}
		
		echo json_encode ($txns);
	}
	
	if ($action == "getshare") {
		$share = array();
	
		foreach ( $db->query ( 'select a.name, sum(b.share) as share from user_master a right join balancesheet b on (a.userid=b.userid) group by b.userid' ) as $row ) {
			array_push ($share, array('name' => $row ['name'], 'share' => $row ['share']));
		}

		echo json_encode ($share);
	}
}