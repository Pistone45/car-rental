<?php include('includes/functions.php');
error_reporting(E_ALL ^ E_DEPRECATED);
error_reporting(E_ERROR | E_PARSE);

$customer_id = $_GET['id'];

$query = "UPDATE users SET authorized = 1 WHERE id = '$customer_id'";
$result = mysqli_query($db, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css"/>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
        <script src="https://www.google.com/recaptcha/api.js?render=6Ld2VqAUAAAAAOppSnyr97DIm-z8849xiyst7tsG"></script>
    <script>
        grecaptcha.ready(function () {
            grecaptcha.execute('6Ld2VqAUAAAAAOppSnyr97DIm-z8849xiyst7tsG', { action: 'contact' }).then(function (token) {
                var recaptchaResponse = document.getElementById('recaptchaResponse');
                recaptchaResponse.value = token;
            });
        });
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Logo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="">Login <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="signup.php">Sign Up</a>
      </li>
    </ul>
  </div>
</nav>
<br>

<div class="row container-fluid">
	<div class="col-md-3"></div>
	<div class="col-md-6">

		<div class="panel panel-success">
		<div class="panel-heading"><h2 align="center">Login</h2></div>
		  <div class="panel-body">
				<form action="index.php" method="post" role="form">
                <?php echo display_error();?>
				  <div class="form-group">
				    <input type="text" placeholder="Username" required="required" name="username" class="form-control" id="email">
				  </div>
				  <div class="form-group">
				    <input type="password" placeholder="Password" required="required" name="password" value="" id="myInput" class="form-control">
				  </div>
				  <div class="checkbox">
				    <input type="checkbox" onclick="myFunction()">Show Password
				  </div>
				  <button type="submit" name="login" class="btn btn-outline-success btn-block"> <span class="spinner-grow spinner-grow-sm"></span> Login <span class="spinner-grow spinner-grow-sm"></span></button>
				</form>
		  </div>
		  <div class="panel-footer">Unverified accounts cant log in</div>
      <br>
<div class="alert alert-success">
 <a href="signup.php">Don't have an account? Click here to Register</a>
</div>

		</div>
	</div>
	<div class="col-md-3"></div>
  </div>

<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>

<!--
<input type="password" id="pass" value="password"/>
<button onclick="if (pass.type == 'text') pass.type = 'password';
else pass.type = 'text';">toggle</button>
--->

<br><br><br>
<?php
//include("includes/footer.php");
?>