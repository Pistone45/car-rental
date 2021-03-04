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

$id = $_GET['customer_id'];

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
  <a class="navbar-brand" href="#">Logo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Dashboard<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reports.php">Reports</a>
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
  <a class="nav-link active" id="v-pills-home-tab"href="index.php" role="tab" aria-controls="v-pills-home" aria-selected="true">Authorize Customers</a>
  <a class="nav-link" id="v-pills-profile-tab" href="profile.php" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="vehicles.php" role="tab" aria-controls="v-pills-messages" aria-selected="false">Vehicles</a>
  <a class="nav-link" id="v-pills-settings-tab" href="track.php" role="tab" aria-controls="v-pills-settings" aria-selected="false">Track Vehicles</a>
</div>
  </div>
  <div class="col-md-10">
    <div class="col-md-2"></div>
    <div class="col-md-8">

  <h3>Customers</h3>
  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" href="index.php">Authorize a Customer</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="unathorized.php">Unathorized a Customer</a>
  </li>
    <li class="nav-item">
    <a class="nav-link" href="verify.php">Verify ID</a>
  </li>
      <li class="nav-item">
    <a class="nav-link active" href="messages.php">Messages</a>
  </li>
</ul>

  <br>
                          

  <h3>Messages</h3>
  <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
 New Message
</button>

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Type new Message</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
        <form action="sent.php" method="post">
      <label for="comment">Message</label>
      <textarea name="message" placeholder="Type message" class="form-control" rows="3" id="message"></textarea>
    </div>
    <br>
    <div class="form-group">
        <input hidden="hidden" name="id" value="<?php echo $id; ?>" type="text" class="form-control" id="text">
      </div>
    <button type="submit" class="btn btn-outline-success">Send</button>
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
<table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th>Message</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
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
                                echo "You have not sent a message to this customer";
                            }
                            ?>

                        </tbody>
                    </table>
                          </div>
                        </div>
    <div class="col-md-2"></div>
  </div>
</div>