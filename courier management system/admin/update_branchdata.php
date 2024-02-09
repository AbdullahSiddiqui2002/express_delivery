<head>
<title>Update Branch Data - Express Delivery</title>
  </head>
<?php
session_start();
if(isset($_SESSION['email'])){
  include("header.php");
require("../include/connection.php");


$branch_id = $_POST["branch_id"];
$branch_Street = $_POST["branch_Street"];
$branch_City = $_POST["branch_City"];
$branch_State = $_POST["branch_State"];
$branch_Zip = $_POST["branch_Zip"];
$branch_Country = $_POST["branch_Country"];
$branch_Contact = $_POST["branch_Contact"];
if(empty($branch_Street) || empty($branch_City) || empty($branch_State) || empty($branch_Zip) || empty($branch_Country) || empty($branch_Contact)){
  echo '<script>
  $(document).ready(function () {
                  Swal.fire({
                      title: "Please fill all fields",
                      icon: "error",
                      showConfirmButton: false,
                      timer: 2000
                  }).then(() => {
                    window.location.href = "update_branch.php?branch_id='.$branch_id.'";
                });
                });
                </script>';
}
else{
    $update = "UPDATE `branches` SET `street`='$branch_Street',`city`='$branch_City',`state`='$branch_State',`zip_code`='$branch_Zip',`country`='$branch_Country',`contact`='$branch_Contact' WHERE `id`='$branch_id';";
    
    $result=mysqli_query($connection , $update) or die("failed to insert query.");
if($result){
  echo '<script>
  $(document).ready(function () {
                  Swal.fire({
                      title: "Branch Details Updated",
                      icon: "success",
                      showConfirmButton: false,
                      timer: 2000
                  }).then(() => {
                      window.location.href = "branch_list.php";
                  });
                });
                </script>';
}
else{
  echo '<script>
  $(document).ready(function () {
                  Swal.fire({
                      title: "Branch Details not Updated",
                      icon: "error",
                      showConfirmButton: false,
                      timer: 2000
                  }).then(() => {
                    window.location.href = "branch_list.php";
                });
                });
                </script>';
}
}}
else{
    header("location: login.php");
  }
    
  ?>