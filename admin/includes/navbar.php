<?php 
include '../lib/session.php';

session::checkSession();
?>
<?php
if(isset($_GET['action']) && $_GET['action'] == 'logout'){
  Session::destroy();
}
?>
<?php   
$admin_user=session::get('admin_User');
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../index.php">
    <div class="sidebar-brand-icon rotate-n-15">
    </div>
    <div class="sidebar-brand-text mx-3">Sneaker Shop<sup></sup></div>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Trang Chính</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading -->
    <div class="sidebar-heading">
      Quản Lý
    </div>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-money-bill-alt"></i>
        <span>Thanh Toán</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header"> Đơn Hàng :</h6>
          <a class="collapse-item" href="listbill.php">Danh Sách Đơn Hàng</a>


        </div>
      </div>
    </li>
    <?php 
    $check = Session::get('level');
    if($check== '0'){ 
     ?>
     <li class="nav-item">
      <a class="nav-link" href="listadmin.php">
        <i class="fas fa-users-cog"></i>
        <span>Danh Sách Nhân Sự</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-plus"></i>
          <span>Quản Lý Sản Phẩm</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Thông Tin :</h6>
            <a class="collapse-item" href="brand.php">Thương Hiệu</a>
            <a class="collapse-item" href="product.php">Danh Sách Sản Phẩm</a>
            <a class="collapse-item" href="category.php">Loại hàng</a>
            <a class="collapse-item" href="discount.php">Chương Trình Khuyến Mãi</a>

          </div>
        </li>
        <?php
      }else{
        ?> 
        <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-plus"></i>
            <span>Manage</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <h6 class="collapse-header">Thông Tin :</h6>
              <a class="collapse-item" href="brand.php">Thương Hiệu</a>
              <a class="collapse-item" href="product.php">Danh Sách Sản Phẩm</a>
              <a class="collapse-item" href="category.php">Danh Mục Sản Phẩm</a>
              <a class="collapse-item" href="discount.php">Chương Trình Khuyến Mãi</a>
            </div>
          </li>

        <?php }   ?> 

<!-- Sidebar Toggler (Sidebar) -->
</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">

             Hello, <?php echo Session::get('Name') ?>

           </span>
         </a>
         <!-- Dropdown - User Information -->
         <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

          <a class="dropdown-item" href="editadmin.php?username=<?php  echo $admin_user ?>">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            Thông Tin
          </a>
          <a class="dropdown-item" href="#">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            Cài Đặt
          </a>
         <!--  <a class="dropdown-item" href="#">
            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
            Activity Log
          </a> -->
          <div class="dropdown-divider"></div>

          <a  class="dropdown-item" href="?action=logout">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>

          Đăng Xuất
          </a>

        </div>

      </li>

    </ul>

  </nav>
  <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

          <?php
                                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout_btn'])){
                                    Session::destroy();
                                }
                             ?>
   