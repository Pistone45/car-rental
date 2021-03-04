<?php
include('functions.php');


if (isset($_POST['business'])) {
   // login();
	$income = $_POST['income'];

	if ($income >= 200000) {
		header("location: ../signup.php");
	} else{

		header("location: ../lowincome.php");
	}



}

if (isset($_POST['work'])) {


$income = $_POST['income'];

	if ($income >= 200000) {
		header("location: ../signup.php");
	} else{

		header("location: ../lowincome.php");
	}


}

if (isset($_POST['both'])) {
  
  $income = $_POST['income'];

	if ($income >= 200000) {
		header("location: ../signup.php");
	} else{

		header("location: ../lowincome.php");
	}

}

?>