<?php

if (isset ( $_GET ['action'] )) {
	require_once ('dbconnect.php');
	
	$action = $_GET ['action'];
	
	if ($action == "getbalsheetwithdates") {
		$startDate = $_GET ['start'];
		$endDate = $_GET ['end'];
		
		$startDate = DateTime::createFromFormat('d/m/Y', $startDate);
		$startDate = $startDate->format('Y-m-d');
		
		$endDate = DateTime::createFromFormat('d/m/Y', $endDate);
		$endDate = $endDate->format('Y-m-d');
		
		$balsheet = array();
	
		$sql = "select a.name, IFNULL(sum(b.share),0.00) as share, IFNULL(sum(b.expense),0.00) as expense, IFNULL(sum(b.balance),0.00) as balance from user_master a left outer join balancesheet b on a.userid=b.userid and b.txndate between '$startDate' and '$endDate' group by a.name";
		foreach ( $db->query ($sql) as $row ) {
				array_push ($balsheet, array('name' => $row ['name'], 'share' => "₹ ".$row ['share'], 'expense' => "₹ ".$row ['expense'], 'balance' => "₹ ".$row ['balance']));
		}

		echo json_encode ($balsheet);
	}
}