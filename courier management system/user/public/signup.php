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
  <title>Signup - Express Delivery</title>
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

</style>
</head>
<body>
<?php
if(isset($_POST['signup']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
    $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password)){
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
    }
    else{
    $encryptedpassword = password_hash($password, PASSWORD_BCRYPT);

    $check = "SELECT * FROM user WHERE email = '$email';";
    $result = mysqli_query($connection, $check) or die("failed");

    if(mysqli_num_rows($result) > 0){
        echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Already Registered. Please Login Now!",
                                icon: "info",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "login.php";
                            });
                          });
                          </script>';
    }
    else{

    $insert = "INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`) VALUES ('$firstname','$lastname','$email','$encryptedpassword');";

    $result = mysqli_query($connection, $insert) or die("Failed to insert query");
   
    if($result){
        echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Account successfully created!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "login.php";
                            });
                          });
                          </script>';

    }
    else{
        echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Failed to create an account",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2000
                            })
                          });
                          </script>';
    }
}}
}
?>
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/gallery/EXpress_Delivery__3_-removebg-preview.png" alt="">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="color: #D54E16;">Create an Account</h5>
                    <p class="text-center small">Enter your details to create account</p>
                  </div>

                  <form class="row g-3"  id="admin_signup_form" method="post">
                    <div class="col-12">
                      <label for="firstname" class="form-label">First Name</label>
                      <input type="text" name="firstname" class="form-control" id="firstname" >
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>

                    <div class="col-12">
                      <label for="lastname" class="form-label">Last Name</label>
                      <input type="text" name="lastname" class="form-control" id="lastname" >
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-12">
                      <label for="email" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="email">
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password"   minlength="3" maxlength="10">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" name="signup" id="signup" type="submit">Create Account</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
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
  <script src="../../admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../admin/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../admin/assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../admin/assets/vendor/quill/quill.min.js"></script>
  <script src="../../admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../admin/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../admin/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../../admin/assets/js/main.js"></script>
</body>

</html>
<?php


}
else{
  header("location: index.php");
}
?>