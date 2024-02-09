<head>
<title>Delete Agent - Express Delivery</title>
  </head>
<?php 
session_start();
if(isset($_SESSION['email'])){
   include("header.php");
require("../include/connection.php");

if($_GET['agent_id']){

   $agent_id=$_GET['agent_id'];

   // Delete records from the 'parcel_tracks' table first
   $delete_parcel_tracks = "DELETE FROM `parcel_tracks` WHERE `parcel_id` IN (SELECT `id` FROM `parcel` WHERE `agent_id` = '$agent_id');";
   $result_parcel_tracks = mysqli_query($connection, $delete_parcel_tracks) or die("failed to delete parcel_tracks records.");

   if($result_parcel_tracks){

   $delete_parcel="DELETE FROM `parcel` WHERE `agent_id` = '$agent_id';";
   $result_parcel=mysqli_query($connection , $delete_parcel) or die("failed to insert query.");
   if($result_parcel){
      $delete="DELETE FROM `agent` WHERE id = '$agent_id';";

      $result=mysqli_query($connection , $delete) or die("failed to insert query.");
      if($result){
         echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Agent deleted successfully!",
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
                             title: "Sorry, Failed to delete this agent",
                             icon: "error",
                             showConfirmButton: false,
                             timer: 2000
                         }).then(() => {
                             window.location.href = "agent_list.php";
                         });
                       });
                       </script>';
      }
   }
   else{
      header("location: agent_list.php");
   }

}
else{
   header("location: agent_list.php");
}
}


else{
   header("location: agent_list.php");
}
}
else{
   header("location: login.php");
 }
?>
