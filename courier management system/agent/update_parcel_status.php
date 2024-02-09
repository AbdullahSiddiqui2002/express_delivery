<?php
session_start();
include("header.php");
require("../include/connection.php");

if(isset($_SESSION['email'])) {
    if(isset($_POST["parcel_id"], $_POST["parcel_status_id"], $_POST["sender_name"], $_POST["sender_email"], $_POST["tracking_id"])) {
        $parcel_id = $_POST["parcel_id"];
        $parcel_status_id = $_POST["parcel_status_id"];
        $sender_name = $_POST["sender_name"];
        $sender_email = $_POST["sender_email"];
        $tracking_id = $_POST["tracking_id"];

        $update = "UPDATE `parcel` SET `parcel_status`='$parcel_status_id' WHERE `id` = '$parcel_id';";
        $result = mysqli_query($connection, $update);

        if ($result) {
            $insert_parcelstatus = "INSERT INTO `parcel_tracks`(`parcel_id`, `parcel_status`) VALUES ('$parcel_id','$parcel_status_id');";
            $result_parcelstatus = mysqli_query($connection, $insert_parcelstatus);

            if ($result_parcelstatus) {
                echo '<script>
                    $(document).ready(function () {
                        Swal.fire({
                            title: "Status Updated Successfully",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "sendmail.php?parcel_id=' . $parcel_id . '&sender_name=' . $sender_name . '&sender_email=' . $sender_email . '&tracking_id=' . $tracking_id . '&parcel_status=' . $parcel_status_id . '";
                        });
                    });
                </script>';
            } else {
                echo '<script>
                    $(document).ready(function () {
                        Swal.fire({
                            title: "Failed to update parcel status",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "parcel_list.php?status=All";
                        });
                    });
                </script>';
            }
        } else {
            echo '<script>
                $(document).ready(function () {
                    Swal.fire({
                        title: "Failed to update parcel status",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.href = "parcel_list.php?status=All";
                    });
                });
            </script>';
        }
    } else {
        echo '<script>
            $(document).ready(function () {
                Swal.fire({
                    title: "Invalid form submission",
                    icon: "error",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = "parcel_list.php?status=All";
                });
            });
        </script>';
    }
} else {
    header("location: login.php");
}
?>
