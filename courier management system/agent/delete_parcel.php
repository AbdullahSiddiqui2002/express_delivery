<head>
<title>Delete Parcel - Express Delivery</title>
  </head>
<?php 
session_start();
if(isset($_SESSION['email'])){
   include("header.php");
require("../include/connection.php");

if($_GET['parcel_id']){

   $parcel_id=$_GET['parcel_id'];

   $delete_parcel="DELETE FROM `parcel_tracks` WHERE `parcel_id` = '$parcel_id';";
   $result_parcel=mysqli_query($connection , $delete_parcel) or die("failed to insert query.");
   if($result_parcel){
      $delete="DELETE FROM `parcel` WHERE id = '$parcel_id';";

$result=mysqli_query($connection , $delete) or die("failed to insert query.");
if($result){
   echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Courier deleted successfully!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "parcel_list.php?status=All";
                            });
                          });
                          </script>';
}
else{
   echo '<script>
   $(document).ready(function () {
                   Swal.fire({
                       title: "Sorry, Failed to delete this courier",
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
   else{
      header("location: parcel_list.php?status=All");
   }

}
else{
    header("location: parcel_list.php?status=All");
}
}
else{
   header("location: login.php");
 }
?>