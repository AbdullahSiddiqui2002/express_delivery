<?php
session_start();

if (isset($_SESSION['email'])) {
  include("header.php");
  include("topbar.php");
  include("sidebar.php");
  require("../include/connection.php");

  if (isset($_POST['save_parcel']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $parcel_id = mysqli_real_escape_string($connection, $_POST["parcel_id"]);
    $sender_name = mysqli_real_escape_string($connection, $_POST["sender_name"]);
    $sender_email = mysqli_real_escape_string($connection, $_POST["sender_email"]);
    $sender_address = mysqli_real_escape_string($connection, $_POST["sender_address"]);
    $sender_contact = mysqli_real_escape_string($connection, $_POST["sender_contact"]);
    $recipient_name = mysqli_real_escape_string($connection, $_POST["recipient_name"]);
    $recipient_email = mysqli_real_escape_string($connection, $_POST["recipient_email"]);
    $recipient_address = mysqli_real_escape_string($connection, $_POST["recipient_address"]);
    $recipient_contact = mysqli_real_escape_string($connection, $_POST["recipient_contact"]);
    $parcel_description = mysqli_real_escape_string($connection, $_POST["parcel_description"]);
    $branch_id = mysqli_real_escape_string($connection, $_POST["branch_id"]);
    $weight = mysqli_real_escape_string($connection, $_POST["weight"]);
    if (empty($sender_name) || empty($sender_email) || empty($sender_contact) || empty($sender_address) || empty($recipient_name) || empty($recipient_email) || empty($recipient_contact) || empty($recipient_address) || empty($parcel_description) || empty($branch_id) || empty($weight)) {
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
    } else {
      if ($sender_email == $recipient_email || $sender_address == $recipient_address || $sender_contact == $recipient_contact) {
        echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Sender and Recipient (email, address and contact) should not be same",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    })
                  });
                  </script>';
      } else {
        if ($weight <= 0) {
          echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Weight should not be less than or equal to 0",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    })
                  });
                  </script>';
        } else {
          $amount = $weight * 500;
          $get_agentid = "SELECT * FROM `agent` WHERE branch_id = $branch_id;";
          $result_agentid = mysqli_query($connection, $get_agentid);
          if ($result_agentid) {
            if (mysqli_num_rows($result_agentid) > 0) {
              while ($row = mysqli_fetch_assoc($result_agentid)) {
                $agent_id = $row["id"];
                $tracking_id = time() . mt_rand(0, 9);
                $insert = "INSERT INTO `parcel`(`tracking_id`, `sender_name`, `sender_email`, `sender_address`, `sender_contact`, `recipient_name`, `recipient_email`, `recipient_address`, `recipient_contact`, `parcel_description`, `branch_id`, `agent_id`, `weight`, `amount`) VALUES ('$tracking_id','$sender_name','$sender_email','$sender_address','$sender_contact','$recipient_name','$recipient_email','$recipient_address','$recipient_contact','$parcel_description','$branch_id','$agent_id','$weight','$amount');";
                $result = mysqli_query($connection, $insert) or die("Failed to insert query");
                if ($result) {
                  $lastInsertedId = mysqli_insert_id($connection);
                  $parcel_status = 1;
                  $insert_parcelstatus = "INSERT INTO `parcel_tracks`( `parcel_id`, `parcel_status`) VALUES ('$lastInsertedId','$parcel_status');";
                  $result_parcelstatus = mysqli_query($connection, $insert_parcelstatus) or die("Failed to insert query");
                  if ($result_parcelstatus) {
                    echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Courier Created Succesfully",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "sendmail.php?parcel_id=' . $lastInsertedId . '&sender_name=' . $sender_name . '&sender_email=' . $sender_email . '&tracking_id=' . $tracking_id . '&parcel_status=' . $parcel_status . '";
                    });
                  });
                  </script>';
                  }
                } else {
                  echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Courier not created",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                      window.location.href = "parcel_list.php?status=All";
                  });
                  });
                  </script>';
                }
              }
            } else {
              echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "No agent found in this branch",
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
    }
  }
  ?>

  <head>
    <title>New Parcel - Express Delivery</title>
  </head>
  <style>
    label {
      font-weight: bold;
    }

    .btn-primary,
    .btn-success {
      color: #FFFFFF !important;
      background-color: #D54E16 !important;
      border-color: #D54E16 !important;
    }

    .btn-primary:hover,
    .btn-success:hover {
      color: #FFFFFF !important;
      background-color: #ca4209 !important;
      border-color: #ca4209 !important;
    }

    #amount {
      color: #FFFFFF !important;
      background-color: #D54E16 !important;
      font-size: 17px;
    }

    #amount:hover {
      color: #FFFFFF !important;
      background-color: #ca4209 !important;

    }

    input:focus,
    select:focus {
      box-shadow: none !important;
      border-color: white !important;
      outline: none !important;
    }

    input:focus,
    select:focus {
      box-shadow: #D54E16 0px 2px 16px 0px !important;
    }
  </style>

  <main id="main" class="main">
    <section class="p-5"
      style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
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
        <form class="row g-3" method="post">
          <input type="hidden" name="parcel_id" value="">

          <div class="col-md-6 my-2 pe-5">
            <h4>Sender Information</h4>
            <label for="sender_name" class="form-label">Name</label>
            <input type="text" name="sender_name" class="form-control mb-3">

            <label for="sender_email" class="form-label">Email</label>
            <input type="text" name="sender_email" class="form-control mb-3">

            <label for="sender_address" class="form-label">Address</label>
            <input type="text" name="sender_address" class="form-control mb-3">

            <label for="sender_contact" class="form-label">Contact#</label>
            <input type="text" name="sender_contact" class="form-control mb-3">
          </div>

          <div class="col-md-6 my-2 ps-5" style="border-left: 1px solid gray;">
            <h4>Recipient Information</h4>
            <label for="recipient_name" class="form-label">Name</label>
            <input type="text" name="recipient_name" class="form-control  mb-3">

            <label for="recipient_email" class="form-label">Email</label>
            <input type="text" name="recipient_email" class="form-control mb-3">

            <label for="recipient_address" class="form-label">Address</label>
            <input type="text" name="recipient_address" class="form-control  mb-3">

            <label for="recipient_contact" class="form-label">Contact#</label>
            <input type="text" name="recipient_contact" class="form-control  mb-3">
          </div>

          <hr>

          <div class="col-md-12 my-2">
            <label for="parcel_description" class="form-label">Parcel Description</label>
            <textarea class="form-control mb-3" name="parcel_description" rows="5"
              placeholder="Enter parcel description"></textarea>
          </div>

          <div class="col-md-6">
            <label for="" class="form-label">Branch Processed</label>
            <select name="branch_id" id="" class="form-control select2">
              <option value=""></option>
              <?php

              $read = "SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches;";
              $result = mysqli_query($connection, $read);
              if ($result) {
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value=" . $row['id'] . ">" . $row['branch_code'] . " | " . (ucwords($row['address'])) . "</option>";
                  }
                } else {
                  echo "<option>No Branch Found</option>";
                }
              }
              ?>


            </select>
          </div>

          <div class="col-md-6">
            <label for="weight" class="form-label">Weight (Rs. 500 Per Kg)</label>
            <input type="number" name="weight" class="form-control mb-3" placeholder="Enter Weight in Kg" id="weight">
            <p class="badge text-bg-danger bg-gradient text-light" id="alert_weight" style="display:none;">Weight should
              not be less than or equal to 0.</p>
          </div>

          <div class="col-md-6">
            <span class="fw-bold">Amount: </span>
            <span class='badge text-bg-primary bg-gradient text-light' id="amount"></span>
          </div>




          <script>

            let calculate = () => {
              let input_weight = document.getElementById("weight");
              let amount = document.getElementById("amount");
              let weight = input_weight.value;
              let alert_weight = document.getElementById("alert_weight");

              console.log(weight);
              if (weight > 0) {
                let total = weight * 500;

                amount.innerHTML = total;
                alert_weight.style.display = "none";
              }
              else {
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
  include("footer.php");
} else {
  header("location: login.php");
}
?>