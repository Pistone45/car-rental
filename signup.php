<?php
include ("includes/functions.php");
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
<script src="js/all.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Logo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Login</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="signup.php">Sign Up <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<br>
<div class="row container-fluid">
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="panel panel-success">
		  <div class="panel-heading"><h2 align="center">Register</h2></div>
<div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:50%">
    Step 1
  </div>
</div>
			<br>
		  <div class="panel-body">
		  		<form action="signup.php" method="post" role="form">
                <?php echo display_error();?>

          <div class="row">
            <div class="col">
            <input type="text" name="firstname" value="<?php echo $firstname; ?>" class="form-control" placeholder="First name">
            </div>
            <div class="col">
            <input type="text" name="lastname" value="<?php echo $lastname; ?>" class="form-control" placeholder="Last name">
            </div>
          </div>      
          <br>
				  <div class="form-group">
				    <input type="text" placeholder="Username" required="required" name="username" class="form-control" id="email" value="<?php echo $username; ?>">
				  </div>
				
          <div class="row">
            <div class="col">
            <input type="password" placeholder="Password" required="required" name="password_1" class="form-control" id="pwd">
            </div>
            <div class="col">
            <input type="password" placeholder="Confirm Password" required="required" name="password_2" class="form-control" id="pwd">
            </div>
          </div>
          <br>
				  <div class="form-group">
				    <input type="email" placeholder="Email" required="required" name="email" class="form-control" id="email" value="<?php echo $email; ?>">
				  </div>

          <div class="input-group mb-3">
          <select name="gender" class="custom-select" id="inputGroupSelect02">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            <div class="input-group-append">
              <label class="input-group-text" for="inputGroupSelect02">Gender</label>
            </div>
          </div>

				  <div class="form-group">
				    <input type="text" placeholder="Adress" required="required" name="address" class="form-control" id="address" value="<?php echo $address; ?>">
				  </div>
				  <button type="submit" name="signup" class="btn btn-outline-info btn-block"><span class="spinner-grow spinner-grow-sm"></span> Register <span class="spinner-grow spinner-grow-sm"></span></button>
				  <br>
<div class="alert alert-success">
 <a href="index.php">Already a user? Click here to login</a>
</div>
				</form>
		  </div>
		</div>
	</div>
	<div class="col-md-3"></div>
</div>
<?php
//include("includes/footer.php");
?>