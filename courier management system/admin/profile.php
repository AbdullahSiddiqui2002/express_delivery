<?php

session_start();
if(isset($_SESSION['email'])){
  include("header.php");
include("topbar.php");
include("sidebar.php");

$admin_id = $_SESSION['id'];

$read = "SELECT * FROM `admin`;";
$result_read = mysqli_query($connection,$read);
if($result_read){
    $row = mysqli_fetch_assoc($result_read);
}
?>
<head>
<title>Profile - Express Delivery</title>
<style>
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
input:focus {
     box-shadow: none !important;
    border-color: white !important;
    outline: none !important;
}
input:focus {
  box-shadow: #D54E16 0px 2px 16px 0px !important;
}
.twitter:hover, .facebook:hover, .instagram:hover, .linkedin:hover{
  color: #D54E16 !important;
}
  
</style>
</head>

  <main id="main" class="main">
  <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile my-5">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <i class="fa-solid fa-circle-user" style="font-size: 100px; color: #D54E16;"></i>
              <h2><?= $firstname.' '.$lastname ?></h2>
              <h3>Web Developer</h3>
              <div class="social-links mt-2">
                <a href="<?= $row["twitter_profile"] ?>" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="<?= $row["facebook_profile"] ?>" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="<?= $row["instagram_profile"] ?>" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="<?= $row["linkedin_profile"] ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic" style="text-align: justify;"><?= $row["about"] ?></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"><?= $row["firstname"].' '.$row["lastname"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8"><?= $row["company"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Job</div>
                    <div class="col-lg-9 col-md-8"><?= $row["job"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Country</div>
                    <div class="col-lg-9 col-md-8"><?= $row["country"] ?>n</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?= $row["address"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"><?= $row["contact"] ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?= $row["email"] ?></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                <?php
                if(isset($_POST['save_profile'])  && $_SERVER['REQUEST_METHOD']=="POST"){
                  $firstname = mysqli_real_escape_string($connection,$_POST["firstname"]);
                  $lastname = mysqli_real_escape_string($connection,$_POST["lastname"]);
                  $about = mysqli_real_escape_string($connection,$_POST["about"]);
                  $company = mysqli_real_escape_string($connection,$_POST["company"]);
                  $job = mysqli_real_escape_string($connection,$_POST["job"]);
                  $country = mysqli_real_escape_string($connection,$_POST["country"]);
                  $address = mysqli_real_escape_string($connection,$_POST["address"]);
                  $phone = mysqli_real_escape_string($connection,$_POST["phone"]);
                  $email = mysqli_real_escape_string($connection,$_POST["email"]);
                  $twitter = mysqli_real_escape_string($connection,$_POST["twitter"]);
                  $facebook = mysqli_real_escape_string($connection,$_POST["facebook"]);
                  $instagram = mysqli_real_escape_string($connection,$_POST["instagram"]);
                  $linkedin = mysqli_real_escape_string($connection,$_POST["linkedin"]);
                  if(empty($firstname) || empty($lastname) || empty($about) || empty($company) || empty($job ) || empty($country) || empty($address) || empty($phone) || empty($email) || empty($twitter) || empty($facebook) || empty($instagram) || empty($linkedin)){
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
                  $update = "UPDATE `admin` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email', `about`='$about',`company`='$company',`job`='$job',`country`='$country',`address`='$address',`contact`='$phone',`twitter_profile`='$twitter',`facebook_profile`='$facebook',`instagram_profile`='$instagram',`linkedin_profile`='$linkedin' WHERE `id` = '$admin_id';";
                  $result = mysqli_query($connection, $update) or die("Failed to insert query");
                  if ($result) {
                    echo '<script>
                    $(document).ready(function () {
                                    Swal.fire({
                                        title: "Profile Updated Succesfully",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        window.location.href = "profile.php";
                                    });
                                  });
                                  </script>';
                } else {
                    echo '<script>
                    $(document).ready(function () {
                                    Swal.fire({
                                        title: "Profile not Updated",
                                        icon: "error",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                      window.location.href = "profile.php";
                                  });
                                  });
                                  </script>';
                }
              }
                }
                ?>
                  <!-- Profile Edit Form -->
                  <form method="post">
                    <div class="row mb-3">
                      <div class="col-md-2 col-lg-2 mx-auto">
                        <i class="fa-solid fa-circle-user" style="font-size: 100px; color: #D54E16;"></i>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="firstname" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstname" type="text" value="<?= $row["firstname"] ?>" class="form-control" id="firstname" >
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="lastname" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastname" type="text" value="<?= $row["lastname"] ?>" class="form-control" id="lastname" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control" id="about" style="height: 100px" ><?= $row["about"] ?></textarea>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" value="<?= $row["company"] ?>" class="form-control" id="company" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" value="<?= $row["job"] ?>" class="form-control" id="Job" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" value="<?= $row["country"] ?>" class="form-control" id="Country" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="address" type="text" value="<?= $row["address"] ?>" class="form-control" id="Address" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value="<?= $row["contact"] ?>" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="Email" value="<?= $row["email"] ?>" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="<?= $row["twitter_profile"] ?>" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="<?= $row["facebook_profile"] ?>" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="<?= $row["instagram_profile"] ?>" >
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="<?= $row["linkedin_profile"] ?>" >
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="save_profile" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <?php
                   if(isset($_POST['save_pass'])  && $_SERVER['REQUEST_METHOD']=="POST"){
                    $regpassword = $row["password"] ;
                    $currentpassword = mysqli_real_escape_string($connection,$_POST["currentpassword"]);
                    $newpassword = mysqli_real_escape_string($connection,$_POST["newpassword"]);
                    $renewpassword = mysqli_real_escape_string($connection,$_POST["renewpassword"]);
                    if(empty($newpassword) || empty($renewpassword)){
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
                    $verifypassword = password_verify($currentpassword, $regpassword);
                  if($verifypassword){
                    if($newpassword === $renewpassword){
                      $encryptedpassword = password_hash($newpassword, PASSWORD_BCRYPT);
                      $update_pass = "UPDATE `admin` SET `password`='$encryptedpassword' WHERE `id` = '$admin_id';";
                      $result_pass = mysqli_query($connection, $update_pass) or die("Failed to insert query");
                    if ($result_pass) {
                      echo '<script>
                    $(document).ready(function () {
                                    Swal.fire({
                                        title: "Password Updated Succesfully",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 2000
                                    }).then(() => {
                                        window.location.href = "profile.php";
                                    });
                                  });
                                  </script>';
                    }
                    else {
                      echo '<script>
                      $(document).ready(function () {
                                      Swal.fire({
                                          title: "Password not Updated",
                                          icon: "error",
                                          showConfirmButton: false,
                                          timer: 2000
                                      }).then(() => {
                                        window.location.href = "profile.php";
                                    });
                                    });
                                    </script>';
                  }
                    }
                    else{
                      echo '<script>
    $(document).ready(function () {
                    Swal.fire({
                        title: "Password donot match",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    })
                  });
                  </script>';
                    }
                  }
                  else{
                    echo '<script>
                    $(document).ready(function () {
                    Swal.fire({
                        title: "Invalid Current Password",
                        icon: "error",
                        showConfirmButton: false,
                        timer: 2000
                    })
                  });
                  </script>';
                  }
                }
                  }
                  ?>
                  <form method="post">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="currentpassword" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" name="save_pass" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

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