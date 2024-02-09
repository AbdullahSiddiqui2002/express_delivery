<?php
session_start();
if(isset($_SESSION['email'])){
    include("header.php");
    include("topbar.php");
    include("sidebar.php");
    require("../include/connection.php");

    $agent_id = $_SESSION['id'];
?>
<head>
<title>Track Parcel - Express Delivery</title>
  </head>
<style>
  li {
    list-style-type: none;
  }
  .btn-primary, .btn-success {
    color: #FFFFFF !important;
    background-color: #D54E16 !important;
    border-color: #D54E16 !important;
}
.btn-primary:hover, .btn-success:hover{
    color: #FFFFFF !important;
    background-color: #ca4209 !important;
    border-color: #ca4209 !important;
}
input:focus ,select:focus{
     box-shadow: none !important;
    border-color: white !important;
    outline: none !important;
}
input:focus ,select:focus{
  box-shadow: #D54E16 0px 2px 16px 0px !important;
}
table{
    border: 1px solid #D54E16 !important;
}
</style>

<main id="main" class="main">
<section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
        <h1>Track</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Track Parcel</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section my-5">
        <form class="row g-3" method="post">
            <div class="col-md-8 mx-auto">
                <div class="input-group">
                    <span class="mx-4 my-2 fw-bold">Enter Tracking Number</span>
                    <input type="text" class="form-control" name="tracking_id">
                    <button class="btn btn-primary" name="track_btn" type="submit"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
        <?php
        if(isset($_POST['track_btn'])  && $_SERVER['REQUEST_METHOD']=="POST"){
          $tracking_id = mysqli_real_escape_string($connection, $_POST["tracking_id"]);
            if(empty($tracking_id)){
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
            }
            else{
          $read = "SELECT * FROM `parcel` WHERE `tracking_id` = '$tracking_id' AND `agent_id` = '$agent_id';";
          $result = mysqli_query($connection, $read);
          if ($result) {
              if (mysqli_num_rows($result) > 0) {
        ?>
        <div class="row my-5">
            <div class="col-md-8 mx-auto">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $parcel_id = $row["id"];
                                        $read_parcelstatus = "SELECT * FROM `parcel_tracks` WHERE `parcel_id` = '$parcel_id';";
                                        $result_parcelstatus = mysqli_query($connection, $read_parcelstatus);
                                        if ($result_parcelstatus) {
                                            if (mysqli_num_rows($result_parcelstatus) > 0) {
                                                while ($row_parcelstatus = mysqli_fetch_assoc($result_parcelstatus)) {
                                                    $datetime = $row_parcelstatus["date_created"];
                                                    $timestamp = strtotime($datetime);
                                                    $date = date("Y-m-d", $timestamp);
                                                    $time24Hour  = date("H:i:s", $timestamp);
                                                    $time12Hour = date("h:i A", strtotime($time24Hour));
                                                    if($row_parcelstatus["parcel_status"] == "1"){
                                                        $parcel_status = "Item Accepted by Courier";
                                                    }
                                                    elseif($row_parcelstatus["parcel_status"] == "2"){
                                                        $parcel_status = "Collected";
                                                    }
                                                    elseif($row_parcelstatus["parcel_status"] == "3"){
                                                        $parcel_status = "Shipped";
                                                    }
                                                    elseif($row_parcelstatus["parcel_status"] == "4"){
                                                        $parcel_status = "Delivered";
                                                    }
                                                    else{
                                                        $parcel_status = "Unsuccessful Delivery Attempt";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td>$parcel_status</td>";
                                                    echo "<td>$date</td>";
                                                    echo "<td>$time12Hour</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }
                                    }  
                                }
                            
                            else{
                                echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Incorrect Tracking Id",
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
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
