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

$message = $_POST['message'];
$sender = $_SESSION['user']['id'];
$user_id = $_POST['id'];


$query = "INSERT INTO messages (user_id, message, sender)
VALUES('$user_id', '$message', '$sender')";
$result = mysqli_query($db, $query);

if ($query) {
	header('location: messages.php');
}
?>