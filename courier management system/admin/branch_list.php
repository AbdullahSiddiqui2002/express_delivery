<?php
session_start();
if(isset($_SESSION['email'])){
include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");
$read = "SELECT * FROM `branches` ORDER BY id DESC;";
$result = mysqli_query($connection,$read);
if($result){
   
    
?>
<head>
<title>Branch List - Express Delivery</title>
</head>
  <main id="main" class="main">
  <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>Branch List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Branch</li>
          <li class="breadcrumb-item active">List</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section my-4">
      <div class="col-lg-12">
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Branch Code</th>
			        <th scope="col">Street / Building</th>
			        <th scope="col">City / State / Zip</th>
			        <th scope="col">Country</th>
			        <th scope="col">Contact #</th>
			        <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody  id="branch_tablebody">
            <?php
              if(mysqli_num_rows($result) > 0){
              $i=1;
                while($row = mysqli_fetch_assoc($result)){
                  $branch_id = $row["id"]; 
                  echo "<tr>
                    <td>".$i."</td>
                    <td>".$row["branch_code"]."</td>
                    <td>".$row["street"]."</td>
                    <td>".$row["city"]." / ".$row["state"]." / ".$row["zip_code"]."</td>
                    <td>".$row["country"]."</td>
                    <td>".$row["contact"]."</td>          
                    <td class='text-center'>
                    <div class='btn-group'>
                      <a href='update_branch.php?branch_id=".$row["id"]."' class='btn btn-primary btn-flat'><i class='fas fa-edit'></i></a>
                      <a href='delete_branch.php?branch_id=".$row["id"]."' class='btn btn-danger btn-flat'><i class='fas fa-trash'></i></a>
                    </div>
                    </td>          
                  </tr>";
                  $i++;
                }
              }
              else{
                echo '<script>
                $(document).ready(function () {
                                Swal.fire({
                                    title: "No Record Found",
                                    icon: "info",
                                    showConfirmButton: false,
                                    timer: 2000
                                })
                              });
                              </script>';
              }
              ?>
          </tbody>
        </table>
        <?php
          }
        ?>
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