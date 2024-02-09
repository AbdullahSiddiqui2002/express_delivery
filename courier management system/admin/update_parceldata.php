<head>
<title>Update Parcel Data - Express Delivery</title>
  </head>
<?php
session_start();
if(isset($_SESSION['email'])){
  include("header.php");
require("../include/connection.php");


$parcel_id = $_POST["parcel_id"];
$sender_name = $_POST["sender_name"];
  $sender_email = $_POST["sender_email"];
  $sender_address = $_POST["sender_address"];
  $sender_contact = $_POST["sender_contact"];
  $recipient_name = $_POST["recipient_name"];
  $recipient_email = $_POST["recipient_email"];
  $recipient_address = $_POST["recipient_address"];
  $recipient_contact = $_POST["recipient_contact"];
  $parcel_description = $_POST["parcel_description"];
  $branch_id = $_POST["branch_id"];
  $weight = $_POST["weight"];

  if(empty($sender_name) || empty($sender_email) || empty($sender_contact) || empty($sender_address) || empty($recipient_name) || empty($recipient_email) || empty($recipient_contact) || empty($recipient_address) || empty($parcel_description) || empty($branch_id) || empty($weight)){
    echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Please fill all fields",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                      window.location.href = "update_parcel.php?parcel_id='.$parcel_id.'";
                    });
                  });
                  </script>';
  }
  else{
  if($sender_email == $recipient_email || $sender_address == $recipient_address || $sender_contact == $recipient_contact){
    echo '<script>
  $(document).ready(function () {
    Swal.fire({
      title: "Sender and Recipient (email, address, and contact) should not be the same",
      icon: "error",
      showConfirmButton: false,
      timer: 2000
    }).then(() => {
      window.location.href = "update_parcel.php?parcel_id='.$parcel_id.'";
    });
  });
</script>';

  }
  else{
    if($weight <= 0){
      echo '<script>
  $(document).ready(function () {
    Swal.fire({
      title: "Weight should not be less than or equal to 0",
      icon: "error",
      showConfirmButton: false,
      timer: 2000
    }).then(() => {
        window.location.href = "update_parcel.php?parcel_id='.$parcel_id.'";
    });
  });
</script>';

    }
    else{
      $amount = $weight * 500;
      $get_agentid = "SELECT * FROM `agent` WHERE branch_id = $branch_id;";
      $result_agentid = mysqli_query($connection,$get_agentid);
      if($result_agentid){
        if(mysqli_num_rows($result_agentid) > 0){
          while($row = mysqli_fetch_assoc($result_agentid)){
            $agent_id = $row["id"];
            $update = "UPDATE `parcel` SET `sender_name`='$sender_name',`sender_email`='$sender_email',`sender_address`='$sender_address',`sender_contact`='$sender_contact',`recipient_name`='$recipient_name',`recipient_email`='$recipient_email',`recipient_address`='$recipient_address',`recipient_contact`='$recipient_contact',`parcel_description`='$parcel_description',`branch_id`='$branch_id',`agent_id`='$agent_id',`weight`='$weight',`amount`='$amount' WHERE `id` = '$parcel_id';";
            $result = mysqli_query($connection, $update) or die("Failed to insert query");
            if ($result) {
              echo '<script>
              $(document).ready(function () {
                Swal.fire({
                  title: "Courier Updated Succesfully",
                  icon: "success",
                  showConfirmButton: false,
                  timer: 2000
                }).then(() => {
                    window.location.href = "parcel_list.php?status=All";
                });
              });
            </script>';
            } 
            else {
              echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Courier not Updated",
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
        }
        else{
          echo '<script>
  $(document).ready(function () {
    Swal.fire({
      title: "No agent found in this branch",
      icon: "error",
      showConfirmButton: false,
      timer: 2000
    }).then(() => {
        window.location.href = "update_parcel.php?parcel_id='.$parcel_id.'";
    });
  });
</script>';

        }     
      }  
    }
  }
}}
else{
    header("location: login.php");
  }
    
  ?>