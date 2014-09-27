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
						<li><a href="transactions.php"><i class="fa fa-table fa-fw"></i>
								Transactions</a></li>
						<li><a href="expense.php"><i class="fa fa-edit fa-fw"></i> Expense</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">Settings</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Manage Your Master Data</div>
						<div class="panel-body">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#users" data-toggle="tab">Users</a></li>
								<li><a href="#items" data-toggle="tab">Items</a></li>
							</ul>

							<div class="tab-content">
								<div class="tab-pane fade in active" id="users">
									<h4>Users List</h4>
									<p>
										<button class="btn btn-primary" type="button" id="btnNewUser"
											data-target="#modalTxnUser" data-toggle="modal">New</button>
										<button class="btn btn-warning" type="button" id="btnEditUser"
											data-target="#modalTxnUser" data-toggle="modal">Edit</button>
										<button class="btn btn-danger" type="button" id="btnDeleteUser"
											data-target="#modalDeleteUser" data-toggle="modal">Delete</button>
									</p>
									<div class='result' style='display: none'></div>

									<div id="modalTxnUser" class="modal fade" aria-hidden="true"
										aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
										style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button class="close" aria-hidden="true"
														data-dismiss="modal" type="button">x</button>
													<h4 class="modal-title" id="modalTitle-User"></h4>
												</div>
												<div class="modal-body">
													<form role="form" id="frmUser">
														<div class="form-group" id="UserId" style="display: none;">
															<label>User ID</label> 
															<input type="text" class="form-control" id="txtUserId" disabled="disabled">
														</div>
														<div class="form-group">
															<label>Name</label> 
															<input type="text" class="form-control" id="txtUserName">
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button class="btn btn-default" data-dismiss="modal"
														type="button" id="btnCloseUser">Close</button>
													<button class="btn btn-primary" type="button" id="btnSaveUser">Save
														changes</button>
												</div>
											</div>
										</div>
									</div>
									<div id="modalDeleteUser" class="modal fade" aria-hidden="true"
										aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
										style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button class="close" aria-hidden="true"
														data-dismiss="modal" type="button">x</button>
													<h4 class="modal-title">Delete User</h4>
												</div>
												<div class="modal-body">Are you sure of deleting this
													user?</div>
												<div class="modal-footer">
													<button class="btn btn-default" data-dismiss="modal"
														type="button" id="btnNoUser">No</button>
													<button class="btn btn-primary" type="button" id="btnYesUser">Yes</button>
												</div>
											</div>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover"
											id="dataTables-users">
											<thead>
												<tr>
													<th>User ID</th>
													<th>Name</th>
												</tr>
											</thead>
											<tbody id="tblUsers">
											</tbody>
										</table>
									</div>
								</div>
								<div class="tab-pane fade" id="items">
									<h4>Items List</h4>
									<p>
										<button class="btn btn-primary" type="button" id="btnNewItem"
											data-target="#modalTxnItem" data-toggle="modal">New</button>
										<button class="btn btn-warning" type="button" id="btnEditItem"
											data-target="#modalTxnItem" data-toggle="modal">Edit</button>
										<button class="btn btn-danger" type="button" id="btnDeleteItem"
											data-target="#modalDeleteItem" data-toggle="modal">Delete</button>
									</p>
									<div class='result' style='display: none'></div>

									<div id="modalTxnItem" class="modal fade" aria-hidden="true"
										aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
										style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button class="close" aria-hidden="true"
														data-dismiss="modal" type="button">x</button>
													<h4 class="modal-title" id="modalTitle-Item"></h4>
												</div>
												<div class="modal-body">
													<form role="form" id="frmItem">
														<div class="form-group" id="ItemId" style="display: none;">
															<label>Item ID</label> 
															<input type="text" class="form-control" id="txtItemId" disabled="disabled">
														</div>
														<div class="form-group">
															<label>Name</label> 
															<input type="text" class="form-control" id="txtItemName">
														</div>
													</form>
												</div>
												<div class="modal-footer">
													<button class="btn btn-default" data-dismiss="modal"
														type="button" id="btnCloseItem">Close</button>
													<button class="btn btn-primary" type="button" id="btnSaveItem">Save
														changes</button>
												</div>
											</div>
										</div>
									</div>
									<div id="modalDeleteItem" class="modal fade" aria-hidden="true"
										aria-labelledby="myModalLabel" role="dialog" tabindex="-1"
										style="display: none;">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button class="close" aria-hidden="true"
														data-dismiss="modal" type="button">x</button>
													<h4 class="modal-title">Delete Item</h4>
												</div>
												<div class="modal-body">Are you sure of deleting this
													item?</div>
												<div class="modal-footer">
													<button class="btn btn-default" data-dismiss="modal"
														type="button" id="btnNoItem">No</button>
													<button class="btn btn-primary" type="button" id="btnYesItem">Yes</button>
												</div>
											</div>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover"
											id="dataTables-items">
											<thead>
												<tr>
													<th>Item ID</th>
													<th>Name</th>
												</tr>
											</thead>
											<tbody id="tblItems">
											</tbody>
										</table>
									</div>
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
	<script src="js/plugins/dataTables/jquery.dataTables.js"></script>
	<script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>
	<script src="js/sb-admin-2.js"></script>
	<script src="js/bootbox.min.js"></script>

	<script type="text/javascript">
	    	var tblUserData;
	    	var tblItemData;

	    	function tablerowclick() {
	    		$("#tblUsers").on('click', 'tr', function() {
					if ($(this).hasClass("selected")) {
				    	$(this).removeClass("selected");
				    	$('#btnEditUser').addClass("disabled");
				    	$('#btnDeleteUser').addClass("disabled");
					} else {
						$("#tblUsers tr").removeClass("selected");
						$(this).addClass("selected");
						$('#btnEditUser').removeClass("disabled");
				    	$('#btnDeleteUser').removeClass("disabled");
					}
					tblUserData = $(this).children("td").map(function() {
				        return $(this).text();
				    }).get();
				});

	    		$("#tblItems").on('click', 'tr', function() {
					if ($(this).hasClass("selected")) {
				    	$(this).removeClass("selected");
				    	$('#btnEditItem').addClass("disabled");
				    	$('#btnDeleteItem').addClass("disabled");
					} else {
						$("#tblItems tr").removeClass("selected");
						$(this).addClass("selected");
						$('#btnEditItem').removeClass("disabled");
				    	$('#btnDeleteItem').removeClass("disabled");
					}
					tblItemData = $(this).children("td").map(function() {
				        return $(this).text();
				    }).get();
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

		            	$('#dataTables-users').dataTable().fnDestroy();
			    		$('#tblUsers').empty();
			    		$('#btnEditUser').addClass("disabled");
				    	$('#btnDeleteUser').addClass("disabled");

		             	$.each(users, function(idx, obj) {
		                	$('#tblUsers').append("<tr><td>"+obj.id+"</td><td>"+obj.name+"</td></tr>");
		                });
		                
		             	$('#dataTables-users').dataTable();
		             	tablerowclick();
		             }
		        });
	    	}

	    	function submitUser() {
				var name = document.getElementById("txtUserName").value;
				var userid = document.getElementById("txtUserId").value;
				
				var ajaxData = new Object();
				var res;

				if (!userid) {
					ajaxData.action = "createuser";
					ajaxData.name = name;
					res = "User Added Successfully!";
				} else {
					ajaxData.action = "edituser";
					ajaxData.userid = userid;
					ajaxData.name = name;
					res = "User Modified Successfully!";
				}
				
				$.ajax({
		             url:'settings_submit.php',
		             method: 'GET',
		             data: ajaxData,
		             success:function(data) {
			            if (data > 0) {
							loadUsers();
							$('#btnCloseUser').trigger("click");
				            $('.result').text(res);
				            $('.result').fadeIn(400).delay(3000).fadeOut(400);
				        } else {
				        	$('#btnCloseUser').trigger("click");
				        	bootbox.confirm({
				        	    title: 'Warning!',
				        	    message: 'The name you entered already exists in the database <b>(Name in DB: '+ data +')</b>.<br/>Click YES to keep using the existing one or NO to add a new record.',
				        	    buttons: {
				        	        'cancel': {
				        	            label: 'No',
				        	            className: 'btn-default'
				        	        },
				        	        'confirm': {
				        	            label: 'Yes',
				        	            className: 'btn-primary'
				        	        }
				        	    },
				        	    callback: function(result) {
				        	    	$.ajax({
				        	    		 url:'settings_submit.php',
					   		             method: 'GET',
					   		             data: {
											action: 'createuser',
											subaction: result,
											name: name
						   		         },
					   		             success: function(data) {
						   		             loadUsers();
						   		             $('.result').text(res);
									         $('.result').fadeIn(400).delay(3000).fadeOut(400);
					   		             }
					        	    });
				        	    }
				        	});
				        }
			         }
	        	});
			}

			function deleteUser(userid) {
				$.ajax({
		             url:'settings_submit.php',
		             method: 'GET',
		             data: {
						action: 'deleteuser',
						userid: userid
			         },
		             success:function(data) {
			             if (data > 0) {
							 $('#btnNoUser').trigger("click");
							 loadUsers();
							 $('.result').text("User Deleted Successfully!");
				             $('.result').fadeIn(400).delay(3000).fadeOut(400);
				         }
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

		            	$('#dataTables-items').dataTable().fnDestroy();
			    		$('#tblItems').empty();
			    		$('#btnEditItem').addClass("disabled");
				    	$('#btnDeleteItem').addClass("disabled");

		             	$.each(items, function(idx, obj) {
		                	$('#tblItems').append("<tr><td>"+obj.id+"</td><td>"+obj.name+"</td></tr>");
		                });
		                
		             	$('#dataTables-items').dataTable();
		             	tablerowclick();
		             }
		        });
	    	}

			function submitItem() {
				var name = document.getElementById("txtItemName").value;
				var itemid = document.getElementById("txtItemId").value;
				
				var ajaxData = new Object();
				var res;

				if (!itemid) {
					ajaxData.action = "createitem";
					ajaxData.name = name;
					res = "Item Added Successfully!";
				} else {
					ajaxData.action = "edititem";
					ajaxData.itemid = itemid;
					ajaxData.name = name;
					res = "Item Modified Successfully!";
				}
				
				$.ajax({
		             url:'settings_submit.php',
		             method: 'GET',
		             data: ajaxData,
		             success:function(data) {
			            if (data > 0) {
							loadItems();
							$('#btnCloseItem').trigger("click");
				            $('.result').text(res);
				            $('.result').fadeIn(400).delay(3000).fadeOut(400);
				        } else {
				        	$('#btnCloseItem').trigger("click");
				        	bootbox.confirm({
				        	    title: 'Warning!',
				        	    message: 'The name you entered already exists in the database <b>(Name in DB: '+ data +')</b>.<br/>Click YES to keep using the existing one or NO to add a new record.',
				        	    buttons: {
				        	        'cancel': {
				        	            label: 'No',
				        	            className: 'btn-default'
				        	        },
				        	        'confirm': {
				        	            label: 'Yes',
				        	            className: 'btn-primary'
				        	        }
				        	    },
				        	    callback: function(result) {
				        	    	$.ajax({
				        	    		 url:'settings_submit.php',
					   		             method: 'GET',
					   		             data: {
											action: 'createitem',
											subaction: result,
											name: name
						   		         },
					   		             success: function(data) {
						   		             loadItems();
						   		             $('.result').text(res);
									         $('.result').fadeIn(400).delay(3000).fadeOut(400);
					   		             }
					        	    });
				        	    }
				        	});
				        }
			         }
	        	});
			}

			function deleteItem(itemid) {
				$.ajax({
		             url:'settings_submit.php',
		             method: 'GET',
		             data: {
						action: 'deleteitem',
						itemid: itemid
			         },
		             success:function(data) {
			             if (data > 0) {
							 $('#btnNoItem').trigger("click");
							 loadItems();
							 $('.result').text("Item Deleted Successfully!");
				             $('.result').fadeIn(400).delay(3000).fadeOut(400);
				         }
			         }
	        	});
			}
	    	
			$(document).ready(function() {
				loadUsers();
				loadItems();

				tablerowclick();
				
				//modal
				//Users
				$('#btnNewUser').click(function() {
					$('#modalTitle-User').text("Create New User");
					$('#UserId').css('display', 'none');
					
					$('#frmUser')[0].reset();
				});

				$('#btnEditUser').click(function() {
					$('#modalTitle-User').text("Edit User");
					$('#UserId').css('display', 'block');
					
					$('#txtUserId').val(tblUserData[0]);
					$('#txtName').val(tblUserData[1]);
				});
				
		        $('#btnSaveUser').click(function() {
			        submitUser();
				});

		        $('#btnYesUser').click(function() {
			        deleteUser(tblUserData[0]);
				});

				//Items
		        $('#btnNewItem').click(function() {
					$('#modalTitle-Item').text("Create New Item");
					$('#ItemId').css('display', 'none');
					
					$('#frmItem')[0].reset();
				});

				$('#btnEditItem').click(function() {
					$('#modalTitle-Item').text("Edit Item");
					$('#ItemId').css('display', 'block');
					
					$('#txtItemId').val(tblItemData[0]);
					$('#txtName').val(tblItemData[1]);
				});
				
		        $('#btnSaveItem').click(function() {
			        submitItem();
				});

		        $('#btnYesItem').click(function() {
			        deleteItem(tblItemData[0]);
				});
		    });

		</script>
</body>
</html>
