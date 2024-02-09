<?php
session_start();
if(isset($_SESSION['email'])){
    if($_GET['agent_id']){
        include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");
      $agent_id=$_GET['agent_id'];
    $getdata="SELECT * FROM `agent` WHERE id='$agent_id';";

    $result=mysqli_query($connection, $getdata) or die("fail to run query");

    if(mysqli_num_rows($result) == 1){
$row=mysqli_fetch_assoc($result);

 $firstname = $row["firstname"];
 $lastname = $row["lastname"];
 $email = $row["email"];
 $password = $row["password"];
 $branch_id = $row["branch_id"];
 
       
      ?>
      <head>
<title>Update Agent - Express Delivery</title>
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
      <h1>Edit Agent</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Agent</li>
          <li class="breadcrumb-item active">Edit</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
       
    <section class="section my-5">
    <form class="row g-3"  id="agent_form" action="update_agentdata.php" method="post">
    <input type="hidden" name="agent_id" value="<?php echo $agent_id ?>">

    <div class="row">
        <div class="col-md-6">
          <label for="" class="form-label">First Name</label>
          <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" id="">
        </div>
        <div class="col-md-6">
          <label for="" class="form-label">Last Name</label>
          <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" id="">
        </div>
    </div>

            <div class="row my-3">
              <div class="col-md-6">
                <label for="" class="form-label">Branch</label>
                <select name="branch_id" id="" class="form-control select2">
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

                    $read_branches = "SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches;";
                    $result_branches = mysqli_query($connection,$read_branches);
                    if($result_branches){
                      if(mysqli_num_rows($result_branches) > 0){
                        while($row_branches = mysqli_fetch_assoc($result_branches)){
                          echo "<option value=".$row_branches['id'].">".$row_branches['branch_code']." | ".(ucwords($row_branches['address']))."</option>";
                        }
                      }
                      else{
                      echo "<option>No Branch Found</option>";
                      }
                    }
                  ?>
                  

                </select>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <label for="" class="form-label">Email</label>
                <input type="email" name="email" id="" class="form-control" value="<?php echo $email ?>">
              </div>
            </div>
            <div class="row  my-3">
              <div class="col-md-6">
                <label for="" class="form-label">Password</label>
                <input type="password" name="password"  value="" id="" class="form-control">
                <p><i>Leave this blank if you dont want to change this</i></p>
              </div>
            </div>   
            <div class="d-flex w-100 justify-content-center align-items-center mt-5">
      <input type="submit" class="btn btn-success mx-2" name="save_agent" value="Save">
  			<a class="btn btn-secondary mx-2" href="agent_list.php">Cancel</a>
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
      header("location: agent_list.php");
    }
}
else{
  header("location: login.php");
}

      ?>
 