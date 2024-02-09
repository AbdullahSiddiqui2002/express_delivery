<?php

session_start();
if(isset($_SESSION['email'])){
  include("header.php");
include("topbar.php");
include("sidebar.php");

$agent_id = $_SESSION['id'];

$read = "SELECT * FROM `agent` WHERE `id` = '$agent_id';";
$result_read = mysqli_query($connection,$read);
if($result_read){
    $row = mysqli_fetch_assoc($result_read);
}
$branch_id = $row['branch_id'];
$read_branch = "SELECT *,concat(street,', ',city,', ',`state`,', ',zip_code,', ',country) as address FROM branches WHERE `id` = '$branch_id';";
$result_branch = mysqli_query($connection,$read_branch);
if($result_branch){
    $row_branch = mysqli_fetch_assoc($result_branch);
    $branch_code =  $row_branch['branch_code'];
    $branch_address =  ucwords($row_branch['address']);
}
?>
<head>
<title>Profile - Express Delivery</title>
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
.twitter:hover, .facebook:hover, .instagram:hover, .linkedin:hover{
  color: #D54E16 !important;
}
  
</style>
</head>

  <main id="main" class="main">
  <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile my-5">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <i class="fa-solid fa-circle-user" style="font-size: 100px; color: #D54E16;"></i>
              <h2><?= $firstname.' '.$lastname ?></h2>
              <h3>Agent</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

              </ul>
              <div class="tab-content pt-2">


                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $row["firstname"].' '.$row["lastname"] ?></div>
                  </div>


                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $row["email"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Branch Code</div>
                    <div class="col-lg-9 col-md-8"><?= $branch_code ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Branch Address</div>
                    <div class="col-lg-9 col-md-8"><?= $branch_address ?></div>
                  </div>

                </div>               

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
    </section>

  </main><!-- End #main -->

  <?php
include("footer.php");
}
else{
  header("location: login.php");
}
?>