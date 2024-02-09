<?php
session_start();
if(isset($_SESSION['email'])){
    include("header.php");
    include("topbar.php");
    include("sidebar.php");
    require("../include/connection.php");

    
                if ($_GET['status'] == "All") {
                  echo "<head><title>Parcel List (ALL) - Express Delivery</title></head>";
                }
                elseif($_GET['status'] == "1"){
                  echo "<head><title>Parcel List (Item Accepted by Courier) - Express Delivery</title></head>";
                }
                elseif($_GET['status'] == "2"){
                  echo "<head><title>Parcel List (Collected) - Express Delivery</title></head>";
                }
                elseif($_GET['status'] == "3"){
                  echo "<head><title>Parcel List (Shipped) - Express Delivery</title></head>";
                }
                elseif($_GET['status'] == "4"){
                  echo "<head><title>Parcel List (Delivered) - Express Delivery</title></head>";
                }
                else{
                  echo "<head><title>Parcel List (Unsuccessful Delivery Attempt) - Express Delivery</title></head>";
                }
                
?>
<style>
  input:focus ,select:focus{
     box-shadow: none !important;
    border-color: white !important;
    outline: none !important;
}
input:focus ,select:focus{
  box-shadow: #D54E16 0px 2px 16px 0px !important;
}
.upd {
    color: #FFFFFF !important;
    background-color: #D54E16 !important;
    border-color: #D54E16 !important;
}
.upd:hover{
    color: #FFFFFF !important;
    background-color: #ca4209 !important;
    border-color: #ca4209 !important;
}
#status{
  color: #FFFFFF !important;
    background-color: #D54E16 !important;
}
#status:hover{
  color: #FFFFFF !important;
    background-color: #ca4209 !important;
    
}
</style>
<main id="main" class="main">
<section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
        <h1>Parcel List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Parcel</li>
                <?php
                if ($_GET['status'] == "All") {
                  echo "<li class='breadcrumb-item active'>List All</li>";
                }
                elseif($_GET['status'] == "1"){
                  echo "<li class='breadcrumb-item active'>Item Accepted by Courier</li>";
                }
                elseif($_GET['status'] == "2"){
                  echo "<li class='breadcrumb-item active'>Collected</li>";
                }
                elseif($_GET['status'] == "3"){
                  echo "<li class='breadcrumb-item active'>Shipped</li>";
                }
                elseif($_GET['status'] == "4"){
                  echo "<li class='breadcrumb-item active'>Delivered</li>";
                }
                else{
                  echo "<li class='breadcrumb-item active'>Unsuccessful Delivery Attempt</li>";
                }
                ?> 
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section my-4">
        <div class="col-lg-12">
            <table class="table table-bordered text-center" id="list">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tracking Id</th>
                        <th scope="col">Sender Name</th>
                        <th scope="col">Recipient Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody id="branch_tablebody">
                    <?php
                    if ($_GET['status'] == "All") {
                        $read = "SELECT * FROM `parcel` ORDER BY id DESC;";
                    } else {
                        $status = $_GET['status'];
                        $read = "SELECT * FROM `parcel` where parcel_status = '$status' ORDER BY id DESC;";
                    }

                    $result = mysqli_query($connection, $read);

                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            $i = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $parcel_id = $row["id"];
                    ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["tracking_id"] ?></td>
                                    <td><?= $row["sender_name"] ?></td>
                                    <td><?= $row["recipient_name"] ?></td>
                                    <td class="text-center">
                                        <?php
                                        if ($row['parcel_status'] == 1) {
                                            echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Item Accepted by Courier</span>";
                                        } elseif ($row['parcel_status'] == 2) {
                                            echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Collected</span>";
                                        } elseif ($row['parcel_status'] == 3) {
                                            echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Shipped</span>";
                                        } elseif ($row['parcel_status'] == 4) {
                                            echo "<span class='badge rounded-pill text-bg-success bg-gradient text-light'>Delivered</span>";
                                        } else {
                                            echo "<span class='badge rounded-pill text-bg-danger bg-gradient text-light'>Unsuccessful Delivery Attempt</span>";
                                        }
                                        ?>
                                    </td>
                                    <td class='text-center'>
                                        <div class='btn-group'>
                                            <a data-bs-toggle="modal" data-bs-target="#exampleModal<?= $parcel_id ?>" class='btn btn-info btn-flat view_parcel text-light'><i class='fas fa-eye'></i></a>
                                            <a href='update_parcel.php?parcel_id=<?= $parcel_id ?>' class='btn btn-primary btn-flat'><i class='fas fa-edit'></i></a>
                                            <a href='delete_parcel.php?parcel_id=<?= $parcel_id ?>' class='btn btn-danger btn-flat'><i class='fas fa-trash'></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $parcel_id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Parcel Details</h1>
                                      </div>
                                      <div class="modal-body">
                                        <div class="container-fluid">
                                          <div class="col-lg-12">
                                            <div class="row">
                                              <div class="col-md-12 p-3 mb-5" style="border-left: 4px solid #D54E16; padding-left: 7px; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;">
                                                <div class="callout callout-info">
                                                  <dl>
                                                    <dt>Tracking Number:</dt>
                                                    <dd> <h4><b><?= $row["tracking_id"] ?></b></h4></dd>
                                                  </dl>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                              <div class="col-md-6">
                                                <div class="callout callout-info p-3 mb-5"  style="border-left: 4px solid #D54E16; padding-left: 7px; border-radius: 5px;  box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;">
                                                  <b class="border-bottom border-secondary-subtle">Sender Information</b>
                                                  <dl>
                                                    <dt class="mt-2">Name:</dt>
                                                    <dd><?= $row["sender_name"] ?></dd>
                                                    <dt>Email:</dt>
                                                    <dd><?= $row["sender_email"] ?></dd>
                                                    <dt>Address:</dt>
                                                    <dd><?= $row["sender_address"] ?></dd>
                                                    <dt>Contact:</dt>
                                                    <dd><?= $row["sender_contact"] ?></dd>
                                                  </dl>
                                                </div>
                                                <div class="callout callout-info p-3 mb-5"  style="border-left: 4px solid #D54E16; padding-left: 7px; border-radius: 5px;  box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;">
                                                  <b class="border-bottom border-secondary-subtle">Recipient Information</b>
                                                  <dl>
                                                    <dt class="mt-2">Name:</dt>
                                                    <dd><?= $row["recipient_name"] ?></dd>
                                                    <dt>Email:</dt>
                                                    <dd><?= $row["recipient_email"] ?></dd>
                                                    <dt>Address:</dt>
                                                    <dd><?= $row["recipient_address"] ?></dd>
                                                    <dt>Contact:</dt>
                                                    <dd><?= $row["recipient_contact"] ?></dd>
                                                  </dl>
                                                </div>
                                              </div>
                                              <div class="col-md-6">
                                                <div class="callout callout-info p-3 mb-5"  style="border-left: 4px solid #D54E16; padding-left: 7px; border-radius: 5px;  box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px;">
                                                  <b class="border-bottom border-secondary-subtle">Parcel Details</b>
                                                  <div class="row">
                                                    <div class="col-sm-12">
                                                      <dl>
                                                      <dt class="mt-2">Description:</dt>
                                                        <dd><?= $row["parcel_description"] ?></dd>
                                                        <dt>Weight:</dt>
                                                        <dd><?= $row["weight"] ?></dd>
                                                        <dt>Amount:</dt>
                                                        <dd><?= $row["amount"] ?></dd>
                                                      </dl>	
                                                    </div>
                                                  </div>
                                                  <dl>
                                                    <dt>Branch Processed:</dt>
                                                    <?php
                                                      $branch_id = $row["branch_id"];
                                                      $read_updateid = "SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches where id = '$branch_id';";
                                                      $result_updateid = mysqli_query($connection,$read_updateid);
                                                      if($result_updateid){
                                                        if(mysqli_num_rows($result_updateid) > 0){
                                                          while($row_updateid = mysqli_fetch_assoc($result_updateid)){
                                                            echo "<dd value=".$row_updateid['id'].">".$row_updateid['branch_code']." | ".(ucwords($row_updateid['address']))."</dd>";
                                                          }
                                                        }
                                                      }
                                                    ?>
                                                    <dt>Status:</dt>
                                                    <dd>
                                                      <?php 
                                                        if($row['parcel_status'] == 1){
                                                          echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Item Accepted by Courier</span>";
                                                        }
                                                        elseif($row['parcel_status'] == 2){
                                                          echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Collected</span>";
                                                        }
                                                        elseif($row['parcel_status'] == 3){
                                                          echo "<span class='badge rounded-pill text-bg-primary bg-gradient text-light'>Shipped</span>";
                                                        }
                                                        elseif($row['parcel_status'] == 4){
                                                          echo "<span class='badge rounded-pill text-bg-success bg-gradient text-light'>Delivered</span>";
                                                        }
                                                        else{
                                                          echo "<span class='badge rounded-pill text-bg-danger bg-gradient text-light'>Unsuccessful Delivery Attempt</span>";
                                                        }
                                                      ?>
                                                      <span class="btn badge text-bg-primary bg-gradient text-light" id="status" data-bs-target="#exampleModalToggle2<?= $parcel_id ?>" data-bs-toggle="modal" id='update_status'><i class="fa fa-edit"></i> Update Status</span>
                                                    </dd>
                                                  </dl>
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
                                <div class="modal fade" id="exampleModalToggle2<?= $parcel_id ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Update status of: <?= $row["tracking_id"] ?></h1>
                                      </div>
                                      <div class="modal-body">
                                        <form action="update_parcel_status.php" method="post">
                                          <input type="hidden" name="parcel_id" value="<?= $parcel_id ?>">
                                          <input type="hidden" name="sender_name" value="<?= $row["sender_name"] ?>">
                                          <input type="hidden" name="sender_email" value="<?= $row["sender_email"] ?>">
                                          <input type="hidden" name="tracking_id" value="<?= $row["tracking_id"] ?>">
                                          <div class="row">
                                            <div class="col-sm-8">
                                              <?php
                                                if($row['parcel_status'] == 1){
                                                ?>
                                              <select name="parcel_status_id" id="" class="form-control select2"  required="required">
                                                <option value='' <?= ($row['parcel_status'] == 1) ? 'selected disabled' : '' ?>>Item Accepted by Courier</option>
                                                <option value='2' <?= ($row['parcel_status'] == 2) ? 'selected disabled' : '' ?>>Collected</option>
                                                <option value='3' <?= ($row['parcel_status'] == 3) ? 'selected disabled' : '' ?>>Shipped</option>
                                                <option value='4' <?= ($row['parcel_status'] == 4) ? 'selected disabled' : '' ?>>Delivered</option>
                                                <option value='5' <?= ($row['parcel_status'] == 5) ? 'selected disabled' : '' ?>>Unsuccessful Delivery Attempt</option>
                                              </select>
                                              <?php
                                              }
                                              elseif($row['parcel_status'] == 2){
                                              ?>
                                              <select name="parcel_status_id" id="" class="form-control select2"  required="required">
                                                
                                                <option value='' <?= ($row['parcel_status'] == 2) ? 'selected disabled' : '' ?>>Collected</option>
                                                <option value='3' <?= ($row['parcel_status'] == 3) ? 'selected disabled' : '' ?>>Shipped</option>
                                                <option value='4' <?= ($row['parcel_status'] == 4) ? 'selected disabled' : '' ?>>Delivered</option>
                                                <option value='5' <?= ($row['parcel_status'] == 5) ? 'selected disabled' : '' ?>>Unsuccessful Delivery Attempt</option>
                                              </select>
                                              <?php
                                              }
                                              elseif($row['parcel_status'] == 3){
                                              ?>
                                              <select name="parcel_status_id" id="" class="form-control select2"  required="required">
                                                
                                                <option value='' <?= ($row['parcel_status'] == 3) ? 'selected disabled' : '' ?>>Shipped</option>
                                                <option value='4' <?= ($row['parcel_status'] == 4) ? 'selected disabled' : '' ?>>Delivered</option>
                                                <option value='5' <?= ($row['parcel_status'] == 5) ? 'selected disabled' : '' ?>>Unsuccessful Delivery Attempt</option>
                                              </select>
                                              <?php
                                              }
                                              elseif($row['parcel_status'] == 4){
                                              ?>
                                              <select name="parcel_status_id" id="" class="form-control select2"  required="required">
                                                
                                                <option value='' <?= ($row['parcel_status'] == 4) ? 'selected disabled' : '' ?>>Delivered</option>
                                                
                                              </select>
                                              <?php
                                              }
                                              else{
                                              ?>
                                              <select name="parcel_status_id" id="" class="form-control select2 parcelStatus"  required="required">
                                                
                                                <option value='' <?= ($row['parcel_status'] == 5) ? 'selected disabled' : '' ?>>Unsuccessful Delivery Attempt</option>
                                              </select>
                                              <?php
                                              }
                                              ?>
                                            </div>
                                            <div class="col-sm-2">
                                              <button class="btn btn-primary upd" name="update_parcel_status">Update</button>
                                            </div>
                                          </div>
                                          
                                        </form>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $parcel_id ?>">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                               
                    <?php
                                $i++;
                            }
                        } else {
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
} else {
    header("location: login.php");
}
?>
