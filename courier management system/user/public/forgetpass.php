<?php
// include("header.php");
require("../../include/connection.php");

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendrecoverylink($token, $email, $name){
    


//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
                         //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'abdullah.siddiqui13122002@gmail.com';                     //SMTP username
    $mail->Password   = 'rkds zinb iyur ktbg';                               //SMTP password
    $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('abdullah.siddiqui13122002@gmail.com', 'Courier Management System');
    $mail->addAddress($email, $name);     //Add a recipient
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Password Recovery Request';
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Password Recovery - Courier Management System</title>
      <style>
        body {
          font-family: Arial, sans-serif;
          margin: 0;
          padding: 0;
          background-color: #f4f4f4;
        }
    
        .container {
          max-width: 600px;
          margin: 0 auto;
          padding: 20px;
          background-color: #ffffff;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    
        h1 {
          color: #D54E16;
        }
    
        p {
          color: #333333;
        }
    
        .button {
          display: inline-block;
          padding: 10px 20px;
          background-color: #D54E16;
          color: #ffffff;
          text-decoration: none;
          border-radius: 5px;
        }
      </style>
    </head>
    
    <body>
    
      <div class="container">
        <h1>Password Recovery</h1>
        <p>Hello, '.$name.'!</p>
        <p>A password recovery request has been initiated for your Courier Management System account.</p>
        <p>Click the following link to reset your password:</p>
        <p><a class="button" style="color: white;" href="http://localhost:82/E-Project/courier%20management%20system/user/public/resetpass.php?token='.$token.'&email='.$email.'">Reset Password</a></p>
        <p>If you did not initiate this request, please ignore this email.</p>
        <p>Thank you,<br>Courier Management System Team</p>
      </div>
    
    </body>
    
    </html>
    ';

    $mail->send();
    echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Check your inbox. Password recovery email sent to you!",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "login.php";
                    });
                  });
                  </script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}


if(isset($_POST['reset']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $email = mysqli_real_escape_string($connection,$_POST['recoveryemail']);
    if(empty($email)){
        ?>
        <!-- Template Main CSS File -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <?php
        echo '<script>
            $(document).ready(function () {
                Swal.fire({
                    title: "Please fill in all fields",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2000
                });
            });
            </script>';
    } else {
    $token = md5(rand());
    $check = "SELECT * FROM user WHERE email = '$email';";
    $result = mysqli_query($connection, $check) or die("failed");
    if($result){
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $name = $row['firstname'] . " " . $row['lastname'];
        
        $updatetoken = "UPDATE `user` SET `token`='$token' WHERE `email` = '$email';";
        $updatetoken_run = mysqli_query($connection, $updatetoken) or die("failed");
        if($updatetoken_run){
            sendrecoverylink($token, $email, $name);
        }
    }
   
    
else{
     ?>
      
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Create an account",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "signup.php";
                            });
                          });
                          </script>';
}
}
}}
?>
<?php
session_start();
if(!isset($_SESSION['email'])){
  session_unset();
session_destroy();
require("../../include/connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <!-- <title>Dashboard - NiceAdmin Bootstrap Template</title> -->
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title>Login - Express Delivery</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
<link rel="manifest" href="assets/img/site.webmanifest">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../../admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../../admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../../admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../../admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../../admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../../admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../../admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Template Main CSS File -->
  <link href="../../admin/assets/css/style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<style>
   .btn-primary, .btn-success {
    color: #FFFFFF !important;
    background-color: #D54E16 !important;
    border-color: #D54E16 !important;
}
.btn-primary:hover, .btn-success:hover{
    color: #FFFFFF !important;
    background-color: #ca4209 !important;
    border-color: #ca4209 !important;
}
input:focus {
     box-shadow: none !important;
    border-color: white !important;
    outline: none !important;
}
input:focus {
  box-shadow: #D54E16 0px 2px 16px 0px !important;
}
a:hover{
    text-decoration: underline;
}
</style>
</head>
<body>
    <div class="container">

<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

        <div class="d-flex justify-content-center py-4">
          <a href="#" class="logo d-flex align-items-center w-auto">
            <img src="assets/img/gallery/EXpress_Delivery__3_-removebg-preview.png" alt="">
            
          </a>
        </div>

        <div class="card mb-3">

          <div class="card-body">

            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4" style="color: #D54E16;">Password Recovery</h5>
              <p class="text-center small">Enter your email for password recovery</p>
            </div>

            <form class="row g-3 needs-validation" novalidate method="post">

            <div class="col-12">
                <label for="recoveryemail" class="form-label">Email</label>
                <input type="email" id="myInput" name="recoveryemail" class="form-control" id="email" required="required">
                <div class="invalid-feedback">Please enter a valid Email adddress!</div>
              </div>


              <div class="col-12">
                <button class="btn btn-primary w-100" type="submit" name="reset">Send Request</button>
              </div>
              
            </form>

          </div>
        </div>



      </div>
    </div>
  </div>

</section>

</div>
</main><!-- End #main -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/vendor/chart.js/chart.umd.js"></script>
<script src="../../assets/vendor/echarts/echarts.min.js"></script>
<script src="../../assets/vendor/quill/quill.min.js"></script>
<script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../../assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../../assets/js/main.js"></script>

</body>

</html>
<?php


}
else{
header("location: index.php");
}
?>