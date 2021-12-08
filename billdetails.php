<?php ob_start();
    include "includes/header.php";

?>

<style type="text/css">
    
    button.stylinggg {
        display: inline-block;
  padding: 3px 9px;
  font-size: 15px;
  cursor: pointer;
  text-align: center;
  text-decoration: none;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
}
  button.stylinggg:hover {background-color: #3e8e41}
  button.stylinggg:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



</style> 

<style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  font-size: 16px;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 20px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 20px;
  padding-bottom: 22px;
  text-align: left;
  background-color: #7FAD39;
  color: white;
}
</style>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
   <section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Thương hiệu</span>
                    </div>
                    <ul>
                             <?php
                        $show = $brand->show_brand();
                        if($show){
                           
                            while($result = $show->fetch_assoc()){
                         ?>      
                        <li><a href="product.php?brandid=<?php echo $result['brandId'] ?>,&brandName=<?php echo $result['brandName'] ?>"><?php echo $result['brandName'] ?></a></li>
                        <?php 
                            }
                        }
                         ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="product.php" method="GET">
                                <!-- <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div> -->

                                <input type="text" name="namepro" placeholder="Bạn cần thông tin gì?">
                                <button type="" class="site-btn">TÌM KIẾM</button>

                            </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5>0236394059</h5>
                            <span>Hổ trợ 24/7 </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/background.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Thông tin mua hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Trang chủ</a>
                            <span>Thông tin mua hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Sản phẩm</th>

                                    <th>Giá</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                               if (isset($_GET['idbill'])) {
                                  $id_bill=$_GET['idbill'];
                                }

 
                                $get_BillDetails=$bill->get_BillDetails($id_bill);
                                if ($get_BillDetails){
                                    while ($result=mysqli_fetch_array($get_BillDetails)) {
                                        
                             
                               ?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="admin/uploads/<?php echo $result['image']?>" width="70"? alt="">
                                        <h5><?php echo $result['productName'] ?> </h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php echo $result['price']?> 
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php echo $result['size']?> 
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php echo $result['quantity']?> 
                                    </td>

                                    <td class="shoping__cart__total">
                                        <?php $total= $result['price'] * $result['quantity'];                               
                                    echo $total;
                                    
                                    ?>
                                    </td>
                                   
                                </tr>
                            <?php 
                           
                            }

                                    }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
        
        <div class="checkout__form">
            <div class="row">
                <table id="customers" width="100%">
                    <tr>
                        <th>ID</th>
                        <th>Ngày</th>
                        <th>Khách hàng</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                    </tr>
                    <?php
                    $cus=session::get('customer_user');
                    $get_Bill_by_Customer=$bill->get_Bill_by_Customer($cus);
                    if (isset($_GET['idbill'])) {
                        $id_bill=$_GET['idbill'];
                      }
                    if ($get_Bill_by_Customer){
                    while ($result=mysqli_fetch_array($get_Bill_by_Customer) ) {
                        if ($result['order_Id'] == $id_bill) {
                    
                    ?>
                    <tr>
                        <td>#<?php echo $result['order_Id'] ?></td>
                        <td><?php echo $fm->formatDate($result['date']) ?></td>
                        <td><?php echo $result['receiver'] ?></td>
                        <td>$<?php echo  $fm->format_currency($result['totalprice']) ?></td>
                        <?php
                        if ($result['status']==0) {
                          echo '<td class="text-danger">Đang xử lý</td>';
                        }elseif($result['status']==1){
                         echo '<td class="text-success">Đang giao hàng</td>';
                        }elseif($result['status']==2)
                         echo '<td class="text-success">Thành công</td>';
                        else
                            echo '<td class="text-danger">Canncel</td>';
                        ?>
                        
                    </tr>
                    <?php
                    }
                    }
                }
                    ?>
                </table>
            </div>
        </div>
    </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
   <?php
    
    include "includes/footer.php";
    
ob_end_flush();

?>