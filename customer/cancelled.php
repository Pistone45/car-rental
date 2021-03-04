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

$username = $_SESSION['user']['username'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $userid = $row["id"];
    }
} else {
    echo "No results";
}

$sql = "DELETE FROM payments WHERE user_id = '$userid' ORDER BY time DESC LIMIT 1";
$result = mysqli_query($db, $sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payment Cancelled</title>
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
  <a class="navbar-brand" href="#">ADD</a>
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
      <a href="../index.php?logout='1'""><button class="btn btn-outline-success">Logout</button></a>
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
    <div class="col-sm">
      
    </div>
    <div class="col-sm">
      <div class="alert alert-danger">
  <strong>  <h3>Payment Cancelled</h3>
<br></strong>
<br>
<h6>Click <a href="vehicles.php">here</a> to view vehicles</h6>
</div>
    
    </div>
    <div class="col-sm">
      
    </div>
  </div>
</div>
<script type="text/javascript">
  alertify.set('notifier','position', 'bottom-right');

</script>

<?php
$username = $_SESSION['user']['username'];
echo '<script language="javascript">alertify.success("Welcome Customer")</script>';

  ?>
</script>
</body>