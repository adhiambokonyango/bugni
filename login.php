<?php 
session_start();

require_once('inc/config.php');

if(isset($_POST['login']))
{
	if(!empty($_POST['email']) && !empty($_POST['password']))
	{
		$email 		= trim($_POST['email']);
		$password 	= trim($_POST['password']);
		
		$md5Password = md5($password);
		
		$sql = "select * from tbl_users where email = '".$email."' and password = '".$md5Password."'";
		$rs = mysqli_query($conn,$sql);
		$getNumRows = mysqli_num_rows($rs);
		
		if($getNumRows == 1)
		{
			$getUserRow = mysqli_fetch_assoc($rs);
			unset($getUserRow['password']);
			
			$_SESSION = $getUserRow;
						
			header('location:dashboard.php');
			exit;
		}
		else
		{
			$errorMsg = "Wrong email or password";
		}
	}
}

if(isset($_GET['logout']) && $_GET['logout'] == true)
{
	session_destroy();
	header("location:index.php");
	exit;
}


if(isset($_GET['lmsg']) && $_GET['lmsg'] == true)
{
	$errorMsg = "Login required to access dashboard";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="dist/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
 <!--  <link href="assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> -->
    <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Custom styles for this template-->
<!--   <link href="assets/css/sb-admin.css" rel="stylesheet"> -->
<!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
</head>

<body class="bg-dark">
  <div class="container">
  			<div class="col-sm-6 col-sm-offset-3" style="top: -50%">
  <div class = "panel panel-default">
   <div class = "panel-heading">
      <h3 class = "panel-title">Sign in</h3>
   </div>
   
   <div class = "panel-body">
      <?php 
			if(isset($errorMsg))
			{
				echo '<div class="alert alert-danger">';
				echo $errorMsg;
				echo '</div>';
				unset($errorMsg);
			}
		?>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" name="email" type="email" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" name="password" type="password" placeholder="Password" required>
          </div>
          <button class="btn btn-success btn-block" type="submit" name="login"><span class="glyphicon glyphicon-log-in"></span>   Login</button>
        </form>

   </div>
</div>
</div>
  </div> <!-- container -->

  <!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
  <!-- Bootstrap core JavaScript-->
<!--   <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> -->
  <!-- Core plugin JavaScript-->
<!--   <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script> -->
</body>

</html>
