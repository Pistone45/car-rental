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
      <a href="../index.php?logout='1'""><button class="btn btn-outline-success">Logout</button></a>
      <?php endif ?>
    </span>
  </div>
</nav><br>
<div class="row container-fluid">
<div class="col-md-2">
  <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link" id="v-pills-home-tab"href="index.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Authorize Customers</a>
  <a class="nav-link active" id="v-pills-profile-tab" href="profile.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
  <a class="nav-link" id="v-pills-messages-tab" href="vehicles.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">Vehicles</a>
</div>
  </div>
  
    <div class="col">
      <div class="card border-dark mb-3">
        <br>
      <div class="progress">
      <div class="progress-bar progress-bar-striped active" role="progressbar"
      aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">
        Step 2
  </div>
</div>
  <div class="card-header">Update</div>
  <div class="card-body text-dark">
    <h5 class="card-title">Update here:</h5>
         <?php echo display_error(); ?>
                                <?php
                                global $db, $errors;
                                $id =  $_SESSION['user']['id'];
                               // $stud_id = $_SESSION['user']['id'];
                                $query = "select * from users where id = '$id'";
                                $result = mysqli_query($db, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    // output data of each row
                                    $row = mysqli_fetch_assoc($result);
                                }
                                ?>
                                <form role="form" action="profile.php" method="post">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname" value="<?php echo $row['firstname']; ?>"required="required"></input>
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd"></label>
                                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname"value="<?php echo $row['lastname'];?>" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd"></label>
                                        <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="<?php echo $row['address'];?>" required="required">
                                    </div>
                                    <div class="form-group">
                                        <label for="pwd"></label>
                                        <input type="date" class="form-control" id="email" placeholder="Date of Birth" name="dob" value="<?php echo $row['dob'];?>" required="required">
                                    </div>
                                    <label class="radio-inline"><input type="radio" name="gender" value="male" required="required">Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female" required="required">Female</label>
                                    <br><br>
                                    <button name="update" class="btn btn-block btn-outline-primary"><span class="spinner-grow spinner-grow-sm"></span> Update <span class="spinner-grow spinner-grow-sm"></span></button>
                                </form>
  </div>
</div>
    </div>

    <div class="col">
    <div class="card border-dark mb-3">
  <div class="card-header">Check</div>
  <div class="card-body text-dark">
    <h5 class="card-title">See updates here:</h5>
                                    <div class="col-md-4"><label class="form-control">Firstname</label></div>
                                <div class="col-md-8">
                                    <label class="form-control"><?php echo $row['firstname']; ?></label>
                                </div>
                                <div class="col-md-4"><label class="form-control">Lastname</label></div>
                                <div class="col-md-8">
                                    <label class="form-control"><?php echo $row['lastname']; ?></label>
                                </div>
                                <div class="col-md-4"><label class="form-control">Birth Date</label></div>
                                <div class="col-md-8">
                                    <label class="form-control"><?php echo $row['dob']; ?></label>
                                </div>
                                <div class="col-md-4"><label class="form-control">Gender</label></div>
                                <div class="col-md-8">
                                    <label class="form-control"><?php echo $row['gender']; ?></label>
                                </div>
                                <div class="col-md-4"><label class="form-control">Address</label></div>
                                <div class="col-md-8">
                                    <label class="form-control"><?php echo $row['address']; ?></label>
                                </div>
  </div>
</div>
  </div>


</div>
</body>