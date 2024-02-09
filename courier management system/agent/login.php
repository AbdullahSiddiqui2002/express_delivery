<?php
session_start();
if(!isset($_SESSION['email'])){
  session_unset();
session_destroy();
include("header.php");
require("../include/connection.php");



if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == "POST"){
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = mysqli_real_escape_string($connection,$_POST['password']);
    if(empty($email) || empty($password)){
      echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Please fill all fields",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    })
                  });
                  </script>';
    }
    else{
    $check = "SELECT * FROM `agent` WHERE email = '$email';";
    $result = mysqli_query($connection, $check) or die("failed");
    if($result){
    if(mysqli_num_rows($result) == 1){
        $row = mysqli_fetch_assoc($result);
        $id =$row['id'];
        $branch_id =$row['branch_id'];
        $regfirstname = $row['firstname'];
        $reglastname = $row['lastname'];
        $regemail = $row['email'];
        $regpassword = $row['password'];
        $verifypassword = password_verify($password, $regpassword);
        if($verifypassword){
            session_start();
            $_SESSION['id'] =  $id;
            $_SESSION['email'] =  $regemail;
            $_SESSION['firstname'] =  $regfirstname;
            $_SESSION['lastname'] =  $reglastname;
            echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Successfully Logged In!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "index.php";
                            });
                          });
                          </script>';
        }
        else{
            echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Invalid Credentials",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2000
                            })
                          });
                          </script>';
        }
    }
else{
  echo '<script>
  $(document).ready(function () {
                  Swal.fire({
                      title: "Invalid Credentials",
                      icon: "error",
                      showConfirmButton: false,
                      timer: 2000
                  })
                });
                </script>';
}
}
}
}
?>
<head>
<title>Login - Express Delivery</title>
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
  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/logo.png" alt="">
                  <span class="d-none d-lg-block">Agent</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login</h5>
                    <p class="text-center small">Enter your email & password to login</p>
                  </div>

                  <form class="row g-3" method="post" id="login_form">

                  <div class="col-12">
                      <label for="email" class="form-label">Your Email</label>
                      <input type="email" id="myInput" name="email" class="form-control" id="email">
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <div class="col-12">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" id="myInput" name="password" class="form-control" id="password">
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" id="login_btn" name="login">Login</button>
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
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php


}
else{
  header("location: index.php");
}
?>