<?php
require("../../include/connection.php");
session_start();
if(isset($_SESSION['email'])){
  $user_id = $_SESSION['id'];
  $read_email = "SELECT * FROM user WHERE `id` = '$user_id';";
  $result_email = mysqli_query($connection, $read_email);
          if ($result_email) {
            $row_email = mysqli_fetch_assoc($result_email);
            $user_email = $row_email["email"];
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
    <title>Track Courier - Express Delivery</title>


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

<section class="py-xxl-10 pb-0" id="home">
        <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/hero-header-bg.png);background-position:top center;background-size:cover;">
        </div>
        <!--/.bg-holder-->

        <div class="container">
          <div class="row align-items-center">
            <div class="col-md-5 col-xl-6 col-xxl-7 order-0 order-md-1 text-end"><img class="pt-7 pt-md-0 w-100" src="assets/img/illustrations/hero.png" alt="hero-header" /></div>
            <div class="col-md-75 col-xl-6 col-xxl-5 text-md-start text-center py-8">
              <h1 class="fw-normal fs-6 fs-xxl-7">A trusted provider of</h1>
              <h1 class="fw-bolder fs-6 fs-xxl-7 mb-2">courier services.</h1>
              <p class="fs-1 mb-5">We deliver your products safely to <br />your home in a reasonable time. </p>
              <form class="" method="post">
                <div class="input-group">
                    <span class="me-4 my-2 fw-bold">Enter Tracking Number</span>
                    <input type="text" class="form-control" name="tracking_id">
                    <button class="btn btn-primary" name="track_btn" type="submit"><i class="fa fa-search"></i></button>
                </div>
              </form>
            </div>
          </div>

          <?php
        if(isset($_POST['track_btn'])  && $_SERVER['REQUEST_METHOD']=="POST"){
          $tracking_id = mysqli_real_escape_string($connection, $_POST["tracking_id"]);
          if(empty($tracking_id)){
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
          $read = "SELECT * FROM `parcel` WHERE `sender_email` = '$user_email' && `tracking_id` = '$tracking_id';";
          $result = mysqli_query($connection, $read);
          if ($result) {
              if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="row my-5" id="trackingTable">
            <div class="col-md-8 mx-auto">
                <h2 class="text-center f-a">Tracking ID: <?= $tracking_id ?></h2>
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $parcel_id = $row["id"];
                                        $read_parcelstatus = "SELECT * FROM `parcel_tracks` WHERE `parcel_id` = '$parcel_id';";
                                        $result_parcelstatus = mysqli_query($connection, $read_parcelstatus);
                                        if ($result_parcelstatus) {
                                            if (mysqli_num_rows($result_parcelstatus) > 0) {
                                                while ($row_parcelstatus = mysqli_fetch_assoc($result_parcelstatus)) {
                                                    $datetime = $row_parcelstatus["date_created"];
                                                    $timestamp = strtotime($datetime);
                                                    $date = date("Y-m-d", $timestamp);
                                                    $time24Hour  = date("H:i:s", $timestamp);
                                                    $time12Hour = date("h:i A", strtotime($time24Hour));
                                                    if($row_parcelstatus["parcel_status"] == "1"){
                                                        $parcel_status = "Item Accepted by Courier";
                                                    }
                                                    elseif($row_parcelstatus["parcel_status"] == "2"){
                                                        $parcel_status = "Collected";
                                                    }
                                                    elseif($row_parcelstatus["parcel_status"] == "3"){
                                                        $parcel_status = "Shipped";
                                                    }
                                                    elseif($row_parcelstatus["parcel_status"] == "4"){
                                                        $parcel_status = "Delivered";
                                                    }
                                                    else{
                                                        $parcel_status = "Unsuccessful Delivery Attempt";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td>$parcel_status</td>";
                                                    echo "<td class='f-a'>$date</td>";
                                                    echo "<td class='f-a'>$time12Hour</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    }  
                                }
                            
                            else{
                              echo '<script>
                              $(document).ready(function () {
                                  Swal.fire({
                                      title: "Incorrect Tracking Id",
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
                        
                    </tbody>
                </table>
            </div>
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
            <div class="col-12 col-sm-8 col-md-6">
              <p class="fs--1 my-2 text-center text-md-end text-200"> Made with&nbsp;
                <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="#F95C19" viewBox="0 0 16 16">
                  <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
                </svg>&nbsp;by&nbsp;<a class="fw-bold text-primary" href="https://themewagon.com/" target="_blank">ThemeWagon </a>
              </p>
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
<!-- Add the following script at the end of your HTML body -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php
        if (isset($_POST['track_btn']) && $_SERVER['REQUEST_METHOD'] == "POST") {
            echo "document.getElementById('trackingTable').scrollIntoView({ behavior: 'smooth' });";
        }
        ?>
    });
</script>

<?php
    
}
else{
    header("location: login.php");
}
?>