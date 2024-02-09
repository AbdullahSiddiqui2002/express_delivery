<?php
session_start();
if(isset($_SESSION['email'])){
include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");
$read = "SELECT * FROM `contact` ORDER BY id DESC;";
$result = mysqli_query($connection,$read);
if($result){
   
    
?>
<head>
<title>User Messages - Express Delivery</title>
</head>
  <main id="main" class="main">
  <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>User Messages</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">User</li>
          <li class="breadcrumb-item active">Messages</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section my-4">
      <div class="col-lg-12">
        <table class="table table-bordered text-center">
          <thead>
            <tr>
                <th scope="col">#</th>
			    <th scope="col">Name</th>
			    <th scope="col">Email</th>
			    <th scope="col">Message</th>
			    <th scope="col">Date & Time Sent</th>
			    <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody  id="branch_tablebody">
            <?php
              if(mysqli_num_rows($result) > 0){
              $i=1;
                while($row = mysqli_fetch_assoc($result)){
                  $message_id = $row["id"]; 
                  $datetime = $row["date_created"];
                  $timestamp = strtotime($datetime);
                  $date = date("Y-m-d", $timestamp);
                  $time24Hour  = date("H:i:s", $timestamp);
                  $time12Hour = date("h:i A", strtotime($time24Hour));
                  echo "<tr>
                    <td>".$i."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["message"]."</td>
                    <td>".$date." ".$time12Hour."</td>       
                    <td class='text-center'>
                    <div class='btn-group'>
                      <a href='delete_user_message.php?message_id=".$row["id"]."' class='btn btn-danger btn-flat'><i class='fas fa-trash'></i></a>
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