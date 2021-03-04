<?php
include ("../includes/functions.php");
if (!isCustomer()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../index.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location:../index.php");
}

if (isset($_POST['verify'])) {

$transaction_id = $_POST['transaction_id'];
$user_id = $_SESSION['user']['id'];

$sql = "UPDATE payments SET transaction_id = '$transaction_id' WHERE user_id='$user_id'";

if (mysqli_query($db, $sql)) {
    echo '<script type="text/javascript">alert("Payment successfull. Wait for Approval!");window.location=\'lent.php\';</script>';
} else {
    echo '<script type="text/javascript">alert("Payment Failed!");window.location=\'vehicles.php\';</script>';
}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Success</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/all.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">PREMIER</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">DASHBOARD<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <span class="navbar-text">
      <?php if (isset($_SESSION['user'])) : ?>
      <?php echo $_SESSION['user']['username'];?> (<?php echo ucfirst($_SESSION['user'] ['user_type'] ); ?>) 
      <a href="../index.php?logout='1'"><button class="btn btn-outline-success">Logout</button></a>
      <?php endif ?>
    </span>
  </div>
</nav>
<br>
<!--
       <div class="toast" data-autohide="false">
    <div class="toast-header">
      <strong class="mr-auto text-primary">Welcome</strong>
      <small class="text-muted">0 seconds ago</small>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">
      <?php echo "Welcome ".$_SESSION['user']['username']; ?>
    </div>
  </div>

  <script>
$(document).ready(function(){
  $('.toast').toast('show');
});
</script><br>
-->
<div class="container">
  <div class="row">
    <div class="col-sm-2">
      
    </div>
    <div class="col-sm-8">
      <div class="alert alert-success">
  <strong>  <h3>One More Step</h3>
    <h5>Now all you need to do is enter the transaction ID to verify Payment</h5>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Transaction ID</label>
    <input required="required" type="text" name="transaction_id" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter ID">
  </div>
  <button type="submit" name="verify" class="btn btn-primary">Submit ID</button>
</form>

<br></strong>
<br>
<h6>Click <a href="lent.php">here</a> to view your rented vehicles</h6>
</div>
    
    </div>
    <div class="col-sm-2">
      
    </div>
  </div>
</div>

</body>