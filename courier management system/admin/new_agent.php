<?php
session_start();
if(isset($_SESSION['email'])){
include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");

if(isset($_POST['save_agent']) && $_SERVER['REQUEST_METHOD']=="POST"){
  $agent_id = mysqli_real_escape_string($connection,$_POST["agent_id"]);
  $firstname = mysqli_real_escape_string($connection,$_POST["firstname"]);
  $lastname = mysqli_real_escape_string($connection,$_POST["lastname"]);
  $branch_id = mysqli_real_escape_string($connection,$_POST["branch_id"]);
  $email = mysqli_real_escape_string($connection,$_POST["email"]);
  $password = mysqli_real_escape_string($connection,$_POST["password"]);
  if(empty( $firstname) || empty( $lastname) || empty($branch_id) || empty($email) || empty($password)){
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
  $encryptedpassword = password_hash($password, PASSWORD_BCRYPT);
  $check = "SELECT * FROM `agent` WHERE email = '$email';";
  $result_duplicate = mysqli_query($connection, $check) or die("failed");
  if(mysqli_num_rows($result_duplicate) > 0){
    echo '<script>
      $(document).ready(function () {
        Swal.fire({
          title: "Agent already exist",
          icon: "info",
          showConfirmButton: false,
          timer: 2000
        }).then(() => {
          window.location.href = "agent_list.php";
        });
      });
    </script>';
  }
  else{
    $insert = "INSERT INTO `agent`(`id`, `firstname`, `lastname`, `email`, `password`, `branch_id`) VALUES ('$agent_id','$firstname','$lastname','$email','$encryptedpassword','$branch_id');";  
  $result = mysqli_query($connection, $insert) or die("Failed to insert query");
  if ($result) {
    echo '<script>
      $(document).ready(function () {
        Swal.fire({
          title: "Agent Created Succesfully",
          icon: "success",
          showConfirmButton: false,
          timer: 2000
        }).then(() => {
          window.location.href = "agent_list.php";
        });
      });
    </script>';
} 
else {
  echo '<script>
    $(document).ready(function () {
      Swal.fire({
        title: "Agent Not Registered",
        icon: "error",
        showConfirmButton: false,
        timer: 2000
      }).then(() => {
        window.location.href = "new_agent.php";
      });
    });
  </script>';
}
}}
}
?>

<head>
  <title>New Agent - Express Delivery</title>
</head>
<style>
  label {
    font-weight: bold;
  }

  .btn-primary,
  .btn-success {
    color: #FFFFFF !important;
    background-color: #D54E16 !important;
    border-color: #D54E16 !important;
  }

  .btn-primary:hover,
  .btn-success:hover {
    color: #FFFFFF !important;
    background-color: #ca4209 !important;
    border-color: #ca4209 !important;
  }

  input:focus,
  select:focus {
    box-shadow: none !important;
    border-color: white !important;
    outline: none !important;
  }

  input:focus,
  select:focus {
    box-shadow: #D54E16 0px 2px 16px 0px !important;
  }
</style>
<main id="main" class="main">
  <section class="p-5"
    style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>New Agent</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Agent</li>
          <li class="breadcrumb-item active">Add New</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section my-5">
      <form class="row g-3" method="post">
        <input type="hidden" name="agent_id" value="">

        <div class="row">
          <div class="col-md-6">
            <label for="" class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" id="">
          </div>
          <div class="col-md-6">
            <label for="" class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="">
          </div>
        </div>

        <div class="row my-3">
        <div class="col-md-6">
    <label for="" class="form-label">Branch</label>
    <select name="branch_id" id="" class="form-control select2">
        <option value=""></option>
        <?php
            $read = "SELECT *,concat(street,', ',city,', ',state,', ',zip_code,', ',country) as address FROM branches WHERE id NOT IN (SELECT branch_id FROM agent);";
            $result = mysqli_query($connection,$read);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<option value=".$row['id'].">".$row['branch_code']." | ".(ucwords($row['address']))."</option>";
                    }
                }
                else{
                    echo "<option>No Branch Found</option>";
                }
            }
        ?>
    </select>
</div>

        </div>

        <div class="row">
          <div class="col-md-6">
            <label for="" class="form-label">Email</label>
            <input type="email" name="email" id="" class="form-control" value="">
          </div>
        </div>
        <div class="row  my-3">
          <div class="col-md-6">
            <label for="" class="form-label">Password</label>
            <input type="password" name="password" id="" class="form-control">
          </div>
        </div>
        <div class="d-flex w-100 justify-content-center align-items-center mt-5">
          <input type="submit" class="btn btn-success mx-2" name="save_agent" value="Save">
          <a class="btn btn-secondary mx-2" href="agent_list.php">Cancel</a>
        </div>
      </form>

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