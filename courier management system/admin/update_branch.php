<?php
session_start();
if(isset($_SESSION['email'])){
    if($_GET['branch_id']){
        include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");
      $branch_id=$_GET['branch_id'];
    $getdata="SELECT * FROM `branches` WHERE id='$branch_id';";

    $result=mysqli_query($connection, $getdata) or die("fail to run query");

    if(mysqli_num_rows($result) == 1){
$row=mysqli_fetch_assoc($result);

 $branch_code = $row["branch_code"];
 $branch_street = $row["street"];
 $branch_city = $row["city"];
 $branch_state = $row["state"];
 $branch_zip = $row["zip_code"];
 $branch_country = $row["country"];
 $branch_contact = $row["contact"];      
      ?>
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
input:focus ,select:focus{
     box-shadow: none !important;
    border-color: white !important;
    outline: none !important;
}
input:focus ,select:focus{
  box-shadow: #D54E16 0px 2px 16px 0px !important;
}
  </style>
  <head>
<title>Update Branch - Express Delivery</title>
  </head>
  <main id="main" class="main">
  <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>Edit Branch</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Branch</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
       <section class="section my-5">
      <form class="row g-3" id="branch_form" action="update_branchdata.php" method="post">
    <input type="hidden" name="branch_id" value="<?php echo $branch_id ?>" id="branch_id">
      
        <div class="col-md-6">
          <label for="Street" class="form-label">Street/Building</label>
          <input type="text" name="branch_Street" class="form-control" value="<?php echo $branch_street ?>" id="branch_Street">
        </div>
        <div class="col-md-6">
          <label for="City" class="form-label">City</label>
          <input type="text" name="branch_City" class="form-control" value="<?php echo $branch_city ?>" id="branch_City">
        </div>
        <div class="col-md-6">
          <label for="State" class="form-label">State</label>
          <input type="text" name="branch_State" class="form-control" value="<?php echo $branch_state ?>" id="branch_State">
        </div>
        <div class="col-md-6">
          <label for="Zip" class="form-label">Zip Code/ Postal Code</label>
          <input type="text" name="branch_Zip" class="form-control" value="<?php echo $branch_zip ?>" id="branch_Zip">
        </div>
        <div class="col-md-6">
          <label for="Country" class="form-label">Country</label>
          <input type="text" name="branch_Country" class="form-control" value="<?php echo $branch_country ?>" id="branch_Country">
        </div>
        <div class="col-md-6">
          <label for="Contact" class="form-label">Contact#</label>
          <input type="text" name="branch_Contact" class="form-control" value="<?php echo $branch_contact ?>" id="branch_Contact">
        </div>
     
      <div class="d-flex w-100 justify-content-center align-items-center mt-5">
  			<button class="btn btn-success mx-2" id="savebranch_btn">Save</button>
  			<a class="btn btn-secondary mx-2" href="branch_list.php">Cancel</a>
  		</div>
      </form>
    </section>
    </section>
 </main><!-- End #main -->


    <?php
    }
    include("footer.php");
    }
    else{
      header("location: branch_list.php");
    }
}
else{
  header("location: login.php");
}

      ?>
 