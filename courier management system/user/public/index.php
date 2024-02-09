<?php
require("../../include/connection.php");
session_start();

if(isset($_SESSION['email'])){
$user_id = $_SESSION['id'];

$read = "SELECT * FROM `user` Where `id` = '$user_id';";
$result_read = mysqli_query($connection,$read);
if($result_read){
    $row = mysqli_fetch_assoc($result_read);
    $firstname = $row["firstname"];
    $lastname = $row["lastname"];
    $email = $row["email"];
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
    <title>Express Delivery</title>


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

.nav-item.dropdown:hover .dropdown-menu {
    display: block !important;
  }

  .nav-item.dropdown .dropdown-menu {
    display: none !important;
    background-color: white !important;
  }


  .nav-item.dropdown:hover .nav-link {
    color: #F95C19 !important; 
  }

  .dropdown-item{
    color: black;
    font-weight: 600;
  }

  .dropdown-item:hover{
    background-color: #F95C19!important;
    color: white ;
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
              <li class="nav-item px-2"><a class="nav-link fw-bolder" aria-current="page" href="#">Home</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-bolder" href="#services">Our Services</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-bolder" href="#findUs">Find Us</a></li>
              <li class="nav-item px-2"><a class="nav-link fw-bolder" href="#ContactUs">Contact Us</a></li>
              <?php
            
            if(isset($_SESSION['email'])){
              
            ?>
              <li class="nav-item px-2 dropdown">
                <a class="nav-link fw-bolder dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="#" role="button"><i class="fa-solid fa-circle-user fs-3"></i> <?= $firstname.' '.$lastname ?></a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                  <li><a class="dropdown-item" href="report.php">Generate Report</a></li>
                  <li><a class="btn btn-primary order-1 order-lg-0 ms-lg-3 my-2 logout" href="#">Logout</a></li>
                </ul>
              </li>
            </ul>
            <script>
    $(document).ready(function () {
        $(".logout").click(function (e) {
            e.preventDefault();
            Swal.fire({
                text: "Are you sure you want to Logout?",
                showCancelButton: true,
                confirmButtonColor: "#D54E16",
                cancelButtonColor: "#6c757d",
                cancelButtonText: "No",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform logout actions
                    localStorage.removeItem("status");
                    window.location.href = "logout.php";
                }
            });
        });
    });
</script>
           
            <?php
            }
            else{
              ?>
              <a class="btn btn-primary order-1 order-lg-0 ms-lg-3" href="signup.php">Signup</a>
            <a class="btn btn-primary order-1 order-lg-0 ms-lg-3" href="login.php">Login</a>
              <?php
            }
            ?>
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
              <h1 class="fw-normal fs-6 fs-xxl-7">A trusted provider of </h1>
              <h1 class="fw-bolder fs-6 fs-xxl-7 mb-2">courier services.</h1>
              <p class="fs-1 mb-5">We deliver your products safely to <br />your home in a reasonable time. </p>
              <a class="btn btn-primary me-2" href="track.php" role="button">Track Your Parcel<i class="fas fa-arrow-right ms-2"></i></a>
            </div>
          </div>
        </div>
      </section>


      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-7" id="services" container-xl="container-xl">

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5 text-center mb-3">
              <h5 class="text-danger">SERVICES</h5>
              <h2>Our services for you</h2>
            </div>
          </div>
          <div class="row h-100 justify-content-center">
            <div class="col-md-4 pt-4 px-md-2 px-lg-3">
              <div class="card h-100 px-lg-5 card-span">
                <div class="card-body d-flex flex-column justify-content-around">
                  <div class="text-center pt-5"><img class="img-fluid" src="assets/img/icons/services-1.svg" alt="..." />
                    <h5 class="my-4">Business Services</h5>
                  </div>
                  <p>Offering home delivery around the city, where your products will be at your doorstep within 48-72 hours.</p>
                  <ul class="list-unstyled">
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Corporate goods
                    </li>
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Shipment
                    </li>
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Accesories
                    </li>
                  </ul>
                  <div class="text-center my-5">
                    <div class="d-grid">
                      <button class="btn btn-outline-danger" type="submit">Learn more </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 pt-4 px-md-2 px-lg-3">
              <div class="card h-100 px-lg-5 card-span">
                <div class="card-body d-flex flex-column justify-content-around">
                  <div class="text-center pt-5"><img class="img-fluid" src="assets/img/icons/services-2.svg" alt="..." />
                    <h5 class="my-4">Statewide Services</h5>
                  </div>
                  <p>Offering home delivery around the city, where your products will be at your doorstep within 48-72 hours.</p>
                  <ul class="list-unstyled">
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Unlimited Bandwidth
                    </li>
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Encrypted Connection
                    </li>
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Yes Traffic Logs
                    </li>
                  </ul>
                  <div class="text-center my-5">
                    <div class="d-grid">
                      <button class="btn btn-danger hover-top btn-glow border-0" type="submit">Learn more</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 pt-4 px-md-2 px-lg-3">
              <div class="card h-100 px-lg-5 card-span">
                <div class="card-body d-flex flex-column justify-content-around">
                  <div class="text-center pt-5"><img class="img-fluid" src="assets/img/icons/services-3.svg" alt="..." />
                    <h5 class="my-4">Personal Services</h5>
                  </div>
                  <p>You can trust us to safely deliver your most sensitive documents to the specific area in a short time.</p>
                  <ul class="list-unstyled">
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Unlimited Bandwidth
                    </li>
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Encrypted Connection
                    </li>
                    <li class="mb-2"><span class="me-2"><i class="fas fa-circle text-primary" style="font-size:.5rem"></i></span>Yes Traffic Logs
                    </li>
                  </ul>
                  <div class="text-center my-5">
                    <div class="d-grid">
                      <button class="btn btn-outline-danger" type="submit">Learn more </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="pt-7 pb-0">

        <div class="container">
          <div class="row">
            <div class="col-6 col-lg mb-5">
              <div class="text-center"><img src="assets/img/icons/awards.png" alt="..." />
                <h1 class="text-primary mt-4">26+</h1>
                <h5 class="text-800">Awards won</h5>
              </div>
            </div>
            <div class="col-6 col-lg mb-5">
              <div class="text-center"><img src="assets/img/icons/states.png" alt="..." />
                <h1 class="text-primary mt-4">65+</h1>
                <h5 class="text-800">States covered</h5>
              </div>
            </div>
            <div class="col-6 col-lg mb-5">
              <div class="text-center"><img src="assets/img/icons/clients.png" alt="..." />
                <h1 class="text-primary mt-4">689K+</h1>
                <h5 class="text-800">Happy clients</h5>
              </div>
            </div>
            <div class="col-6 col-lg mb-5">
              <div class="text-center"><img src="assets/img/icons/goods.png" alt="..." />
                <h1 class="text-primary mt-4">130M+</h1>
                <h5 class="text-800">Goods delivered</h5>
              </div>
            </div>
            <div class="col-6 col-lg mb-5">
              <div class="text-center"><img src="assets/img/icons/business.png" alt="..." />
                <h1 class="text-primary mt-4">130M+</h1>
                <h5 class="text-800">Business hours</h5>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section>

        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="card bg-dark text-white py-4 py-sm-0"><img class="w-100" src="assets/img/gallery/video.png" alt="video" />
                <div class="card-img-overlay bg-dark-gradient d-flex flex-column flex-center"><img src="assets/img/icons/play.png" width="80" alt="play" />
                  <h5 class="text-primary">FASTEST DELIVERY</h5>
                  <p class="text-center">You can get your valuable item in the fastest period of<br class="d-none d-sm-block" />time with safety. Because your emergency<br class="d-none d-sm-block" />is our first priority.</p><a class="stretched-link" href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"></a>
                  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-content overflow-hidden">
                        <div class="modal-header p-0">
                          <div class="ratio ratio-16x9" id="exampleModalLabel">
                            <iframe src="https://www.youtube.com/embed/TlcP2aTOp-Q" title="YouTube video" allowfullscreen="allowfullscreen"></iframe>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-7">

        <div class="container-fluid">
          <div class="row flex-center">
            <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/quote.png);background-position:top;background-size:auto;margin-left:-270px;margin-top:-45px;">
            </div>
            <!--/.bg-holder-->

            <div class="col-md-8 col-lg-5 text-center">
              <h5 class="text-danger">TESTIMONIAL</h5>
              <h2>Our Awesome Clients</h2>
            </div>
          </div>
          <div class="row px-3 px-md-0 mt-3">
            <div class="col-12 position-absolute"> 
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
             </div>
            </div>
          <div class="carousel slide pt-6" id="carouselExampleDark" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-bs-interval="10000">
                <div class="row h-100">
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. </p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it.</p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Kim Young Jou</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. .</p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item" data-bs-interval="2000">
                <div class="row h-100">
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. </p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. </p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Kim Young Jou</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. .</p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="carousel-item">
                <div class="row h-100">
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. </p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">“I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. </p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Kim Young Jou</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card h-100 card-span p-3">
                      <div class="card-body">
                        <h5 class="mb-0 text-primary">Fantastic service!</h5>
                        <p class="card-text pt-3">I purchased a phone from an e-commerce site, and this courier service provider assisted me in getting it delivered to my home. I received my phone within one day, and I was really satisfied with their service when I received it. .</p>
                        <div class="d-xl-flex justify-content-between align-items-center">
                          <div class="d-flex align-items-center mb-3"><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i><i class="fas fa-star text-primary me-1"></i></div>
                          <div class="d-flex align-items-center"><img class="img-fluid" src="assets/img/icons/avatar.png" alt="" />
                            <div class="flex-1 ms-3">
                              <h6 class="mb-0 fs--1 text-1000 fw-medium">Yves Tanguy</h6>
                              <p class="fs--2 fw-normal mb-0">Chief Executive, DLF</p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row px-3 px-md-0 mt-6">
              <div class="col-12 position-relative">
                <ol class="carousel-indicators">
                  <li class="active" data-bs-target="#carouselExampleDark" data-bs-slide-to="0"></li>
                  <li data-bs-target="#carouselExampleDark" data-bs-slide-to="1"></li>
                  <li data-bs-target="#carouselExampleDark" data-bs-slide-to="2"></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section id="ContactUs">
        <?php
        if(isset($_POST['contact_form'])  && $_SERVER['REQUEST_METHOD']=="POST"){
          $contact_name = mysqli_real_escape_string($connection,$_POST["contact_name"]);
          $contact_email = mysqli_real_escape_string($connection,$_POST["contact_email"]);
          $message = mysqli_real_escape_string($connection,$_POST["message"]);

          if(empty($contact_name) || empty($contact_email) || empty($message)){
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
          $user_id = $_SESSION['id'];

          $insert_contact = "INSERT INTO `contact`(`user_id`, `name`, `email`, `message`) VALUES ('$user_id','$contact_name','$contact_email','$message');";
          $result_contact = mysqli_query($connection, $insert_contact) or die("Failed to insert query");
          if ($result_contact) {
            echo '<script>
                            $(document).ready(function () {
                                Swal.fire({
                                    title: "Message sent successfully!",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                            });
                            </script>';
          }
          else {
            echo '<script>
                            $(document).ready(function () {
                                Swal.fire({
                                    title: "Message not sent",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                            });
                            </script>';
          }
        }
          
        }
        ?>

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4"><img src="assets/img/illustrations/callback.png" alt="..." />
              <h5 class="text-danger">REQUEST A CALLBACK</h5>
              <h2>We will contact in the shortest time.</h2>
              <p class="text-muted">Monday to Friday, 9am-5pm.</p>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4">
              <form class="row" method="post">
                <div class="mb-3">
                  <label class="form-label visually-hidden" for="inputName">Name</label>
                  <input class="form-control form-quriar-control" value="<?= isset($_SESSION['name']) ? $firstname.' '.$lastname : '' ?>" name="contact_name" id="inputName" type="text" placeholder="Name"/>
                </div>
                <div class="mb-3">
                  <label class="form-label visually-hidden" for="inputEmail">Another label</label>
                  <input class="form-control form-quriar-control" name="contact_email" id="inputEmail" value="<?= isset($_SESSION['email']) ? $email : '' ?>" type="email" placeholder="Email"/>
                </div>
                <div class="mb-5">
                  <label class="form-label visually-hidden" for="validationTextarea">Message</label>
                  <textarea class="form-control form-quriar-control is-invalid border-400" id="validationTextarea" name="message" placeholder="Message" style="height: 150px"></textarea>
                </div>
                <div class="d-grid">
                  <button class="btn btn-primary" name="contact_form" type="submit">Send Message<i class="fas fa-paper-plane ms-2"></i></button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section id="findUs">

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5 mb-6 text-center">
              <h5 class="text-danger">FIND US</h5>
              <h2>Access us easily</h2>
            </div>
            <div class="col-12">
              <div class="card card-span rounded-2 mb-3">
                <div class="row">
                  <div class="col-md-6 col-lg-7 d-flex"><img class="w-100 fit-cover rounded-md-start rounded-top rounded-md-top-0" src="assets/img/gallery/map.svg" alt="map" /></div>
                  <div class="col-md-6 col-lg-5 d-flex flex-center">
                    <div class="card-body">
                      <h5>Contact with us</h5>
                      <p class="text-700 my-4"> <i class="fas fa-map-marker-alt text-warning me-3"></i><span>2277 Lorem Ave, San Diego, CA 22553</span></p>
                      <p><i class="fas fa-phone-alt text-warning me-3"></i><span class="text-700">Monday - Friday: 10 am - 10pm<br/><span class="ps-4">Sunday: 11 am - 9pm  </span></span></p>
                      <p><i class="fas fa-envelope text-warning me-3"> </i><a class="text-700" href="mailto:vctung@outlook.com"> info@quriarbox.com</a></p>
                      <ul class="list-unstyled list-inline mt-5">
                        <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-facebook-square fs-2"></i></a></li>
                        <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-instagram-square fs-2"></i></a></li>
                        <li class="list-inline-item"><a class="text-decoration-none" href="#!"><i class="fab fa-twitter-square fs-2"></i></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <button class="btn btn-primary px-5" type="submit"><i class="fas fa-phone-alt me-2"></i><a class="text-light" href="tel:123-456789">Call us to delivery 123-456789</a></button>
              </div>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-1000">
      <?php
        if(isset($_POST['subscribed_email_btn'])  && $_SERVER['REQUEST_METHOD']=="POST"){
          $subscribed_email = mysqli_real_escape_string($connection,$_POST["subscribed_email"]);
          if(empty($subscribed_email)){
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
          $user_id = $_SESSION['id'];

          $read_email = "SELECT * FROM `subscribed_emails` WHERE `email` = '$subscribed_email';";
          $result_email = mysqli_query($connection, $read_email);
          if(mysqli_num_rows($result_email) > 0){
            echo "<script>alert('Already Subscribed')</script>";
          }
          else{
          $insert_subscribed = "INSERT INTO `subscribed_emails`(`user_id`, `email`) VALUES ('$user_id','$subscribed_email');";
          $result_subscribed = mysqli_query($connection, $insert_subscribed) or die("Failed to insert query");
          if ($result_subscribed) {
            echo '<script>
            $(document).ready(function () {
                Swal.fire({
                    title: "Subscribed successfully!",
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000
                })
            });
            </script>';
          }
          else {
            echo '<script>
            $(document).ready(function () {
                Swal.fire({
                    title: "Failed to Subscribed",
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
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <h2 class="fw-bold text-white">Get an update every week</h2>
              <p class="text-300">We ensure that your product is delivered in the safest possible<br />manner, at the correct location, at the right time.</p>
            </div>
            <div class="col-lg-6">
              <h5 class="text-primary mb-3">SUBSCRIBE TO NEWSLETTER </h5>
              <form class="row gx-2 gy-2 align-items-center" method="post">
                <div class="col">
                  <div class="input-group-icon">
                    <label class="visually-hidden" for="inputEmailCta">Address</label>
                    <input class="form-control input-box form-quriar-control text-light" id="inputEmailCta" name="subscribed_email" value="<?= isset($_SESSION['email']) ? $email : '' ?>" type="email" placeholder="Enter your mail" />
                  </div>
                </div>
                <div class="d-grid gap-3 col-sm-auto">
                  <?php
                  if(isset($_SESSION['email'])){
                  ?>
                  <button class="btn btn-danger" name="subscribed_email_btn" type="submit">Subscribe</button>
                  <?php
                  }
                  else{                   
                  ?>
                  <a href="login.php" class="btn btn-danger" type="button">Subscribe</a>
                  <?php
                  }
                  ?>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




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