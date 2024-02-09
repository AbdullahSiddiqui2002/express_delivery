<!-- ======= Header ======= -->
<?php

include("header.php");
require("../include/connection.php");
// session_start();
 echo $agent_id = $_SESSION['id'];
 $firstname = $_SESSION['firstname'];
 $lastname = $_SESSION['lastname'];
 $email = $_SESSION['email'];
// $read = "SELECT * FROM `agent` WHERE `id` = '$agent_id';";
// $result_read = mysqli_query($connection,$read);
// if($result_read){
//     $row = mysqli_fetch_assoc($result_read);
//     $firstname = $row["firstname"];
//     $lastname = $row["lastname"];
//     $email = $row["email"];
// }

?>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.18/sweetalert2.min.css" integrity="sha512-JdCZ6A3kWS4rg+O5LrYY4tNo5q3Pn6JH26GhL/JcPApG0XxK/HBT0l4r7sAaCM6CDPuUIiZjyNccAiv1T9L9nA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.18/sweetalert2.all.min.js" integrity="sha512-xqj5+0KqF3c0nHqpRInNkJdNvSoIT6atZNdKdbULZ1E+T1uy3k5SVz8GOKT2wK7i1Fu7OsvOF3I0JwL7xM0UsQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
  .heading{
    font-size: 25px;
  }
  @media (min-width:525px) and (max-width:700px){
    .heading{
    font-size: 17px;
  }
  }
  @media (min-width:360px) and (max-width:525px){
    .heading{
    font-size: 13px;
  }
  }
  @media (min-width:0px) and (max-width:360px){
    .heading{
    font-size: 10px;
  }
  }
  header, .top-drop{
    background-color: #D54E16 !important;
    color: white !important;
  }
  .top:hover{
    background-color: #F95C19 !important;
  }
</style>
<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <a href="index.php" class="logo d-flex align-items-center">
    <img src="assets/EXpress Delivery (5).png" alt="">
    <span class="d-none d-lg-block text-light">Agent</span>
  </a>
  <i class="bi bi-list toggle-sidebar-btn text-light"></i>
</div><!-- End Logo -->

<div class="mx-auto mt-2">
  <h2 class="heading">Courier Management System</h2>
</div><!-- End Search Bar -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
      <i class="fa-solid fa-circle-user fs-3 text-light"></i>
        <span class="d-none d-md-block dropdown-toggle ps-2 text-light"><?= $firstname.' '.$lastname ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile top-drop">
        <li class="dropdown-header text-light">
          <h6 class="text-light"><?= $firstname.' '.$lastname ?></h6>
          <span>Agent</span>
        </li>
        <li>
          <hr class="dropdown-divider bg-light">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center text-light top" href="profile.php">
            <i class="bi bi-person text-light top"></i>
            <span>My Profile</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider bg-light">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center text-light top" href="profile.php">
            <i class="bi bi-gear text-light top"></i>
            <span>Account Settings</span>
          </a>
        </li>
        <li>
          <hr class="dropdown-divider bg-light">
        </li>

        <li>
          <hr class="dropdown-divider bg-light">
        </li>

        <li>
          <a class="dropdown-item d-flex align-items-center text-light top logout" href="#">
            <i class="bi bi-box-arrow-right text-light top"></i>
            <span>Logout</span>
          </a>
        </li>
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

      </ul><!-- End Profile Dropdown Items -->
    </li><!-- End Profile Nav -->

  </ul>
</nav><!-- End Icons Navigation -->

</header><!-- End Header -->

