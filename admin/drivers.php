<?php
include "../includes/functions.php";
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location:../login.php");
}              

if (isset($_POST['new_driver'])) {
    
  $driver_name = $_POST['driver_name'];
  $taken = $_POST['taken'];

  $query = "INSERT INTO drivers (driver_name, taken)
  VALUES('$driver_name', '$taken')";
  $result = mysqli_query($db, $query);

  if ($query) {
    header('location: drivers.php');
  }

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
<script src="../js/chartjs/Chart.bundle.js"></script>
        <script src="../js/chartjs/utils.js"></script>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script src="../js/bootstrap-select.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/css.css">
        <script src="../js/jquery.min.js"></script>
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">Dashboard<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="drivers.php">Drivers</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reports.php">Reports</a>
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
  <div class="col-6 col-md-3"></div>
  <div class="col-6 col-md-6">
    <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  New Driver
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add a New Driver</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
          <div class="form-group">
            <label for="email">Driver Name:</label>
            <input type="text" name="driver_name" class="form-control" id="Route">
          </div>

          <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Driver Available?</label>
          </div>
          <select name="taken" class="custom-select" id="inputGroupSelect01">
            <option value="yes">Yes</option>
            <option value="no">No</option>
          </select>
        </div>

          <button type="submit" name="new_driver" class="btn btn-primary"> + add</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<br>
<br>
    <div class="card border-dark mb-3">
  <div class="card-header">Drivers</div>
  <div class="card-body text-dark">
    <h5 class="card-title">View drivers below</h5>
    <p class="card-text">
      <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>First Name</th>
                                <th>Available</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM drivers";
                            $result = mysqli_query($db, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['driver_name'];?></td>
                                        <td><?php echo $row['taken'];?></td>                                   
                                    </tr>
                                    <?php
                                }
                            } else {
                                echo "There are no routes at the moment";
                            }
                            ?>

                        </tbody>
                    </table>

    </p>
  </div>
</div>
  </div>
  <div class="col-6 col-md-3"></div>
</div>

    </body>
</html>