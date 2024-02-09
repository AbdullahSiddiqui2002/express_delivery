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
<title>Generate Report - Express Delivery</title>

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
  <!-- Your existing styles and other head elements go here -->
</head>

 
<style>
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
</style>

  <main id="main" class="main">
  <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>Report</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>o
          <li class="breadcrumb-item active">Report</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section my-5">
      <form class="row g-3 my-3" method="post">
        <div class="row mb-3">
        <div class="col-sm-4">
          <label for="">Status:</label>
        </div>
        <div class="col-sm-8">
          <select name="parcel_status" id="" class="custom-select custom-select-lg">
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
        $read = "SELECT * FROM parcel WHERE `agent_id` = '$agent_id' AND date(date_created) BETWEEN '$from_date' AND '$to_date'" . ($parcel_status != 'ALL' ? " AND parcel_status = $parcel_status" : "") . " ORDER BY unix_timestamp(date_created) ASC;";
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
        <a href="./reportgeneration/generate_excel.php?parcel_status=<?= $parcel_status ?>&from_date=<?= $from_date ?>&to_date=<?= $to_date ?>&agent_id=<?= $agent_id ?>" download="report.xlsx" class='btn btn-success' id='print'><i class='fa fa-print'></i> Print</a>
        
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
                             }).then(() => {
                                 window.location.href = "reports.php";
                             });
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
    </section>

  </main><!-- End #main -->

  <?php
   include("footer.php");
  }
  else{
      header("location: login.php");
  }
?>