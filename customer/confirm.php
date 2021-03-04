<?php
include ("../includes/functions.php");
error_reporting(E_ALL ^ E_DEPRECATED);
if (!isCustomer()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location:../login.php");
}


// connect to database
$driver_name = $_POST['driver_name'];
$vehicle_name = $_POST['vehicle_name'];
$date_taken = strtotime($_POST['date']);
$date_taken1 = $_POST['date'];
$username = $_SESSION['user']['username'];

//$due_date = strtotime("+1 month", strtotime($new));

//$due_date = strtotime("%Y-%M-%D", strtotime("$date_taken +1 day"));

$new_date = date("Y-m-d", strtotime("+1 month", $date_taken));


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

  $query = "INSERT INTO payments (user_id, username, vehicle_name, date_taken, due_date)
   VALUES('$userid', '$username', '$vehicle_name', '$date_taken1', '$new_date')";
   $result = mysqli_query($db, $query);

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

$answer = $count - 1;

$sql = "UPDATE vehicles SET count ='$answer' WHERE vehicle_name ='$vehicle_name'";
$result = mysqli_query($db, $sql);

$sql = "UPDATE drivers SET taken ='yes' WHERE driver_name ='$driver_name'";
$result = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css"/>
  <script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
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
</nav><br>


<div class="row container-fluid">
  <div class="col-6 col-sm-3"></div>

  <div class="col-6 col-sm-6">
    <div class="card border-dark mb-3">
  <div class="card-header"><?php echo $vehicle_name;  ?></div>
  <div class="card-body text-dark">

<div class="alert alert-success" role="alert">
      <h5 class="card-title">You have requested <?php echo $vehicle_name;  ?>. Click pay or Cancel the request</h5>
      <br>
      <h5>Send the money to this number: 0882550227</h5>
</div>

<a href="success.php"><button type="button" class="btn btn-outline-secondary">Pay Now</button></a>
<br>

    <br>

<form action="cancel.php">
    <input type="text" class="form-control" hidden="hidden" value="<?php echo "$vehicle_name"; ?>" name="vehicle_name" id="vehicle_name">
  <button class="btn btn-outline-danger">Cancel</button>
</form>
  </div>
</div>
  </div>

  <div class="col-6 col-sm-3"></div>
</div>
</body>