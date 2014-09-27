<!DOCTYPE html>
<html lang="en">

	<head>
	
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<title>Expense Manager</title>
		
		<link rel="stylesheet" href="css/datepicker.css">
		<link rel="stylesheet" href="css/bootstrap-combobox.css">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<link href="css/sb-admin-2.css" rel="stylesheet">
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
					<li class="dropdown"><a class="dropdown-toggle"
						data-toggle="dropdown" href="#"> 
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
								<a href="index.php"><i	class="fa fa-user fa-fw"></i> Devosh Mathivanan</a>
							</li>
							<li>
								<a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
							</li>
							<li>
								<a href="transactions.php"><i class="fa fa-table fa-fw"></i> Transactions</a>
							</li>
							<li>
								<a class="active" href="expense.php"><i class="fa fa-edit fa-fw"></i> Expense</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
	
			<div id="page-wrapper">
				<div class="row">
					<div class="col-lg-12">
						<h1 class="page-header">Today's Expense</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-8">
						<div class="panel panel-default">
							<div class="panel-heading">Enter your expense here...</div>
							<div class="panel-body">
								<div class="row">
									<div class="col-lg-8">
										<form role="form">
											<div class="form-group">
												<label>Date</label>
												<div class="input-append date" id="datepicker"
													data-date-format="dd-mm-yyyy">
													<input size="16" type="text" id="datepick" readonly="readonly" class="span2">
													<span class="add-on"><i class="icon-calendar"> </i></span>
												</div>
											</div>
											<div class="form-group">
												<label>Paid By</label> 
												<select class="form-control" id="selpaidby">
												</select>
											</div>
											<div class="form-group">
												<label>Item Name</label> 
												<select class="form-control combobox" id="selitems">
												</select>
											</div>
											<div class="form-group">
												<label>Shared By</label>
												<div class="checkbox" id="chkshare"></div>
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon">₹</span> 
												<input type="text" class="form-control" id="btnAmt">
											</div>
											<div id="result"></div>
											<button class="btn btn-outline btn-success col-lg-7"
												type="button" style="margin-right: 8%" id="btnSubmit">Submit</button>
											<button class="btn btn-outline btn-warning col-lg-4"
												type="reset" id="btnReset">Reset</button>
										</form>
									</div>
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
		<script src="js/sb-admin-2.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function() {

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
				var maxDay = new Date();
				
				$('#datepick').val(today);
	
				$('#datepick').datepicker({
					autoclose: true,
					format: "dd/mm/yyyy", 
				    endDate: maxDay
				});
				
				$('#btnSubmit').click(function() {
					var dt = document.getElementById("datepick").value;
					var pd = document.getElementById("selpaidby")[document.getElementById("selpaidby").selectedIndex].value;
					var itm = document.getElementById("selitems")[document.getElementById("selitems").selectedIndex].value;;
					var shr = $('.sharechk:checked').map(function() {
	    									return $(this).next('label').text();
										}).get();
					var amt = document.getElementById("btnAmt").value;
	
					$.ajax({
			             url:'expense_submit.php',
			             method: 'GET',
			             data: {
			            	 action: 'createtxn',
			            	 date: dt,
			            	 paid: pd,
			            	 item: itm,
			            	 share: shr,
			            	 amount: amt
			             },
			             success:function(data) {
				            if (data == 1) {
					            $('#btnReset').trigger("click");
			             		$('#result').css('display', 'block');
			             		document.getElementById("result").innerHTML = "<p class='text-success'>Successfully Added.</p>";
								$('#datepick').val(dt);
								$('#selpaidby').prop('selectedIndex',pd-1);
								$('#txtitems').focus();
								$('#result').delay(3000).fadeOut();
			             	} else {
			             		$('#result').append("<p class='text-danger'>Operation Failed. Please try again.</p>");
			             		$('#result').delay(3000).fadeOut();
			             	}	
			             }
		        	});
				});
				
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
		                	$("#chkshare").append("<input type='checkbox' class='sharechk' value="+obj.id+" style='margin-left: 0px;'><label style='padding-left: 15px; padding-right: 10px;'>"+obj.name+"</label>");
		                	if (obj.id == 3)
		                		$("#selpaidby option[value='3']").attr("selected", true);
	                	});
		             }
		        });
		        
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
		    });
		</script>
	</body>
</html>
