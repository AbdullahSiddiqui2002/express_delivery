<head>
<title>Update Agent Data - Express Delivery</title>
  </head>
<?php
session_start();
if(isset($_SESSION['email'])){
  include("header.php");
require("../include/connection.php");


$agent_id = $_POST["agent_id"];
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$branch_id = $_POST["branch_id"];
$email = $_POST["email"];
$password = $_POST["password"];

if(empty( $firstname) || empty( $lastname) || empty($branch_id) || empty($email)){
  echo '<script>
  $(document).ready(function () {
                  Swal.fire({
                      title: "Please fill all fields",
                      icon: "error",
                      showConfirmButton: false,
                      timer: 2000
                  }).then(() => {
                    window.location.href = "update_agent.php?agent_id='.$agent_id.'";
                });
                });
                </script>';
}
else{
$encryptedpassword = password_hash($password, PASSWORD_BCRYPT);

$update = "UPDATE `agent` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$encryptedpassword',`branch_id`='$branch_id' WHERE id = '$agent_id';";
    
    $result=mysqli_query($connection , $update) or die("failed to insert query.");
if($result){
  echo '<script>
  $(document).ready(function () {
                  Swal.fire({
                      title: "Agent Details Updated",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 2000
                  }).then(() => {
                      window.location.href = "agent_list.php";
                  });
                });
                </script>';
}
else{
  echo '<script>
  $(document).ready(function () {
                  Swal.fire({
                      title: "Agent Details not Updated",
                      icon: "error",
                      showConfirmButton: false,
                      timer: 2000
                  }).then(() => {
                    window.location.href = "agent_list.php";
                });
                });
                </script>';
}
}}
else{
    header("location: login.php");
  }
    
  ?>