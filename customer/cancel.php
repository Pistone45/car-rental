<?php
include ("../includes/functions.php");
if (!isCustomer()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location:../login.php");
}


$vehicle_name = $_GET['vehicle_name'];
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


$sql = "SELECT * FROM vehicles WHERE vehicle_name = '$vehicle_name'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    $count = $row["count"];
    }
} else {
    echo "No results";
}

$answer = $count + 1;

$sql = "UPDATE vehicles SET count ='$answer' WHERE vehicle_name ='$vehicle_name'";
$result = mysqli_query($db, $sql);


?>
<!DOCTYPE html>
<html>
<head>
  <title>Payment Cancelled</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
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
</nav><br>

<div class="row container-fluid">
  <div class="col-6 col-sm-3"></div>
  <div class="col-6 col-sm-6">
    <div class="alert alert-danger" role="alert">
  <p>Payment cancelled</p>
</div>

<div class="alert alert-success" role="alert">
<a href="vehicles.php"><button class="btn btn-outline-success">Home Page</button></a>
</div>
  </div>
  <div class="col-6 col-sm-3"></div>
</div>
</body>
</html>