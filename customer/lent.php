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

$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];

$sql = "SELECT * FROM payments WHERE username = '$username'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $date_taken = $row["date_taken"];
    }
} else {
    echo "No results";
}

$date = date("Y-m-d");

$query = "UPDATE payments SET date_taken = '$date' WHERE username = '$username'";
$result = mysqli_query($db, $query);

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
<div class="row container-fluid">
  <div class="col-md-2">
<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link" id="v-pills-home-tab"href="index.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Summary</a>
  <a class="nav-link" id="v-pills-profile-tab" href="profile.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
  <a class="nav-link" id="v-pills-messages-tab" href="vehicles.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">Lend Vehicle</a>
  <a class="nav-link active" id="v-pills-settings-tab" href="lent.php" role="tab" aria-controls="v-pills-settings" aria-selected="false">Lent Vehicles</a>
</div>
  </div>
  <div class="col-md-10">
    <div class="col-md-2"></div>
    <div class="col-md-8">

  <h3>See the Vehicles you have rented here:</h3>
<br>
<?php
$sql = "SELECT * FROM payments WHERE user_id = '$id' AND verified = 1";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    ?>
    <div class="card border-dark mb-3">
  <div class="card-header">Vehicles</div>
  <div class="card-body text-dark">
    <h5 class="card-title">Here are the vehicles you have rented</h5>
    
     <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Vehicle Name</th>
                                <th>Time Rented</th>
                                <th>Due Date</th>
                                <th>Price</th>
                                <th>Days Remaining</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM payments WHERE user_id = '$id'";
                            $result = mysqli_query($db, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                  $date_taken = $row['date_taken'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['vehicle_name'];?></td>
                                        <td><?php echo $row['time'];?></td>
                                        <td><?php echo $due_date = $row['due_date'];?></td>
                                        <td><?php echo $row['price'];?></td>
                                        <td>
                                        <?php
                                        $date_taken = strtotime($date_taken);
                                        $due_date = strtotime($due_date);

                                        $secs = $due_date - $date_taken;
                                        echo $days = $secs / 86400;


                                        ?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "You have not rented any vehicle";
                            }
                            ?>

                        </tbody>
                    </table>

  </div>
</div>

    <div class="col-md-3"></div>
  </div>
</div>
</div>
<script type="text/javascript">
  alertify.set('notifier','position', 'bottom-right');

</script>
<a href=""></a>
<?php
$username = $_SESSION['user']['username'];
echo '<script language="javascript">alertify.success("Welcome Customer")</script>';

  ?>
</script>
</body><?

} else {
    echo "No rented vehicles were found ". '<a href="vehicles.php">Click here to rent a vehicle</a>';
}


?>
