<?php
session_start();
if(isset($_SESSION['email'])){
    include("header.php");
    include("topbar.php");
    include("sidebar.php");
    require("../include/connection.php");
    $read = "SELECT * FROM `user` ORDER BY id DESC;";
    $result = mysqli_query($connection, $read);
    if($result){
?>
<head>
    <title>User List - Express Delivery</title>
</head>
<main id="main" class="main mt-n1">
    <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
        <div class="pagetitle">
            <h1>User List</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">List</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section my-4">
            <div class="col-lg-12">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date & Time Created</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="branch_tablebody">
                        <?php
                        if(mysqli_num_rows($result) > 0){
                            $i=1;
                            while($row = mysqli_fetch_assoc($result)){
                                $user_id = $row["id"]; 
                                $datetime = $row["date_created"];
                                $timestamp = strtotime($datetime);
                                $date = date("Y-m-d", $timestamp);
                                $time24Hour  = date("H:i:s", $timestamp);
                                $time12Hour = date("h:i A", strtotime($time24Hour));
                        ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["firstname"] ?></td>
                                    <td><?= $row["lastname"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $date." ".$time12Hour ?></td>       
                                    <td class='text-center'>
                                        <div class='btn-group'>
                                            <a data-bs-toggle='modal' data-bs-target='#exampleModal<?= $user_id ?>' class='btn btn-info btn-flat view_parcel_history text-light'><i class='fas fa-eye'></i></a>
                                        </div>
                                    </td>          
                                </tr>
                        <?php
                                $i++;
                            }
                        }
                        else{
                            echo '<script>
                                $(document).ready(function () {
                                    Swal.fire({
                                        title: "No Record Found",
                                        icon: "info",
                                        showConfirmButton: false,
                                        timer: 2000
                                    })
                                });
                            </script>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </section>
</main><!-- End #main -->

<?php
    include("footer.php");

    // Modal Code
    $result = mysqli_query($connection, $read); // Fetch the result again to reset the pointer
    while($row = mysqli_fetch_assoc($result)){
        $user_id = $row["id"];
        $read_user_data = "SELECT * FROM user WHERE `id` = '$user_id';";
        $result_user_data =  mysqli_query($connection,$read_user_data);
        if($result_user_data){
            $row_user_data = mysqli_fetch_assoc($result_user_data);
            $firstname = $row_user_data["firstname"];
            $lastname = $row_user_data["lastname"];
            $email = $row_user_data["email"];
        }
?>
    <div class="modal fade" id="exampleModal<?= $user_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Courier History of: <?= $firstname.' '.$lastname ?></h1>
                    <span>Email: <?= $email ?></span>
                </div>
                <div class="modal-body">
                                        <div class="container-fluid">
                                          <div class="col-lg-12">
                                            <div class="row">
                                              <div class="col-md-12 p-3 mb-5" style="border-left: 4px solid #D54E16; padding-left: 7px; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;">
                                                <div class="callout callout-info">
                                                  <?php
                                                  $read_user = "SELECT * FROM `parcel` WHERE `sender_email` = '$email'";
                                                  $result_user = mysqli_query($connection,$read_user);
                                                  if($result_user){
                                                    ?>
                                                    <table class="table table-bordered text-center">
                                                      <thead>
                                                        <tr>
                                                          <th scope="col">#</th>
                                                          <th scope="col">Recipient Name</th>
                                                          <th scope="col">Recipient Email</th>
			                                                    <th scope="col">Weight</th>
			                                                    <th scope="col">Amount</th>
			                                                    <th scope="col">Parcel Status</th>
			                                                    <th scope="col">Date Created</th>
                                                        </tr>
                                                      </thead>
                                                      <tbody>
                                                    <?php
                                                    if(mysqli_num_rows($result_user) > 0){
                                                      $p=1;
                                                      while($row_user = mysqli_fetch_assoc($result_user)){
                                                        ?>
                                                        <tr>
                                                          <td><?= $p ?></td>
                                                          <td><?= $row_user["recipient_name"] ?></td>
                                                          <td><?= $row_user["recipient_email"] ?></td>
                                                          <td><?= $row_user["weight"] ?></td>
                                                          <td><?= number_format($row_user["amount"]) ?></td>
                                                          <td class="text-center">
                                        <?php
                                        if ($row_user['parcel_status'] == 1) {
                                            echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Item Accepted by Courier</span>";
                                        } elseif ($row_user['parcel_status'] == 2) {
                                            echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Collected</span>";
                                        } elseif ($row_user['parcel_status'] == 3) {
                                            echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Shipped</span>";
                                        } elseif ($row_user['parcel_status'] == 4) {
                                            echo "<span class='badge rounded-pill text-bg-success bg-gradient text-light'>Delivered</span>";
                                        } else {
                                            echo "<span class='badge rounded-pill text-bg-danger bg-gradient text-light'>Unsuccessful Delivery Attempt</span>";
                                        }
                                        ?>
                                    </td>
                                    <td><?= date("M d, Y",strtotime($row_user["date_created"])) ?></td>
                                                        <tr>
                                                        <?php
                                                        $p++;
                                                      }
                                                    }
                                                    ?>
                                                    </tbody>
                                                  </table>
                                                    <?php
                                                  }
                                                  ?>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer display">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      </div>
                                   
            </div>
        </div>
    </div>
<?php
    }}
}
else{
    header("location: login.php");
}
?>
