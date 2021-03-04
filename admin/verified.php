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


if (isset($_POST['verify'])) {

$id = $_POST['id'];
$customer_id = $_POST['customer_id'];

$sql = "SELECT * FROM payments WHERE user_id = '$customer_id'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
      $transaction_id = $row['transaction_id'];
    }
} else {
    echo "No results";
}

if ($transaction_id == $id) {
    

$sql = "SELECT email FROM users WHERE id = '$customer_id'";
$result = mysqli_query($db, $sql);

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
      $email = $row['email'];
    }
} else {
    echo "No results";
}


require '../phpmailer/PHPMailerAutoload.php';
                    $emaill = 'pistonsanjama45@gmail.com';                    
                    $password = '0888116194dad';
                    $to_id = $email;
                    $message = "Your Payment has been accepted. You have rented the vehicle and you can pick it up at our offices";
                    $subject = 'Payment Successful';

                    $mail = new PHPMailer;

                    $mail->isSMTP();

                    $mail->Host = 'smtp.gmail.com';

                    $mail->Port = 587;

                    $mail->SMTPSecure = 'tls';

                    $mail->SMTPAuth = true;

                    $mail->Username = $emaill;

                    $mail->Password = $password;

                    $mail->setFrom('from@example.com', 'First Last');

                    $mail->addReplyTo('replyto@example.com', 'First Last');

                    $mail->addAddress($to_id);

                    $mail->Subject = $subject;

                    $mail->msgHTML($message);

                    if (!$mail->send()) {
                       $error = "Mailer Error: " . $mail->ErrorInfo;
                        ?><script>alert('<?php echo $error ?>');</script><?php
                    } 
                    else {
                       echo '<script>alert("Message sent!");</script>';
                    }


$query = "UPDATE payments SET verified = 1 WHERE user_id = '$customer_id'";
$result = mysqli_query($db, $query);

if ($result) {
    echo '<script language="javascript">alert("Payment Verified")</script>';
    header('location: verify.php');
} else {
    echo '<script language="javascript">alert("Failed to verify Payment")</script>';
}


} else {
    echo ('<script type="text/javascript">alert("The Transction codes do not match!");window.location=\'verify.php\';</script>');
}


}

/*
$id = $_POST['customer_id'];
$customer_id = $_POST['customer_id'];


*/
?>