<?php
session_start();
if(isset($_SESSION['email'])){
    if($_GET['parcel_id']){
        include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");
      $parcel_id=$_GET['parcel_id'];
    $getdata="SELECT * FROM `parcel` WHERE id='$parcel_id';";

    $result=mysqli_query($connection, $getdata) or die("fail to run query");

    if(mysqli_num_rows($result) == 1){
$row=mysqli_fetch_assoc($result);

 $sender_name = $row["sender_name"];    
 $sender_email = $row["sender_email"];    
 $sender_address = $row["sender_address"];    
 $sender_contact = $row["sender_contact"];    
 $recipient_name = $row["recipient_name"];    
 $recipient_email = $row["recipient_email"];    
 $recipient_address = $row["recipient_address"];    
 $recipient_contact = $row["recipient_contact"];
 $parcel_description = $row["parcel_description"];    
 $branch_id = $row["branch_id"];
 $weight = $row["weight"];    
 $amount = $row["amount"];    
      ?>
      <head>
<title>Update Parcel - Express Delivery</title>
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
input:focus ,select:focus{
     box-shadow: none !important;
    border-color: white !important;
    outline: none !important;
}
input:focus ,select:focus{
  box-shadow: #D54E16 0px 2px 16px 0px !important;
}
  </style>

<main id="main" class="main">
<section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
<div class="pagetitle">
  <h1>New Parcel</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Parcel</li>
      <li class="breadcrumb-item active">Add New</li>
    </ol>
  </nav>
  <hr>
</div><!-- End Page Title -->
<section class="section my-5">
  <form class="row g-3"  method="post" action="update_parceldata.php">
    <input type="hidden" name="parcel_id" value="<?php echo $parcel_id ?>">
  
    <div class="col-md-6 my-2 pe-5">
      <h4>Sender Information</h4>
      <label for="sender_name" class="form-label">Name</label>
      <input type="text" name="sender_name" class="form-control mb-3" value="<?php echo $sender_name ?>" required="required">

      <label for="sender_email" class="form-label">Email</label>
      <input type="text" name="sender_email" class="form-control mb-3" value="<?php echo $sender_email ?>" required="required">

      <label for="sender_address" class="form-label">Address</label>
      <input type="text" name="sender_address" class="form-control mb-3" value="<?php echo $sender_address ?>" required="required">

      <label for="sender_contact" class="form-label">Contact#</label>
      <input type="text" name="sender_contact" class="form-control mb-3" value="<?php echo $sender_contact ?>" required="required">
    </div>
    
    <div class="col-md-6 my-2 ps-5" style="border-left: 1px solid gray;">
      <h4>Recipient Information</h4>
      <label for="recipient_name" class="form-label">Name</label>
      <input type="text" name="recipient_name" class="form-control  mb-3" value="<?php echo $recipient_name ?>" required="required">

      <label for="recipient_email" class="form-label">Email</label>
      <input type="text" name="recipient_email" class="form-control mb-3" value="<?php echo $recipient_email ?>" required="required">

      <label for="recipient_address" class="form-label">Address</label>
      <input type="text" name="recipient_address" class="form-control  mb-3" value="<?php echo $recipient_address ?>" required="required">

      <label for="recipient_contact" class="form-label">Contact#</label>
      <input type="text" name="recipient_contact" class="form-control  mb-3" value="<?php echo $recipient_contact ?>" required="required">
    </div>

    <hr>

    <div class="col-md-12 my-2">
      <label for="parcel_description" class="form-label">Parcel Description</label>
      <textarea class="form-control mb-3" name="parcel_description" rows="5" placeholder="Enter parcel description" required="required"><?php echo  $parcel_description ?></textarea>
    </div>

    <div class="col-md-6">
            <label for="" class="form-label">Branch Processed</label>
            <select name="branch_id" id="" class="form-control select2"  required="required">
            <?php
                    $read_updateid = "SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id = '$branch_id';";
                    $result_updateid = mysqli_query($connection,$read_updateid);
                    if($result_updateid){
                       if(mysqli_num_rows($result_updateid) > 0){
                         while($row_updateid = mysqli_fetch_assoc($result_updateid)){
                            echo "<option value=".$row_updateid['id'].">".$row_updateid['branch_code']." | ".(ucwords($row_updateid['address']))."</option>";
                         }
                       }
                   }
                    ?>
              <?php

                $read = "SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches;";
                $result = mysqli_query($connection,$read);
                if($result){
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                      echo "<option value=".$row['id'].">".$row['branch_code']." | ".(ucwords($row['address']))."</option>";
                    }
                  }
                  else{
                  echo "<option>No Branch Found</option>";
                  }
                }
              ?>
              

            </select>
          </div>

    <div class="col-md-6">
    <label for="weight" class="form-label">Weight (Rs. 500 Per Kg)</label>
      <input type="number" name="weight" class="form-control mb-3" required="required" placeholder="Enter Weight in Kg" id="weight" value="<?php echo $weight ?>">
      <p class="badge text-bg-danger bg-gradient text-light" id="alert_weight" style="display:none;">Weight should not be less than or equal to 0.</p>
    </div>

    <div class="col-md-6">
      <span class="fw-bold">Amount: </span>
    <span class='badge text-bg-primary bg-gradient text-light' id="amount"><?php echo $amount ?></span>
    </div>



    
        <script>
          
          let calculate = () => {
            let input_weight = document.getElementById("weight");
          let amount = document.getElementById("amount");
          let weight = input_weight.value;
          let alert_weight = document.getElementById("alert_weight");

          console.log(weight);
          if(weight > 0){
            let total = weight * 500;
            
            amount.innerHTML = total;
            alert_weight.style.display = "none";
          }
          else{
            alert_weight.style.display = "block";
            amount.innerHTML = "";
          }
          
          }
          weight.addEventListener("keyup", calculate);
        </script>
    
 
    <div class="d-flex w-100 justify-content-center align-items-center mt-5">
            <input type="submit" class="btn btn-success mx-2" name="save_parcel" value="Save">
            <a class="btn btn-secondary mx-2" href="parcel_list.php?status=All">Cancel</a>
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
      header("location: parcel_list.php?status=All");
    }
}
else{
  header("location: login.php");
}

      ?>
 