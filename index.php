<!DOCTYPE html>
<html lang="en">

	<head>
	
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	
	    <title>Expense Manager</title>
	
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/datepicker.css">
		<link href="css/sb-admin-2.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/plugins/morris.css" rel="stylesheet">
		<link href="font-awesome-4.1.0/css/font-awesome.min.css"
			rel="stylesheet" type="text/css">
	
	</head>
	
	<body>
	
		<div id="wrapper">
	
			<nav class="navbar navbar-default navbar-static-top" role="navigation"
				style="margin-bottom: 0">
				<div class="navbar-header">
					<a class="navbar-brand" href="index.php">Expense Manager</a>
				</div>

				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
							<i class="fa fa-user fa-fw"></i> 
							<i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
							<li>
								<a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
							</li>
							<li>
								<a href="settings.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
							</li>
						</ul>
					</li>
				</ul>
				
				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">
							<li class="sidebar-search">
								<a href="index.php"><i class="fa fa-user fa-fw"></i> Devosh Mathivanan</a>
							</li>
							<li>
								<a class="active" href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
							</li>
							<li>
								<a href="transactions.php"><i class="fa fa-table fa-fw"></i> Transactions</a>
							</li>
							<li>
								<a href="expense.php"><i class="fa fa-edit fa-fw"></i> Expense</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
	
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Dashboard</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-bar-chart-o fa-fw"></i> Last 10 transactions
							</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-12">
										<div class="table-responsive">
											<table class="table table-bordered table-hover table-striped">
												<thead>
													<tr>
														<th>Date</th>
														<th>Paid By</th>
														<th>Item</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody id="tblrecenttxns"></tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class="fa fa-bar-chart-o fa-fw"></i> Shares
							</div>
							<div class="panel-body">
								<table>
									<thead>
										<tr>
											<th>From: 
												<input type="text" id="fromdate" value=""
												class="span2" size="12" readonly="readonly">
											</th>
											<th>To: 
												<input type="text" id="todate" value=""
												class="span2" size="12" readonly="readonly">
											</th>
										</tr>
									</thead>
								</table>
								<div id="morris-donut-chart"></div>
								<a href="transactions.php" class="btn btn-default btn-block">View Details</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	
		<script src="js/jquery-1.11.0.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<script src="js/plugins/morris/raphael.min.js"></script>
		<script src="js/plugins/morris/morris.min.js"></script>
		<script src="js/sb-admin-2.js"></script>
		
		<script type="text/javascript">

			$(document).ready(function() {
	
				$.ajax({
		             url:'index_load.php',
		             method: 'GET',
		             data: {
		            	 action: 'getrecenttxns'
		             },
		             success:function(data) {
		            	var txns = JSON.parse(data); 
	
		            	$('#tblrecenttxns').empty();
		             	$.each(txns, function(idx, obj) {
		                	$('#tblrecenttxns').append('<tr><td>'+obj.date+'</td><td>'+obj.paid+'</td><td>'+obj.item+'</td><td>'+obj.amt+'</td></tr>');
		                });
		             }
		        });
	
				$.ajax({
		             url:'index_load.php',
		             method: 'GET',
		             data: {
		            	 action: 'getshare'
		             },
		             success:function(data) {
						var chartdata = JSON.parse(data);
		            	Morris.Donut({ element: 'morris-donut-chart', data: [{label: chartdata[0].name, value: chartdata[0].share },{label: chartdata[1].name, value: chartdata[1].share },{label: chartdata[2].name, value: chartdata[2].share },{label: chartdata[3].name, value: chartdata[3].share },], resize: true });
		             }
		        });
	
				var maxDay = new Date();
				
				$('#fromdate').datepicker({
					autoclose: true,
					format: "dd/mm/yyyy", 
				    endDate: maxDay
				});
	
				$('#fromdate').datepicker().on('changeDate', function(ev) {
					var fromDay = document.getElementById("fromdate").value;
	
					$('#todate').datepicker({
						autoclose: true,
						forceParse: true,
						format: "dd/mm/yyyy",
						startDate: fromDay,
						endDate: maxDay
					}).datepicker('show').datepicker('setStartDate', fromDay).on('changeDate', function(ev) {
						$('#todate').datepicker('hide');
						var fromDate = document.getElementById("fromdate").value;
						var toDate = document.getElementById("todate").value;
						
						$.ajax({
				             url:'index_submit.php',
				             method: 'GET',
				             data: {
				            	 action: 'getsharewithdates',
				            	 start: fromDate,
				            	 end: toDate
				             },
				             success:function(data) {
					            $('#morris-donut-chart').empty();
						        var chartdata = JSON.parse(data);
				            	Morris.Donut({ element: 'morris-donut-chart', data: [{label: chartdata[0].name, value: chartdata[0].share },{label: chartdata[1].name, value: chartdata[1].share },{label: chartdata[2].name, value: chartdata[2].share },{label: chartdata[3].name, value: chartdata[3].share },], resize: true });
				             }
				        });
					});
				});
			});

		</script>
	</body>
</html>
