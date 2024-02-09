<?php 
session_start();
if(isset($_SESSION['email'])){
    include("header.php");
    require("../include/connection.php");

    if(isset($_GET['branch_id'])){
        $branch_id = $_GET['branch_id'];

        // Delete records from the 'parcel_tracks' table first
        $delete_parcel_tracks = "DELETE FROM `parcel_tracks` WHERE `parcel_id` IN (SELECT `id` FROM `parcel` WHERE `branch_id` = '$branch_id');";
        $result_parcel_tracks = mysqli_query($connection, $delete_parcel_tracks) or die("failed to delete parcel_tracks records.");

        if($result_parcel_tracks){
            // Now, delete records from the 'parcel' table
            $delete_parcel = "DELETE FROM `parcel` WHERE `branch_id` = '$branch_id';";
            $result_parcel = mysqli_query($connection, $delete_parcel) or die("failed to delete parcel records.");

            if($result_parcel){
                // Now, delete records from the 'agent' table
                $delete_agent = "DELETE FROM `agent` WHERE `branch_id` = '$branch_id';";
                $result_agent = mysqli_query($connection, $delete_agent) or die("failed to delete agent records.");

                if($result_agent){
                    // Finally, delete the branch record
                    $delete_branch = "DELETE FROM `branches` WHERE id = '$branch_id';";
                    $result_branch = mysqli_query($connection, $delete_branch) or die("failed to delete branch.");

                    if($result_branch){
                        echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Branch deleted successfully!",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "branch_list.php";
                            });
                          });
                          </script>';
                    } else {
                        echo '<script>
            $(document).ready(function () {
                            Swal.fire({
                                title: "Sorry, Failed to delete this branch",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = "branch_list.php";
                            });
                          });
                          </script>';
                        
                    }
                } else {
                    header("location: branch_list.php");
                }
            } else {
                header("location: branch_list.php");
            }
        } else {
            header("location: branch_list.php");
        }
    } else {
        header("location: branch_list.php");
    }
} else {
    header("location: login.php");
}
?>
