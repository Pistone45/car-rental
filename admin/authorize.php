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

$customer_id = $_GET['customer_id'];

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
                    $message = "You have been authorized to lend a vehicle at ADD following your approval of your National ID.";
                    $subject = 'AUTHORISATION TO LEND A VEHICLE';

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


$query = "UPDATE users SET authorized = 1 WHERE id = '$customer_id'";
$result = mysqli_query($db, $query);

if ($result) {
	echo '<script language="javascript">alert("User Authorized")</script>';
	header('location: index.php');
} else {
	echo '<script language="javascript">alert("Failed to Authorize Customer")</script>';
}

?>