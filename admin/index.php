<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
include ("../helpers/format.php");

?>
<?php include '../classes/bill.php'?>
<?php include '../classes/admin.php'?>



<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thông Tin</h1>
  </div>

  <!-- Content Row -->
  <div class="row">


    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Doanh Thu</div>
              <?php 
                $fm = new Format();
                $bill = new bill();
                $gettotal = $bill->totalprice();
                if($gettotal){
                  while ($result = $gettotal->fetch_assoc()) {
                   

                  ?>
                <div class="h5 mb-0 font-weight-bold text-gray-800">$ <?php echo $fm->format_currency($result['total']) ?></div>
              <?php 
                  }
                }

               ?>
              
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1"><a  style="color: #F6C23E" href="listbill.php">Số Lượng Đơn</a></div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

                <?php 
                
                $pending =$bill->getPending();
                if($pending){
                  while ($result = $pending->fetch_assoc()) {
                  
                  ?>
                  <?php echo $result['status'] ?>
                  
                  <?php 

                  }
                }
                ?>

               </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>