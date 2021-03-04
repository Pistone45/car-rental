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
  <a class="nav-link active" id="v-pills-home-tab"href="index.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Summary</a>
  <a class="nav-link" id="v-pills-profile-tab" href="profile.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
  <a class="nav-link" id="v-pills-messages-tab" href="vehicles.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">Lend Vehicle</a>
  <a class="nav-link" id="v-pills-settings-tab" href="lent.php" role="tab" aria-controls="v-pills-settings" aria-selected="false">Lent Vehicles</a>
</div>
  </div>
  <div class="col-md-10">
    <div class="col-md-2"></div>
    <div class="col-md-8">

  <h3>Customers</h3>
  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="index.php">Messages</a>
  </li>
</ul>
<br>
    <div class="card border-dark mb-3">
  <div class="card-header">Messages</div>
  <div class="card-body text-dark">
    <h5 class="card-title">Here are messages from the Admin</h5>
    
     <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Message</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $id = $_SESSION['user']['id'];
                            $sql = "SELECT * FROM messages WHERE user_id = '$id'  ORDER BY time DESC";
                            $result = mysqli_query($db, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['message'];?></td>
                                        <td><?php echo $row['time'];?></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "You have no messages at the moment";
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

<?php

$date1 = strtotime("May 1, 2020");
$date2 = strtotime("+1 day", strtotime($date1));

echo $date2/86400;


//$secs = $date2 - $date1;
//echo $days = $secs / 86400;

?>

</body>