<?php
require("../../include/connection.php");
session_start();
if(isset($_SESSION['email'])){
$user_id = $_SESSION['id'];
$user_id = $_SESSION['id'];
  $read_email = "SELECT * FROM user WHERE `id` = '$user_id';";
  $result_email = mysqli_query($connection, $read_email);
          if ($result_email) {
            $row_email = mysqli_fetch_assoc($result_email);
            $user_email = $row_email["email"];
          }
    
?>
<!DOCTYPE html>
<html lang="en-US" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>Profile - Express Delivery</title>


    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
<link rel="manifest" href="assets/img/site.webmanifest">
    <meta name="theme-color" content="#ffffff">


    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->
    <link href="assets/css/theme.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
      var currentDate = new Date().toISOString().split('T')[0];
      var fromDateInput = document.getElementById('from_date');
      var toDateInput = document.getElementById('to_date');

      fromDateInput.setAttribute('max', currentDate);
      toDateInput.setAttribute('max', currentDate);

      fromDateInput.addEventListener('change', function () {
        toDateInput.setAttribute('min', fromDateInput.value);
      });

      toDateInput.addEventListener('change', function () {
        fromDateInput.setAttribute('max', toDateInput.value);
      });
    });
  </script>
  </head>
<style>
  .scroll {
    animation-name: scrol;
    animation-duration: .5s;
    position: fixed;
    top: 0;
    z-index: 2;
    background-color: rgba(245, 236, 236, 0.8);
    width: 100%;
    height: auto
}

  label{
    font-weight: bold;
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


.scroll .nav-link{
  color: #F95C19 !important;
}



@keyframes scrol {
    0% {
        margin-top: -100px
    }
    10% {
        margin-top: -90px
    }
    20% {
        margin-top: -80px
    }
    30% {
        margin-top: -70px
    }
    40% {
        margin-top: -60px
    }
    50% {
        margin-top: -40px
    }
    60% {
        margin-top: -30px
    }
    70% {
        margin-top: -20px
    }
    80% {
        margin-top: -10px
    }
    90% {
        margin-top: -5px
    }
    100% {
        margin-top: 0
    }
}
.nav-link:hover{
  color: #F95C19 !important;
}
li {
    list-style-type: none;
  }
  
  .f-a{
    font-family: arial;
  }
</style>

  <body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3 d-block" id="navbar">
        <div class="container"><a class="navbar-brand" href="index.php"><img src="assets/img/gallery/EXpress_Delivery__2_-removebg-preview.png" height="100" alt="logo" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-">
              <li class="nav-item px-2"><a class="nav-link fw-bolder" aria-current="page" href="index.php">Home</a></li>
            </ul>
           
          </div>
        </div>
      </nav>
      <script>
        window.addEventListener("scroll", function () {
            var e = document.getElementById("navbar");
            window.pageYOffset > 0 ? e.classList.add("scroll") : e.classList.remove("scroll");
        });
    </script>
        <?php
        $read = "SELECT * FROM `user` Where `id` = '$user_id';";
        $result_read = mysqli_query($connection,$read);
        if($result_read){
            $row = mysqli_fetch_assoc($result_read);
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $email = $row["email"];
        }
        ?>
      <section class="py-xxl-10 pb-0 my-5" id="home">
        <div class="bg-holder bg-size" style="background-image:url(assets/img/gallery/hero-header-bg.png);background-position:top center;background-size:cover;">
        </div>
        <!--/.bg-holder-->
        <div class="container">
            <h1 class="text-center">Generate Report</h1>
        <section class="section">
      <form class="row g-3 mb-3" method="post">
        <div class="row mb-3">
        <div class="col-sm-4">
          <label for="">Status:</label>
        </div>
        <div class="col-sm-8">
          <select name="parcel_status" id="" class="custom-select custom-select-lg" >
            <option value='ALL'>All</option>
            <option value='1'>Item Accepted by Courier</option>
            <option value='2'>Collected</option>
            <option value='3'>Shipped</option>
            <option value='4'>Delivered</option>
            <option value='5'>Unsuccessful Delivery Attempt</option>
          </select>
        </div>
      </div>
      <div class="row my-3">
        <div class="col-sm-2">
          <label for="">From:</label>
        </div>
        <div class="col-sm-4">
          <input type="date" name="from_date" id="from_date">
        </div>
        <div class="col-sm-2">
          <label for="">To:</label>
        </div>
        <div class="col-sm-4">
          <input type="date" name="to_date" id="to_date">
        </div>
        </div>
      <div class="row mt-3">
        <div class="col-sm-2 mx-auto">
          <button class="btn btn-primary" name="view_report" type="submit">View Report</button>
        </div>
        </div>
      </form>
      <hr>

      <?php
      if(isset($_POST['view_report'])  && $_SERVER['REQUEST_METHOD']=="POST"){
        $parcel_status = mysqli_real_escape_string($connection, $_POST["parcel_status"]);
        $from_date = mysqli_real_escape_string($connection, $_POST["from_date"]);
        $to_date = mysqli_real_escape_string($connection, $_POST["to_date"]);
        if(empty($parcel_status) || empty($from_date) || empty($to_date)){
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
        $read = "SELECT * FROM parcel WHERE `sender_email` = '$user_email' AND date(date_created) BETWEEN '$from_date' AND '$to_date'" . ($parcel_status != 'ALL' ? " AND parcel_status = $parcel_status" : "") . " ORDER BY unix_timestamp(date_created) ASC;";
        $status_arr = array("All","Item Accepted by Courier","Collected","Shipped","Delivered","Unsuccessfull Delivery Attempt");
        $result = mysqli_query($connection, $read);
        if ($result) {
          
      ?>
  <div class="row my-3">
    
      <?php
      if (mysqli_num_rows($result) > 0) {
        $i=1;
      ?>
<div class='col-md-2 mx-auto my-3'>
        <a href="./reportgeneration/generate_excel.php?parcel_status=<?= $parcel_status ?>&from_date=<?= $from_date ?>&to_date=<?= $to_date ?>&user_email=<?= $user_email ?>" download="report.xlsx" class='btn btn-success' id='print'><i class='fa fa-print'></i> Print</a>
        
         </div>
<div class="col-md-12">
    <table class="table table-bordered text-center" id="report-list">
						<thead>
							<tr>
								<th  scope="col">#</th>
								<th  scope="col">Date</th>
								<th  scope="col">Sender</th>
								<th  scope="col">Recepient</th>
								<th  scope="col">Amount</th>
								<th  scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
              
              while ($row = mysqli_fetch_assoc($result)) {
                $sender_name = $row["sender_name"];
                $recipient_name = $row["recipient_name"];
                $date_created = date("M d, Y",strtotime($row["date_created"]));
                $status = $status_arr[$row["parcel_status"]];
                $amount = number_format($row["amount"]);

                echo "<tr>";
                echo "<td>$i</td>";
                echo "<td>$date_created</td>";
                echo "<td>$sender_name</td>";
                echo "<td>$recipient_name</td>";
                echo "<td>$amount</td>";
                echo "<td>$status</td>";
                echo "</tr>";
                $i++;
              }
              
              ?>
              	</tbody>
					</table>
            </div>
          <?php
          
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
    
  </div>
      <?php
      }  }
          }
      ?>
    </section>
        </div>
      </section>

      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="bg-900 pb-0 pt-5">

        <div class="container">
          <div class="row">
            <div class="col-12 col-sm-12 col-lg-6 mb-4 order-0 order-sm-0"><a class="text-decoration-none" href="#"><img src="assets/img/gallery/EXpress_Delivery__3_-removebg-preview.png" height="70" alt="" /></a>
              <p class="text-500 my-4">The most trusted Courier<br />company in your area.</p>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-2 order-sm-1">
              <h5 class="lh-lg fw-bold mb-4 text-light font-sans-serif">Other links </h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-500" href="#!">Blogs</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Movers website</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Traffic Update</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
              <h5 class="lh-lg fw-bold text-light mb-4 font-sans-serif">Services</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-500" href="#!">Corporate goods</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Artworks</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Documents</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-4 col-lg-2 mb-3 order-3 order-sm-2">
              <h5 class="lh-lg fw-bold text-light mb-4 font-sans-serif"> Customer Care</h5>
              <ul class="list-unstyled mb-md-4 mb-lg-0">
                <li class="lh-lg"><a class="text-500" href="#!">About Us</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Contact US</a></li>
                <li class="lh-lg"><a class="text-500" href="#!">Get Update</a></li>
              </ul>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->




      <!-- ============================================-->
      <!-- <section> begin ============================-->
      <section class="py-0 bg-1000">

        <div class="container">
          <div class="row justify-content-md-between justify-content-evenly py-4">
            <div class="col-12 col-sm-8 col-md-6 col-lg-auto text-center text-md-start">
              <p class="fs--1 my-2 fw-bold text-200">All rights Reserved &copy; Your Company, 2021</p>
            </div>
          </div>
        </div>
        <!-- end of .container-->

      </section>
      <!-- <section> close ============================-->
      <!-- ============================================-->


    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/@popperjs/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="assets/js/theme.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
  </body>

</html>

<?php
    
}
else{
    header("location: login.php");
}
?>