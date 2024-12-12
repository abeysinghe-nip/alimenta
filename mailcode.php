<?php require_once('./config.php'); ?>
<html>
  <head>
    <title>Verify</title>
    <script src="sweetalert.min.js"></script>
    <style type="text/css">
        .swal-modal {
  background-color: #222222;
  border: 3px solid #29d9d5;
}
.swal-title {
  color: #29d9d5;
}
.swal-text {
  color: white;
}
.swal-button {
  margin-top: 1rem;
  display: inline-block;
  padding: 1rem 3rem;
  font-size: 1.7rem;
  color: #29d9d5;
  border: 0.2rem solid #29d9d5;
  border-radius: 5rem;
  cursor: pointer;
  background: none;
}
.swal-button:hover {
  background: #29d9d5;
  color: #222222;
}
    </style>
  </head>
  <body>
    

<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"alimenta_db");

$res1= mysqli_query($link,"select email from client_list where id = '{$_settings->userdata('id')}' ");
$row1=mysqli_fetch_row($res1);  
$email= $row1[0];

$v1=rand(1111,9999);
$v2=rand(1111,9999);
   
$v3=($v1.$v2)/100;
$code=intval($v3);

$_SESSION["code"] = $code;

require 'Mailer/PHPMailer-master/src/Exception.php'; 
require 'Mailer/PHPMailer-master/src/PHPMailer.php'; 
require 'Mailer/PHPMailer-master/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
//ast_123_
try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'alimenta588@gmail.com';                     //SMTP username
    $mail->Password   = 'uixr vblg rqev qxbk';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('alimenta588@gmail.com');
    $mail->addAddress($email);     //Add a recipient             //Name is optional


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Verification Code';
    $mail->Body    = $code;

    $mail->send();
    ?>
        <script type="text/javascript">
            swal("Verification Code has been sended to <?php echo $email; ?>. Enter the Verification code :", {
                content: "input",
            })
            .then((value) => {
                window.location = "confirmcode.php?value="+ value;
            });
    </script>
    <?php

} catch (Exception $e) {
            ?>
                <script type="text/javascript">
                    swal({
                        title: "Checkout Error",
                        text: "Verification Failed. Try Again!!!",
                        icon: "error"
                    }).then(function() {
                        window.location = "./?page=orders/cart";
                    });
                </script>
            <?php
}
?>

  </body>
</html>