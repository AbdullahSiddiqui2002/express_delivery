<?php

include("header.php");
require("../include/connection.php");
?>
<style>
  aside{
    background-color: #343A40 !important;
    color: #c2c7d0 !important;
  }
</style>
<!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.php" style="background-color: #343A40 !important; color: #c2c7d0 !important;">
          <i class="bi bi-grid" style="color: #c2c7d0 !important;"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link" data-bs-target="#parcel" data-bs-toggle="collapse" href="#" style="background-color: #343A40 !important; color: #c2c7d0 !important;">
          <i class="bi bi-box-fill" style="color: #c2c7d0 !important;"></i><span>Parcels</span><i class="bi bi-chevron-down ms-auto" style="color: #c2c7d0 !important;"></i>
        </a>
        <ul id="parcel" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="new_parcel.php" style="color: #c2c7d0 !important;">
              <i class="bi bi-chevron-right" style="font-size: 1rem;"></i><span>Add New</span>
            </a>
          </li>
          <li>
            <a href="parcel_list.php?status=All" style="color: #c2c7d0 !important;">
              <i class="bi bi-chevron-right" style="font-size: 1rem;"></i><span>List All</span>
            </a>
          </li>
          <li>
            <a href="parcel_list.php?status=1" style="color: #c2c7d0 !important;">
              <i class="bi bi-chevron-right" style="font-size: 1rem;"></i><span>Item Accepted by Courier</span>
            </a>
          </li>
          <li>
            <a href="parcel_list.php?status=2" style="color: #c2c7d0 !important;">
              <i class="bi bi-chevron-right" style="font-size: 1rem;"></i><span>Collected</span>
            </a>
          </li>
          <li>
            <a href="parcel_list.php?status=3" style="color: #c2c7d0 !important;">
              <i class="bi bi-chevron-right" style="font-size: 1rem;"></i><span>Shipped</span>
            </a>
          </li>
          <li>
            <a href="parcel_list.php?status=4" style="color: #c2c7d0 !important;">
              <i class="bi bi-chevron-right" style="font-size: 1rem;"></i><span>Delivered</span>
            </a>
          </li>
          <li>
            <a href="parcel_list.php?status=5" style="color: #c2c7d0 !important;">
              <i class="bi bi-chevron-right" style="font-size: 1rem;"></i><span>Unsuccessfull Delivery Attempt</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link" href="track.php" style="background-color: #343A40 !important; color: #c2c7d0 !important;">
          <i class="bi bi-search" style="color: #c2c7d0 !important;"></i>
          <span>Track Parcel</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="reports.php" style="background-color: #343A40 !important; color: #c2c7d0 !important;">
          <i class="bi bi-search" style="color: #c2c7d0 !important;"></i>
          <span>Reports</span>
        </a>
      </li>

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link" href="profile.php" style="background-color: #343A40 !important; color: #c2c7d0 !important;">
          <i class="bi bi-person" style="color: #c2c7d0 !important;"></i>
          <span>Profile</span>
        </a>
      </li>
      <!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link logout" href="#" style="background-color: #343A40 !important; color: #c2c7d0 !important;">
        <i class="bi bi-box-arrow-right" style="color: #c2c7d0 !important;"></i>
          <span>Logout</span>
        </a>
      </li>
      <script>
    $(document).ready(function () {
        $(".logout").click(function (e) {
            e.preventDefault();
            Swal.fire({
                text: "Are you sure you want to Logout?",
                showCancelButton: true,
                confirmButtonColor: "#D54E16",
                cancelButtonColor: "#6c757d",
                cancelButtonText: "No",
                confirmButtonText: "Yes"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform logout actions
                    localStorage.removeItem("status");
                    window.location.href = "logout.php";
                }
            });
        });
    });
</script>

    </ul>

  </aside><!-- End Sidebar-->
  

