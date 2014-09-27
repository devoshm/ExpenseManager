<?php

if (isset ( $_GET ['action'] )) {
	require_once ('dbconnect.php');
	
	$action = $_GET ['action'];
	
	if ($action == "getsharewithdates") {
		$startDate = $_GET ['start'];
		$endDate = $_GET ['end'];
		
		$startDate = DateTime::createFromFormat('d/m/Y', $startDate);
		$startDate = $startDate->format('Y-m-d');
		
		$endDate = DateTime::createFromFormat('d/m/Y', $endDate);
		$endDate = $endDate->format('Y-m-d');
		
		$share = array();
	
		$sql = "select a.name, IFNULL(sum(b.share),0.00) as share from user_master a left outer join balancesheet b on a.userid=b.userid and b.txndate between '$startDate' and '$endDate' group by a.name";
		foreach ( $db->query ($sql) as $row ) {
				array_push ($share, array('name' => $row ['name'], 'share' => $row ['share']));
		}

		echo json_encode ($share);
	}
}