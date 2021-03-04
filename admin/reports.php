<?php
    //your requires here

    //values return from db after selection query, could be any count, how many times activites happen etc
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

$sql = "SELECT * FROM vehicles";
$connStatus = $db->query($sql);
$numberofusers = mysqli_num_rows($connStatus);


$sql1 = "SELECT * FROM vehicles where vehicle_name = 'TOYOTA'";
$connStatus = $db->query($sql1);
$numberofstudents = mysqli_num_rows($connStatus);

$sql2 = "SELECT * FROM vehicles where vehicle_name = 'CHEVROLET'";
$connStatus = $db->query($sql2);
$numberoftutors = mysqli_num_rows($connStatus);

$sql3 = "SELECT * FROM vehicles where vehicle_name = 'CITROEN'";
$connStatus = $db->query($sql3);
$numberofmtz = mysqli_num_rows($connStatus);

$sql4 = "SELECT * FROM vehicles where vehicle_name = 'NISSAN'";
$connStatus = $db->query($sql4);
$numberoftsibi = mysqli_num_rows($connStatus);

//echo $numberOfRows;

    $numberOfItems1 = $numberofusers;
    $numberOfItems2 = $numberofstudents;
    $numberOfItems3 = $numberoftutors;
    $numberOfItems4 = $numberofmtz;
    $numberOfItems5 = $numberoftsibi;


    //average calculation

    $numberOfItemsAverage = $numberOfItems1 + $numberOfItems2 + $numberOfItems3 + $numberOfItems4 + $numberOfItems5;

    if($numberOfItemsAverage == 0){
        $percentageOfItems1 = 0; //if database returns nothing, for a particular average calculation of items, it will be set to 0
        $percentageOfItems2 = 0;
        $percentageOfItems3 = 0;
        $percentageOfItems4 = 0;
        $percentageOfItems5 = 0;
    }else{
        //calculate percentage
        $percentageOfItems1 = round(($numberOfItems1/($numberOfItemsAverage)) * 100);
        $percentageOfItems2 = round(($numberOfItems2/($numberOfItemsAverage)) * 100);
        $percentageOfItems3 = round(($numberOfItems3/($numberOfItemsAverage)) * 100);
        $percentageOfItems4 = round(($numberOfItems4/($numberOfItemsAverage)) * 100);
        $percentageOfItems5 = round(($numberOfItems5/($numberOfItemsAverage)) * 100);
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
  <a class="navbar-brand" href="#">ADD</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Dashboard<span class="sr-only">(current)</span></a>
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
          <div class="col-md-12">
              <div class="col-md-12">
                <div id="canvas-holder" style="width:100%">
                    <canvas id="chart-area"/>
                </div>
              </div>
          </div>


    </body>
</html>

<script>
    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?php echo $percentageOfItems1; ?>,
                    <?php echo $percentageOfItems2; ?>,
                    <?php echo $percentageOfItems3; ?>,
                    <?php echo $percentageOfItems4; ?>,
                    <?php echo $percentageOfItems5; ?>,

                ],
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    window.chartColors.yellow,
                    window.chartColors.green,
                    window.chartColors.grey,
                ],
                label: 'Items'
            }],
            labels: [
                "<?php echo 'number of Vehicles ' .$percentageOfItems1 . '%'; ?>",
                "<?php echo 'number of TOYOTA ' .$percentageOfItems2 . '%'; ?>",
                "<?php echo 'number of CHEVROLET '.$percentageOfItems3 . '%'; ?>",
                "<?php echo 'number of CITROEN '.$percentageOfItems4 . '%'; ?>",
                "<?php echo 'number of NISSAN '.$percentageOfItems5 . '%'; ?>",
            ]
        },
        options: {
            responsive: true
        }
    };
    window.onload = function() {
        var ctx = document.getElementById("chart-area").getContext("2d");
        window.myPie = new Chart(ctx, config);
    };
    var colorNames = Object.keys(window.chartColors);
</script>
