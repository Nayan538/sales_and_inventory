<?php
#### CALLING CONTROLLER
include("app/Http/Controllers/Controller.php");
include("app/Http/Controllers/AdminController.php");

#### CALLING MODEL / QUERY BUILDER
include("app/Models/Eloquent.php");
$eloquent = new Eloquent;

$adminCtrl = new AdminController;

if( isset($_POST['try_login']) )
{
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	
	$adminData = $adminCtrl->tryLogin( $username, $password );
	
	if(!empty($adminData))
	{
		$_SESSION['SMC_login_time'] = date("Y-m-d H:i:s");
		$_SESSION['SMC_login_id'] = $adminData[0]['id'];
		$_SESSION['SMC_login_admin_name'] = $adminData[0]['admin_name'];
		$_SESSION['SMC_login_admin_email'] = $adminData[0]['admin_email'];
		$_SESSION['SMC_login_admin_image'] = $adminData[0]['admin_image'];
		$_SESSION['SMC_login_admin_status'] = $adminData[0]['admin_status'];
		$_SESSION['SMC_login_admin_type'] = $adminData[0]['admin_type'];
		
		header("Location: dashboard.php");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="ThemeBucket">
		<link rel="shortcut icon" href="#" type="image/png">
		
		<title>Admin Login | Super Market</title>
		
		<link href="public/css/style.css" rel="stylesheet">
		<link href="public/css/style-responsive.css" rel="stylesheet">
		
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
	
	<body class="login-body">
		
		<div class="container">
			
			<form class="form-signin" method="post" action="">
				<div class="form-signin-heading text-center">
					<h1 class="sign-title">Sign In</h1>
					<img src="public/images/login-logo.png" alt=""/>
				</div>
				<div class="login-wrap">
					<input name="username" type="email" class="form-control" placeholder="Email ID" >
					<input name="password" type="password" class="form-control" placeholder="Password" >
					
					<button name="try_login" class="btn btn-lg btn-login btn-block" type="submit">
						<i class="fa fa-check"></i>
					</button>
					
					</label>
					
				</div>
				
			
			</form>
		</div>
		
		
		
		<!-- Placed js at the end of the document so the pages load faster -->
		
		<!-- Placed js at the end of the document so the pages load faster -->
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/modernizr.min.js"></script>
		
	</body>
	
	<!-- Mirrored from adminex.themebucket.net/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 29 Sep 2015 19:56:16 GMT -->
</html>