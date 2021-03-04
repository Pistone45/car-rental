<?php
include ("../includes/functions.php");
include('../includes/config.php');
if (!isCustomer()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location:../login.php");
}
$id = $_SESSION['user']['id'];
$username = $_SESSION['user']['username'];

if (!isset($_FILES['image']['tmp_name'])) {
	echo "";
	}else{
	$file=$_FILES['image']['tmp_name'];
	$image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
	$image_name= addslashes($_FILES['image']['name']);
			
			move_uploaded_file($_FILES["image"]["tmp_name"],"../photos/" . $_FILES["image"]["name"]);
			
			$location="../photos/" . $_FILES["image"]["name"];
			
			$save=mysql_query("INSERT INTO national_id (user_id, location, username) VALUES ('$id','$location', '$username')");
			$result = mysql_query($save, $bd);
			
			header("location: upload.php");
			exit();					
	}
?>