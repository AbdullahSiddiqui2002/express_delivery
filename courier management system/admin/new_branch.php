<?php

session_start();
if(isset($_SESSION['email'])){
include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");

if(isset($_POST['save_branch'])  && $_SERVER['REQUEST_METHOD']=="POST"){
  $branch_id = mysqli_real_escape_string($connection,$_POST["branch_id"]);
  $branch_Street = mysqli_real_escape_string($connection,$_POST["branch_Street"]);
  $branch_City = mysqli_real_escape_string($connection,$_POST["branch_City"]);
  $branch_State = mysqli_real_escape_string($connection,$_POST["branch_State"]);
  $branch_Zip = mysqli_real_escape_string($connection,$_POST["branch_Zip"]);
  $branch_Country = mysqli_real_escape_string($connection,$_POST["branch_Country"]);
  $branch_Contact = mysqli_real_escape_string($connection,$_POST["branch_Contact"]);
  if(empty($branch_Street) || empty($branch_City) || empty($branch_State) || empty($branch_Zip) || empty($branch_Country) || empty($branch_Contact)){
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
  $branch_code = uniqid();

  $check = "SELECT * FROM `branches` where street='$branch_Street' && city='$branch_City' && state='$branch_State' && zip_code='$branch_Zip' && country='$branch_Country' && contact='$branch_Contact';";
    $result_branch = mysqli_query($connection, $check) or die("failed");
    if(mysqli_num_rows($result_branch) > 0){
        echo '<script>
        $(document).ready(function () {
                        Swal.fire({
                            title: "Branch already exist",
                            icon: "info",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "branch_list.php";
                        });
                      });
                      </script>';
    }
    else{
  $insert = "INSERT INTO `branches`(`id`, `branch_code`, `street`, `city`, `state`, `zip_code`, `country`, `contact`) VALUES ('$branch_id','$branch_code','$branch_Street','$branch_City','$branch_State','$branch_Zip','$branch_Country','$branch_Contact');";
  $result = mysqli_query($connection, $insert) or die("Failed to insert query");
  if ($result) {
    echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Branch Created Succesfully",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "branch_list.php";
                    });
                  });
                  </script>';
} else {
    echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Branch Not Created",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                      window.location.href = "new_branch.php";
                  });
                  });
                  </script>';
}
}
}
}
?>
<head>
<title>New Branch - Express Delivery</title>
</head>
   <style>
    label{
    font-weight: bold;
    }
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
  <main id="main" class="main">
    <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>New Branch</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Branch</li>
          <li class="breadcrumb-item active">Add New</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    
    <section class="section my-5">
      <form class="row g-3"  method="post" >
        <input type="hidden" name="branch_id" value="" id="branch_id">
      
        <div class="col-md-6">
          <label for="Street" class="form-label">Street/Building</label>
          <input type="text" name="branch_Street" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="City" class="form-label">City</label>
          <input type="text" name="branch_City" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="State" class="form-label">State</label>
          <input type="text" name="branch_State" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="Zip" class="form-label">Zip Code/ Postal Code</label>
          <input type="text" name="branch_Zip" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="Country" class="form-label">Country</label>
          <input type="text" name="branch_Country" class="form-control">
        </div>
        <div class="col-md-6">
          <label for="Contact" class="form-label">Contact#</label>
          <input type="text" name="branch_Contact" class="form-control">
        </div>
     
        <div class="d-flex w-100 justify-content-center align-items-center mt-5">
  			  <input type="submit" class="btn btn-success mx-2" name="save_branch" value="Save">
  			  <a class="btn btn-secondary mx-2" href="branch_list.php">Cancel</a>
  		  </div>
      </form>
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