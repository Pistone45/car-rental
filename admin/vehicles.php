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
        <a class="nav-link" href="index.php">DASHBOARD<span class="sr-only">(current)</span></a>
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
<br>
    <div class="col-6 col-sm-2">
<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
  <a class="nav-link" id="v-pills-home-tab"href="index.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Authorize Customers</a>
  <a class="nav-link" id="v-pills-profile-tab" href="profile.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
  <a class="nav-link active" id="v-pills-messages-tab" data-toggle="pill" href="vehicles.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">vehicles</a>
</div>
  </div>

<div class="col-6 col-sm-5">
    <div class="card border-dark mb-3">
  <div class="card-header">TOYOTA PRIUS</div>
  <div class="card-body text-dark">
    <h5 class="card-title">
      <!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal">
  Specs
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Specifications</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Four Wheel drive</p><hr>
        <p>Engine: 71-HP</p><hr>
        <p>Steering: Hydrostatic power</p><hr>
        <p>Fuel Type: Turbo charged diesel</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<button type="button" class="btn btn-dark">
  In Stock <span class="badge badge-light">
    <?php

$sql = "SELECT * FROM vehicles WHERE vehicle_name = 'TOYOTA'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     echo $count = $row["count"];
    }
} else {
    echo "No results";
}


    ?>
</span>
</button>

    </h5>
    <img src="../images/toyota.jpg" width="300" height="250">
    <input type="text" class="form-control" hidden="hidden" value="<?php echo "TOYOTA"; ?>" name="vehicle_name" id="vehicle_name">
    

  </div>
</div>

  </div>
  <div class="col-6 col-sm-5">
    <div class="card border-dark mb-3">
  <div class="card-header">NISSAN MICRA</div>
  <div class="card-body text-dark">
    <h5 class="card-title">
      <!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal2">
  Specs
</button>

<!-- The Modal -->
<div class="modal" id="myModal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Specifications</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Four wheel drive</p><hr>
        <p>Fuel Type: Diesel</p><hr>
        <p>Steering: Rack and Pinion</p><hr>
        <p>Engine: 60-HP</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<button type="button" class="btn btn-dark">
  In Stock <span class="badge badge-light">
    <?php

$sql = "SELECT * FROM vehicles WHERE vehicle_name = 'NISSAN'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     echo $count = $row["count"];
    }
} else {
    echo "No results";
}


    ?>
</span>
</button>

    </h5>
    <img src="../images/nissan.jpg" width="300" height="250">
    <input type="text" class="form-control" hidden="hidden" value="<?php echo "NISSAN"; ?>" name="vehicle_name" id="vehicle_name">

  
  </div>
</div>
  </div>
  <br>

</div>

<div class="row container-fluid">
<div class="col-6 col-sm-2"></div>
  <div class="col-6 col-sm-5">
  <div class="card border-dark mb-3">
  <div class="card-header">CHEVROLET</div>
  <div class="card-body text-dark">
    <h5 class="card-title">
      <!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal3">
  Specs
</button>

<!-- The Modal -->
<div class="modal" id="myModal3">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Specifications</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Two wheel drive</p><hr>
        <p>Fuel Type: Diesel</p><hr>
        <p>Engine: 40-HP</p><hr>
        <p>Steering: Articulating</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<button type="button" class="btn btn-dark">
  In Stock <span class="badge badge-light">
    <?php

$sql = "SELECT * FROM vehicles WHERE vehicle_name = 'CHEVROLET'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     echo $count = $row["count"];
    }
} else {
    echo "No results";
}


    ?>
</span>
</button>

    </h5>
    <img src="../images/chevrolet.jpg" width="300" height="250">
    <input type="text" class="form-control" hidden="hidden" value="<?php echo "CHEVROLET"; ?>" name="vehicle_name" id="vehicle_name">
  </div>
</div>
  </div>

  <div class="col-6 col-sm-5">
    <div class="card border-dark mb-3">
  <div class="card-header">CITROEN</div>
  <div class="card-body text-dark">
    <h5 class="card-title">
      <!-- Button to Open the Modal -->
<button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal4">
  Specs
</button>

<!-- The Modal -->
<div class="modal" id="myModal4">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Specifications</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p>Four whee drive</p><hr>
        <p>Fuel Type: Diesel</p><hr>
        <p>Engine: Power steering</p><hr>
        <p>Engine: 78-HP</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<button type="button" class="btn btn-dark">
  In Stock <span class="badge badge-light">
    <?php

$sql = "SELECT * FROM vehicles WHERE vehicle_name = 'CITROEN'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     echo $count = $row["count"];
    }
} else {
    echo "No results";
}


    ?>
</span>
</button>


    </h5>
    <img src="../images/citroen.jpg" width="300" height="250">
    <input type="text" class="form-control" hidden="hidden" value="<?php echo "CITROEN"; ?>" name="vehicle_name" id="vehicle_name">
  </div>
</div>
  </div>
</div>



<a href="#" class="float">
  <i class="fa fa-plus my-float"></i>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal72">
  + Add
</button>
</a>

<!-- The Modal -->
<div class="modal" id="myModal72">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add a Vehicle</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form action="add.php" method="post">
          <div class="form-group">
            <label for="usr">Group:</label>
              <div class="form-group">
  <label>Select Vehicle to Add:</label>
                <select name="vehicle_name" class="form-control">
              <?php  
              $sql = "SELECT DISTINCT * FROM vehicles";
              $result = mysqli_query($db, $sql);
              if (mysqli_num_rows($result) > 0) {
                  // output data of each row
                  while($row = mysqli_fetch_assoc($result)) {
                      ?><option><?echo $row["vehicle_name"];?></option><?
                  }
              } else {
                  echo "No Vehicles";
              }
              ?>
                </select>
              </div>

          </div>
          <div class="form-group">
            <label for="pwd">Quantity</label>
            <input type="number" placeholder="e.g 2" class="form-control" id="pwd" name="quantity">
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<style type="text/css">
  *{padding:0;margin:0;}

body{
  font-family:;
  font-size:;
  background-color:;
}

.float{
  position:fixed;
  width:60px;
  height:60px;
  bottom:40px;
  right:40px;
  background-color:#0C9;
  color:#FFF;
  border-radius:50px;
  text-align:center;
  box-shadow: 2px 2px 3px #999;
}

.my-float{
  margin-top:22px;
}
</style>

</body>