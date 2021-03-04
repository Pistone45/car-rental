<?php
include '../includes/functions.php';
$vehicle_name = $_POST['vehicle_name'];
$quantity = $_POST['quantity'];

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

$add = $count + $quantity;

$sql = "UPDATE vehicles SET count ='$add' WHERE vehicle_name ='$vehicle_name'";
$result = mysqli_query($db, $sql);

header("location: vehicles.php");

?>