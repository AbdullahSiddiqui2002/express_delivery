<?php
require("../../include/connection.php");
session_start();
if(isset($_SESSION['email'])){
$user_id = $_SESSION['id'];

    if(isset($_POST['update_information']) && $_SERVER['REQUEST_METHOD'] == "POST"){
        $firstname = mysqli_real_escape_string($connection,$_POST['firstname']);
        $lastname = mysqli_real_escape_string($connection,$_POST['lastname']);
        $email = mysqli_real_escape_string($connection,$_POST['email']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
?>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
        if(empty($firstname) || empty($lastname) || empty($email)){
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
        $token = md5(rand());
        $insert = "UPDATE `user` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$encryptedpassword',`token`='$token' WHERE `id` = '$user_id';";
    
        $result = mysqli_query($connection, $insert) or die("Failed to insert query");
       ?>
       <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
       <?php
        if($result){
          echo '<script>
          $(document).ready(function () {
                          Swal.fire({
                              title: "Information updated successfully!",
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
                                title: "Failed to update information",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2000
                            })
                          });
                          </script>';
        }
      }
    }
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Profile - Express Delivery</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
<link rel="manifest" href="assets/img/site.webmanifest">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="assets/css/theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
  </head>
<style>
  .scroll {
    animation-name: scrol;
    animation-duration: .5s;
    position: fixed;
    top: 0;
    z-index: 2;
    background-color: rgba(245, 236, 236, 0.8);
    width: 100%;
    height: auto
}

.form-label {
    margin-bottom: 0.3rem !important;
}


.scroll .nav-link{
  color: #F95C19 !important;
}



@keyframes scrol {
    0% {
        margin-top: -100px
    }
    10% {
        margin-top: -90px
    }
    20% {
        margin-top: -80px
    }
    30% {
        margin-top: -70px
    }
    40% {
        margin-top: -60px
    }
    50% {
        margin-top: -40px
    }
    60% {
        margin-top: -30px
    }
    70% {
        margin-top: -20px
    }
    80% {
        margin-top: -10px
    }
    90% {
        margin-top: -5px
    }
    100% {
        margin-top: 0
    }
}
.nav-link:hover{
  color: #F95C19 !important;
}
li {
    list-style-type: none;
  }
  table{
    border: 2px solid #F95C19 !important;
    color: black;
    
  }
  .f-a{
    font-family: arial;
  }
</style>

  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" id="navbar">
        <div class="container"><a class="navbar-brand" href="index.php"><img src="assets/img/gallery/EXpress_Delivery__2_-removebg-preview.png" height="100" alt="logo" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-">
              <li class="nav-item px-2"><a class="nav-link fw-bolder" aria-current="page" href="index.php">Home</a></li>
            </ul>
           
          </div>
        </div>
      </nav>
      <script>
        window.addEventListener("scroll", function () {
            var e = document.getElementById("navbar");
            window.pageYOffset > 0 ? e.classList.add("scroll") : e.classList.remove("scroll");
        });
    </script>
        <?php
        $read = "SELECT * FROM `user` Where `id` = '$user_id';";
        $result_read = mysqli_query($connection,$read);
        if($result_read){
            $row = mysqli_fetch_assoc($result_read);
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $email = $row["email"];
        }
        ?>
      <section class="py-xxl-10 pb-0 my-5" id="home">
        <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/hero-header-bg.png);background-position:top center;background-size:cover;">
        </div>
        <!--/.bg-holder-->
        <div class="container">
          <div class="row align-items-center">
            <h2 class="text-center my-4">Profile</h2>
            <form class="row g-3" method="post">
            <div class="col-md-6 my-2">
                <label class="form-label" for="">First Name:</label>
                <input class="form-control" type="text" value="<?= $firstname ?>" name="firstname" id="">
            </div>
            <div class="col-md-6 my-2">
                <label class="form-label" for="">Last Name:</label>
                <input class="form-control" value="<?= $lastname ?>" type="text" name="lastname" id="">
            </div>
            <div class="col-md-12 my-2">
                <label class="form-label" for="">Email</label>
                <input class="form-control" value="<?= $email ?>" type="email" name="email" id="">
            </div>
            <div class="col-md-12 my-2">
                <label class="form-label" for="">Password</label>
                <input class="form-control" type="password" name="password" id="">
                <p class="my-1"><i>Leave this blank if you dont want to change this</i></p>
            </div>
            <div class="col-lg-12 my-3 mx-auto">
                <button class="btn btn-primary w-100" name="update_information" type="submit">Update Information</button>
            </div>
            </form>
          </div>
        </div>
      </section>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-900 pb-0 pt-5">

        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-lg-6 mb-4 order-0 order-sm-0"><a class="text-decoration-none" href="#"><img src="assets/img/gallery/EXpress_Delivery__3_-removebg-preview.png" height="70" alt="" /></a>
              <p class="text-500 my-4">The most trusted Courier<br />company in your area.</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-2 order-sm-1">
              <h5 class="lh-lg fw-bold mb-4 text-light font-sans-serif">Other links </h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-500" href="#!">Blogs</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Movers website</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Traffic Update</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
              <h5 class="lh-lg fw-bold text-light mb-4 font-sans-serif">Services</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-500" href="#!">Corporate goods</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Artworks</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Documents</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
              <h5 class="lh-lg fw-bold text-light mb-4 font-sans-serif"> Customer Care</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-500" href="#!">About Us</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Contact US</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Get Update</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 bg-1000">

        <div class="container">
          <div class="row justify-content-md-between justify-content-evenly py-4">
            <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
              <p class="fs--1 my-2 fw-bold text-200">All rights Reserved &copy; Your Company, 2021</p>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->




    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
  </body>

</html>

<?php
    
}
else{
    header("location: login.php");
}
?>