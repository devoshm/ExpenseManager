<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>SB Admin 2 - Bootstrap Admin Theme</title>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/sb-admin-2.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="font-awesome-4.1.0/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-panel panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Please Sign In</h3>
					</div>
					<div class="panel-body">
						<form role="form" method="post" action="index.php">
							<fieldset>
								<div id="divname" class="form-group">
									<input class="form-control" placeholder="Enter your username"
										name="txtname" id="txtname" type="text" autofocus>
								</div>
								<div id="divpwd" class="form-group">
									<input class="form-control" placeholder="Enter your password"
										name="txtpwd" id="txtpwd" type="password" value="">
								</div>
								<!-- Change this to a button or input when using this as a form -->
								<input type="submit" class="btn btn-lg btn-success btn-block"
									value="Login" name="btnlogin" id="btnlogin">
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery Version 1.11.0 -->
	<script src="js/jquery-1.11.0.js"></script>
	<script type="text/javascript">
	    $(document).ready(function() {
	
			$('#btnlogin').click(function() {
				
				var uname = document.getElementById("txtname").value;
				var pwd = document.getElementById("txtpwd").value;

				if(!uname) {
					$('#divname').addClass("has-error");
					return false;
				} else {
					$('#divname').removeClass();
					$('#divname').addClass("form-group");
				}

				if(!pwd) {
					$('#divpwd').addClass("has-error");
					return false;
				} else {
					$('#divpwd').removeClass();
					$('#divpwd').addClass("form-group");
				}
			});

		});
    </script>

	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="js/plugins/metisMenu/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="js/sb-admin-2.js"></script>

</body>

</html>
