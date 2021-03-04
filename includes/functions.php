<?php
error_reporting(E_ALL ^ E_DEPRECATED);
session_start();


// connect to database
$db = mysqli_connect('localhost', 'root', '', 'rental');

// variable declaration
$username = "";
$email = "";
$address = "";
$firstname = "";
$lastname = "";
$gender = "";
$dob = "";
$errors = array();

// call the register() function if register button is clicked
if (isset($_POST['signup'])) {
    register();
}

function register(){
    global $db, $errors, $username, $address, $email, $user_type, $to, $name, $semail, $text, $subject, $question, $answer, $firstname, $lastname, $dob, $gender;
// receive all input values from the form. Call the e() function
// defined below to escape form values
    $username = e($_POST['username']);
    $firstname = e($_POST['firstname']);
    $lastname = e($_POST['lastname']);
    $email = e($_POST['email']);
    $gender = e($_POST['gender']);
    $address = e($_POST['address']);
    $password_1 = e($_POST['password_1']);
    $password_2 = e($_POST['password_2']);

// form valuserIdation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($password_2)) {
        array_push($errors, "Confirmation password is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }
    if ($password_1 != $password_2) {
        array_push($errors, "The two passwords do not match");
    }

    if (count($errors) == 0) {
        $sql = "SELECT * FROM `users` WHERE `username` = '$username'";
        $res = mysqli_query($db, $sql);
        $num_row = mysqli_num_rows($res);
        if ($num_row == 0) {
            $sql2 = "SELECT * FROM `users` WHERE `email` = '$email'";
            $res1 = mysqli_query($db, $sql2);
            $num_row2 = mysqli_num_rows($res1);
            if ($num_row2 == 0) {
                $password = md5($password_1); //encrypt the password before saving in the database

                    $query = "INSERT INTO users (firstname, lastname, gender, username, email, user_type, password)
                      VALUES('$firstname', '$lastname', '$gender', '$username', '$email', 'customer', '$password')";
                    $result = mysqli_query($db, $query);

                    if ($result) {

                    $sql = "SELECT * FROM users WHERE email = '$email'";
                            $result = mysqli_query($db, $sql);


                    }
                    echo '<script language="javascript">alert("account has been created")</script>';
                    header("location: index.php");
                                            


            } else {
                echo '<script language="javascript">alert("Email already exist Please try a new one")</script>';
            }
        } else {
            echo '<script language="javascript">alert("Username already exist Please try a new one")</script>';
        }

}
}

if (isset($_POST['login'])) {
    login();
}

// LOGIN USER
function login() {
    global $db, $username, $errors;

// grap form values
    $username = e($_POST['username']);
    $password = e($_POST['password']);

// make sure form is filled properly
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

// attempt login if no errors on form
    if (count($errors) == 0) {
        $password = md5($password);

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) { // user found
// check if user is admin or user
            $logged_in_user = mysqli_fetch_assoc($results);
            if ($logged_in_user['user_type'] == 'admin') {

                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "You are now logged in";
                header('location: admin/index.php');
            }if ($logged_in_user['user_type'] == 'customer') {
                $_SESSION['user'] = $logged_in_user;
                $_SESSION['success'] = "You are now logged in";
                header('location: customer/index.php');
//header('location: index.php');
            }
        } else {
            array_push($errors, '<script language="javascript">alert("Incorrect password and username combination")</script>');
        }
    }
}

function isAdmin() {
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

function isCustomer() {
    if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'customer') {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['update'])) {
    updatecustomer();
}

function updatecustomer() {
// call these variables with the global keyword to make them available in function
    global $db, $errors, $firstname, $lastname, $dob, $gender, $address;
// receive all input values from the form. Call the e() function
// defined below to escape form values
    $firstname = e($_POST['firstname']);
    $lastname = e($_POST['lastname']);
    $dob = e($_POST['dob']);
    $gender = e($_POST['gender']);
    $address = e($_POST['address']);

// form valuserIdation: ensure that the form is correctly filled
    if (empty($firstname)) {
        array_push($errors, "firstname is required");
    }
    if (empty($lastname)) {
        array_push($errors, "lastname is required");
    }
    if (empty($dob)) {
        array_push($errors, "your date of birth is required");
    }
    if (empty($gender)) {
        array_push($errors, "gender is required");
    }
    if (empty($address)) {
        array_push($errors, "Address is required");
    }

    $query = "UPDATE users SET "
            . "firstname = '$firstname', lastname = '$lastname', dob = '$dob', gender = '$gender', address = '$address' WHERE id = {$_SESSION['user']['id']}";

    $result = mysqli_query($db, $query);

    if ($result) {
        array_push($errors, '<script language="javascript">alert("Profile Updated")</script>');
    }
}

function display_error() {
    global $errors;

    if (count($errors) > 0) {
        echo '<div class="error">';
        foreach ($errors as $error) {
            echo $error . '<br>';
        }
        echo '</div>';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['user']);
    header("location: index.php");
}

// escape string
function e($val) {
    global $db;
    return mysqli_real_escape_string($db, trim($val));
}

?>