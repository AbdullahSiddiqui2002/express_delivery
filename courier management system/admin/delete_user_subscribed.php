<head>
<title>Delete User Subscribed Email - Express Delivery</title>
  </head>
<?php 
session_start();
if(isset($_SESSION['email'])){
   include("header.php");
require("../include/connection.php");

if($_GET['subscribe_id']){

   $subscribe_id=$_GET['subscribe_id'];


$delete="DELETE FROM `subscribed_emails` WHERE id = '$subscribe_id';";

$result=mysqli_query($connection , $delete) or die("failed to insert query.");
if($result){
   echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Subscribed email deleted successfully!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "user_messages.php";
                            });
                          });
                          </script>';
}
else{
   echo '<script>
   $(document).ready(function () {
                   Swal.fire({
                       title: "Sorry, Failed to delete this subscribed email",
                       icon: "error",
                       showConfirmButton: false,
                       timer: 2000
                   }).then(() => {
                       window.location.href = "user_messages.php";
                   });
                 });
                 </script>';
}}
else{
   header("location: user_messages.php");
}
}
else{
   header("location: login.php");
 }
?>
