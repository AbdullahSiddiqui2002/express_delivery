<?php

session_start();
if(isset($_SESSION['email'])){
  require("../include/connection.php");
  include("header.php");
  include("topbar.php");
  include("sidebar.php");
  $agent_id = $_SESSION['id'];
?>
<head>
<title>Dashboard - Express Delivery</title>
<style>
  *, ::after, ::before {
    box-sizing: border-box;
}
  .content-wrapper {
    background-color: #fff7e7;
}
.border-primary {
    border-color: #D54E16!important;
}
.small-box:hover {
    text-decoration: none;
}
.bg-light, .bg-light>a {
    color: #1f2d3d!important;
}
.bg-light {
    background-color: #f8f9fa!important;
}
.small-box {
    border-radius: .25rem;
    box-shadow: 0 0 1px rgba(0,0,0,.125),0 1px 3px rgba(0,0,0,.2);
    display: block;
    margin-bottom: 20px;
    position: relative;
}

.shadow-sm {
    box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
}
.border {
    border: 1px solid #dee2e6!important;
}
.small-box>.inner {
    padding: 10px;
}
.small-box h3 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0 0 10px;
    padding: 0;
    white-space: nowrap;
}
.small-box h3, .small-box p {
    z-index: 5;
}
.small-box p {
    font-size: 13px;
}
.small-box:hover .icon>i, .small-box:hover .icon>i.fa, .small-box:hover .icon>i.fab, .small-box:hover .icon>i.fad, .small-box:hover .icon>i.fal, .small-box:hover .icon>i.far, .small-box:hover .icon>i.fas, .small-box:hover .icon>i.ion {
    transform: scale(1.1);
}
/* .small-box .icon {
    color: rgba(0,0,0,.15);
    z-index: 0;
} */
.small-box .icon>i.fa, .small-box .icon>i.fab, .small-box .icon>i.fad, .small-box .icon>i.fal, .small-box .icon>i.far, .small-box .icon>i.fas, .small-box .icon>i.ion {
    font-size: 70px;
    top: 20px;
}
.small-box .icon>i {
    font-size: 70px;
    position: absolute;
    right: 15px;
    top: -5px;
    transition: transform .3s linear;
}
.fa, .fas {
    font-weight: 900;
}
.fa, .far, .fas {
    font-family: "Font Awesome 5 Free";
}
.fa, .fab, .fad, .fal, .far, .fas {
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    display: inline-block;
    font-style: normal;
    font-variant: normal;
    text-rendering: auto;
    line-height: 1;
}
.fa-building:before {
    content: "\f1ad";
}
</style>
</head>
 
  <main id="main" class="main">
  <section class="p-4" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard my-4">
      <div class="row">

        <!-- Left side columns -->
        <!-- <div class="col-lg-12">
          <div class="row"> -->


          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $connection->query("SELECT * FROM `parcel` WHERE `agent_id` = '$agent_id';")->num_rows; ?></h3>

                <p>Total Parcels</p>
              </div>
              <div class="icon">
                <i class="bi bi-box-fill" style="color: #D54E16 !important;"></i>
              </div>
            </div>
          </div>


          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $connection->query("SELECT * FROM parcel WHERE `parcel_status` = '1' AND `agent_id` = '$agent_id';")->num_rows; ?></h3>

                <p>Item Accepted By Courier</p>
              </div>
              <div class="icon">
                <i class="bi bi-box-fill" style="color: #D54E16 !important;"></i>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $connection->query("SELECT * FROM parcel WHERE `parcel_status` = '2' AND `agent_id` = '$agent_id';")->num_rows; ?></h3>

                <p>Collected</p>
              </div>
              <div class="icon">
                <i class="bi bi-box-fill" style="color: #D54E16 !important;"></i>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $connection->query("SELECT * FROM parcel WHERE `parcel_status` = '3' AND `agent_id` = '$agent_id';")->num_rows; ?></h3>

                <p>Shipped</p>
              </div>
              <div class="icon">
                <i class="bi bi-box-fill" style="color: #D54E16 !important;"></i>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $connection->query("SELECT * FROM parcel WHERE `parcel_status` = '4' AND `agent_id` = '$agent_id';")->num_rows; ?></h3>

                <p>Delivered</p>
              </div>
              <div class="icon">
                <i class="bi bi-box-fill" style="color: #D54E16 !important;"></i>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">
                <h3><?php echo $connection->query("SELECT * FROM parcel WHERE `parcel_status` = '5' AND `agent_id` = '$agent_id';")->num_rows; ?></h3>

                <p>Unsuccessful Delivery Attempt</p>
              </div>
              <div class="icon">
                <i class="bi bi-box-fill" style="color: #D54E16 !important;"></i>
              </div>
            </div>
          </div>
          
          

            

          <!-- </div>
        </div> -->
        <!-- End Left side columns -->

        

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
  

