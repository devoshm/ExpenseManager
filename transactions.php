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
<link rel="stylesheet" href="css/bootstrap-combobox.css">
<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
<link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
<link href="css/sb-admin-2.css" rel="stylesheet">
<link href="font-awesome-4.1.0/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">

<style>
.table-hover tbody tr.selected>td {
	background-color: #017ebc;
	color: white;
}

.datepicker {
	z-index: 100000;
}

.result {
	width: 200px;
	height: 50px;
	border: 2px solid #eee;
	background: #017ebc;
	color: white;
	font-family: Calibri;
	line-height: 50px;
	text-align: center;
	font-size: 15px;
	position: absolute;
	left: 50%;
	margin-left: -250px;
}
</style>

</head>

<body>

	<div id="wrapper">

		<nav class="navbar navbar-default navbar-static-top" role="navigation"
			style="margin-bottom: 0">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">Expense Manager</a>
			</div>
			<ul class="nav navbar-top-links navbar-right">
				<li class="dropdown"><a class="dropdown-toggle"
					data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i
						class="fa fa-caret-down"></i>
				</a>
					<ul class="dropdown-menu dropdown-user">
						<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
						</li>
						<li><a href="settings.php"><i class="fa fa-gear fa-fw"></i>
								Settings</a></li>
						<li class="divider"></li>
						<li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i>
								Logout</a></li>
					</ul></li>
			</ul>
			<div class="navbar-default sidebar" role="navigation">
				<div class="sidebar-nav navbar-collapse">
					<ul class="nav" id="side-menu">
						<li class="sidebar-search"><a href="index.php"><i
								class="fa fa-user fa-fw"></i> Devosh Mathivanan</a></li>
						<li><a href="index.php"><i class="fa fa-dashboard fa-fw"></i>
								Dashboard</a></li>
						<li><a class="active" href="transactions.php"><i
								class="fa fa-table fa-fw"></i> Transactions</a></li>
						<li><a href="expense.php"><i class="fa fa-edit fa-fw"></i> Expense</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Transactions</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">All Transactions</div>
						<div class="panel-body">
							<p>
								<button class="btn btn-primary" type="button" id="btnNew"
									data-target="#modalTxn" data-toggle="modal">New</button>
								<button class="btn btn-warning" type="button" id="btnEdit"
									data-target="#modalTxn" data-toggle="modal">Edit</button>
								<button class="btn btn-danger" type="button" id="btnDelete"
									data-target="#modalDelete" data-toggle="modal">Delete</button>
							</p>
							<div class='result' style='display: none'></div>

							<div id="modalTxn" class="modal fade" aria-hidden="true"
								aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
								style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button class="close" aria-hidden="true" data-dismiss="modal"
												type="button">x</button>
											<h4 class="modal-title" id="modalTitle"></h4>
										</div>
										<div class="modal-body">
											<form role="form" id="frmExpense">
												<div class="form-group" id="TxnId" style="display: none;">
													<label>Txn ID</label> <input type="text"
														class="form-control" id="txtTxnId" disabled="disabled">
												</div>
												<div class="form-group">
													<label>Date</label><br /> <input type="text" id="datepick"
														value="" class="span2" size="16" readonly="readonly">
												</div>
												<div class="form-group">
													<label>Paid By</label> <select class="form-control"
														id="selpaidby">
													</select>
												</div>
												<div class="form-group">
													<label>Item Name</label> <select
														class="form-control combobox" id="selitems">
													</select>
												</div>
												<div class="form-group">
													<label>Shared By</label>
													<div class="checkbox chkUsers" id="chkshare"></div>
												</div>
												<div class="form-group input-group">
													<span class="input-group-addon">₹</span> <input type="text"
														class="form-control" id="txtAmt">
												</div>
											</form>
										</div>
										<div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal"
												type="button" id="btnClose">Close</button>
											<button class="btn btn-primary" type="button" id="btnSave">Save
												changes</button>
										</div>
									</div>
								</div>
							</div>
							<div id="modalDelete" class="modal fade" aria-hidden="true"
								aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
								style="display: none;">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button class="close" aria-hidden="true" data-dismiss="modal"
												type="button">x</button>
											<h4 class="modal-title">Delete Transaction</h4>
										</div>
										<div class="modal-body">Are you sure of deleting this
											transaction?</div>
										<div class="modal-footer">
											<button class="btn btn-default" data-dismiss="modal"
												type="button" id="btnNo">No</button>
											<button class="btn btn-primary" type="button" id="btnYes">Yes</button>
										</div>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover"
									id="dataTables-example">
									<thead>
										<tr>
											<th style="display: none;">Txn ID</th>
											<th>Date</th>
											<th>Paid By</th>
											<th>Item</th>
											<th>Cost</th>
											<th>Shared By</th>
										</tr>
									</thead>
									<tbody id="tbltransactions">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Balance Sheet</div>
						<div class="panel-body">
							<table>
								<thead>
									<tr>
										<th style="padding-right: 15px;">From: <input type="text"
											id="fromdate" value="" class="span2" size="16"
											readonly="readonly">
										</th>
										<th>To: <input type="text" id="todate" value="" class="span2"
											size="16" readonly="readonly">
										</th>
									</tr>
								</thead>
							</table>
							<div class="table-responsive">
								<table class="table table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>Share</th>
											<th>Expense</th>
											<th>Balance</th>
										</tr>
									</thead>
									<tbody id="tblbalance">
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/jquery-1.11.0.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-combobox.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
	<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
	<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script src="js/sb-admin-2.js"></script>

	<script type="text/javascript">
	    	var tableData;

	    	function tablerowclick() {
	    		$("#tbltransactions").on('click', 'tr', function() {
					if ($(this).hasClass("selected")) {
				    	$(this).removeClass("selected");
				    	$('#btnEdit').addClass("disabled");
				    	$('#btnDelete').addClass("disabled");
					} else {
						$("#tbltransactions tr").removeClass("selected");
						$(this).addClass("selected");
						$('#btnEdit').removeClass("disabled");
				    	$('#btnDelete').removeClass("disabled");
					}
					tableData = $(this).children("td").map(function() {
				        return $(this).text();
				    }).get();
				});
	    	}
	    	
	    	function loadTransactions() {
	    		$.ajax({
		             url:'transactions_load.php',
		             method: 'GET',
		             data: {
		            	 action: 'getalltransactions'
		             },
		             success:function(data) {
		            	var txns = JSON.parse(data); 

		            	$('#dataTables-example').dataTable().fnDestroy();
			    		$('#tbltransactions').empty();
			    		$('#btnEdit').addClass("disabled");
				    	$('#btnDelete').addClass("disabled");

		             	$.each(txns, function(idx, obj) {
		                	$('#tbltransactions').append("<tr><td style='display: none;'>"+obj.txnid+"</td><td>"+obj.date+"</td><td>"+obj.paid+"</td><td>"+obj.item+"</td><td>"+obj.amt+"</td><td>"+obj.share+"</td></tr>");
		                });
		                
		             	$('#dataTables-example').dataTable();
		             	tablerowclick();
		             }
		        });
	    	}

		    function loadBalanceSheet() {
		    	$.ajax({
		             url:'transactions_load.php',
		             method: 'GET',
		             data: {
		            	 action: 'getbalancesheet'
		             },
		             success:function(data) {
		            	var balsheet = JSON.parse(data); 
	
		            	$('#tblbalance').empty();
		             	$.each(balsheet, function(idx, obj) {
		                	$('#tblbalance').append('<tr><td>'+obj.name+'</td><td>'+obj.share+'</td><td>'+obj.expense+'</td><td>'+obj.balance+'</td></tr>');
		                });
		             }
		        });
			}

			function loadBalanceSheetWithDates() {
				var fromDate = document.getElementById("fromdate").value;
				var toDate = document.getElementById("todate").value;
				
				$.ajax({
		             url:'transactions_submit.php',
		             method: 'GET',
		             data: {
		            	 action: 'getbalsheetwithdates',
		            	 start: fromDate,
		            	 end: toDate
		             },
		             success:function(data) {
			            console.log(data);
		            	var balsheet = JSON.parse(data); 

		            	$('#tblbalance').empty();
		             	$.each(balsheet, function(idx, obj) {
		                	$('#tblbalance').append('<tr><td>'+obj.name+'</td><td>'+obj.share+'</td><td>'+obj.expense+'</td><td>'+obj.balance+'</td></tr>');
		                });
		             }
		        });
			}

			function loadUsers() {
				$.ajax({
		             url:'expense_load.php',
		             method: 'GET',
		             data: {
		            	 action: 'getusers'
		             },
		             success:function(data) {
		             	var users = JSON.parse(data); 
		             	
		             	$.each(users, function(idx, obj) {
		                	$('#selpaidby').append('<option value='+obj.id+'>'+obj.name+'</option>');
		                	$("#chkshare").append("<label style='padding-left: 0px; padding-right: 20px;'><input type='checkbox' class='sharechk' id='chk"+obj.name+"'  value='"+obj.id+"' style='margin-left: 0px;'><label>"+obj.name+"</label></label>");
		                	if (obj.id == 3)
		                		$("#selpaidby option[value='3']").attr("selected", true);
	                	});
		             }
		        });
			}

			function loadItems() {
				$.ajax({
		             url:'expense_load.php',
		             method: 'GET',
		             data: {
		            	 action: 'getitems'
		             },
		             success:function(data) {
		            	var items = JSON.parse(data); 
		            	
		            	$('#selitems').append('<option value=0></option>');
		            	$.each(items, function(idx, obj) {
		                	$('#selitems').append('<option value='+obj.id+'>'+obj.name+'</option>');
		                });
		                
		                $('.combobox').combobox();
		             }
		         });
			}

			function submitTransaction() {
				var dt = document.getElementById("datepick").value;
				var pd = document.getElementById("selpaidby")[document.getElementById("selpaidby").selectedIndex].value;
				var itm = document.getElementById("selitems")[document.getElementById("selitems").selectedIndex].value;;
				var shr = $('.sharechk:checked').map(function() {
    									return $(this).next('label').text();
									}).get();
				var amt = document.getElementById("txtAmt").value;
				var txnid = document.getElementById("txtTxnId").value;
				
				var ajaxData = new Object();
				var res;

				if (!txnid) {
					ajaxData.action = "createtxn";
					ajaxData.date = dt;
					ajaxData.paid = pd;
					ajaxData.item = itm;
					ajaxData.share = shr;
					ajaxData.amount = amt;
					res = "Transaction Added Successfully!";
				} else {
					ajaxData.action = "edittxn";
					ajaxData.txnid = txnid;
					ajaxData.date = dt;
					ajaxData.paid = pd;
					ajaxData.item = itm;
					ajaxData.share = shr;
					ajaxData.amount = amt;
					res = "Transaction Modified Successfully!";
				}
				
				$.ajax({
		             url:'expense_submit.php',
		             method: 'GET',
		             data: ajaxData,
		             success:function(data) {
						if (data > 0) {
							loadTransactions();
							loadBalanceSheet();
		             		$('#btnClose').trigger("click");
				            $('.result').text(res);
				            $('.result').fadeIn(400).delay(3000).fadeOut(400);
				        }
			         }
	        	});
			}

			function deleteTransaction(txnid) {
				$.ajax({
		             url:'expense_submit.php',
		             method: 'GET',
		             data: {
						action: 'deletetxn',
						txnid: txnid
			         },
		             success:function(data) {
			             console.log(data);
						if (data > 0) {
							$('#btnNo').trigger("click");
							loadTransactions();
							loadBalanceSheet();
							$('.result').text("Transaction Deleted Successfully!");
				            $('.result').fadeIn(400).delay(3000).fadeOut(400);
				        }
			         }
	        	});
			}

			function convertDate(inputFormat) {
			    function pad(s) { 
				    return (s < 10) ? '0' + s : s; 
				}
			    var d = new Date(inputFormat);
			    return [pad(d.getDate()), pad(d.getMonth()+1), d.getFullYear()].join('/');
			}
	    	
			$(document).ready(function() {
				loadTransactions();
				loadBalanceSheet();
				
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
						loadBalanceSheetWithDates();
					});
				});

				tablerowclick();
				//modal
				
				var today = new Date();
				var dd = today.getDate();
				var mm = today.getMonth() + 1;
				var yyyy = today.getFullYear();
	
				if (dd < 10) {
					dd = '0' + dd
				}
				if (mm < 10) {
					mm = '0' + mm
				}
	
				var today = dd + '/' + mm + '/' + yyyy;
	
				$('#datepick').val(today);

				$('#datepick').datepicker({
					autoclose: true,
					format: "dd/mm/yyyy", 
				    endDate: maxDay
				});

				loadUsers();
				loadItems();

				$('#btnNew').click(function() {
					$('#modalTitle').text("Create New Transaction");
					$('#TxnId').css('display', 'none');

					document.getElementById("frmExpense").reset();
					$('#datepick').val(today);

					$("#selpaidby option").removeAttr('selected');
					$("#selpaidby option[value='3']").prop('selected', 'selected');

					$("#selitems option").removeAttr('selected');

					$(".sharechk").removeAttr('checked');
				});

				$('#btnEdit').click(function() {
					$('#modalTitle').text("Edit Transaction");
					$('#TxnId').css('display', 'block');

					$("#selpaidby option").removeAttr('selected');
					$("#selitems option").removeAttr('selected');
					$(".sharechk").removeAttr('checked');
					
					$('#txtTxnId').val(tableData[0]);
					$('#datepick').val(convertDate(tableData[1]));
					$("#selpaidby option:contains(" + tableData[2] + ")").prop('selected', 'selected');
					$("#selitems option:contains(" + tableData[3] + ")").prop('selected', 'selected');
					$('#txtitems').val(tableData[3]);
					$('#txtAmt').val(tableData[4].replace("₹ ",""));

					var chkData = tableData[5].split(",");
					for (var data in chkData) {
						$('input:checkbox[id=chk'+chkData[data]+']').prop('checked', 'checked');
					}
				});
				
		        $('#btnSave').click(function() {
			        submitTransaction();
				});

		        $('#btnYes').click(function() {
			        deleteTransaction(tableData[0]);
				});
		    });

		</script>
</body>
</html>
