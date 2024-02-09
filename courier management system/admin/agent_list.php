<?php
session_start();
if(isset($_SESSION['email'])){
include("header.php");
include("topbar.php");
include("sidebar.php");
require("../include/connection.php");
$read = "SELECT a.*,concat(a.firstname,' ',a.lastname) as name,concat(b.street,', ',b.city,', ',b.state,', ',b.zip_code,', ',b.country) as baddress FROM agent a inner join branches b on b.id = a.branch_id order by concat(a.firstname,' ',a.lastname) asc;";
$result = mysqli_query($connection,$read);
if($result){
?>
<head>
<title>Agent List - Express Delivery</title>
  </head>
  <main id="main" class="main">
  <section class="p-5" style="background-color: white; border-top: 4px solid #D54E16; border-radius: 5px; box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
    <div class="pagetitle">
      <h1>Agent List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Agent</li>
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
      <th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Branch</th>
			<th scope="col">Action</th>
    </tr>
  </thead>
  <tbody  id="agent_tablebody">
  <?php
    if(mysqli_num_rows($result) > 0){
    $i=1;
    while($row = mysqli_fetch_assoc($result)){
       $branch_id = $row["id"];
        
       echo "<tr>
       <td>".$i."</td>
        <td>".ucwords($row["name"])."</td>
        <td>".$row["email"]."</td>
        <td>".ucwords($row["baddress"])."</td>          
        <td class='text-center'>
        <div class='btn-group'>
        <a href='update_agent.php?agent_id=".$row["id"]."' class='btn btn-primary btn-flat'><i class='fas fa-edit'></i></a>
        <a href='delete_agent.php?agent_id=".$row["id"]."' class='btn btn-danger btn-flat'><i class='fas fa-trash'></i></a>
        </div>
      </td>          
        </tr>";
        $i++;
    }}
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
<?php




}
?>
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