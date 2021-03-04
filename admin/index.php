<?php
include ("../includes/functions.php");
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location:../login.php");
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
        <a class="nav-link" href="#">Dashboard<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="drivers.php">Drivers</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="pdf.php">PDF Reports</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="reports.php">Graph Reports</a>
        </div>
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
  <div class="col-md-2">
  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link active" id="v-pills-home-tab"href="index.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Customers/Users</a>
  <a class="nav-link" id="v-pills-profile-tab" href="profile.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
  <a class="nav-link" id="v-pills-messages-tab" href="vehicles.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">Vehicles</a>
</div>
  </div>
  <div class="col-md-10">
    <div class="col-md-2"></div>
    <div class="col-md-8">

  <h3>Customers</h3>
  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="index.php">Delete a Customer</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="verify.php">Verify Payment</a>
  </li>
</ul>

  <br>
                              <div class="panel panel-success">
                          <div class="panel-heading">Customers</div>
                          <div class="panel-body">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM users WHERE user_type = 'customer' ORDER BY firstname DESC";
                            $result = mysqli_query($db, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['firstname'];?></td>
                                        <td><?php echo $row['lastname'];?></td>
                                        <td><a href="delete.php?customer_id=<?php echo $row['id']; ?>"><button type="button" class="btn btn-danger btn-xs">Delete</button></a></td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "No Customers at the moment";
                            }
                            ?>

                        </tbody>
                    </table>
                          </div>
                        </div>
    <div class="col-md-2"></div>
  </div>
</div>