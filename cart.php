<?php ob_start();
    include "includes/header.php";

?>
<?php 
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['discount'])){
        $code = $_POST['codediscount'];
   }else{
     $code="";
   }
   if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['undiscount'])){
        $code = "";
   }
 ?>
 <?php  
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitupdate'])){
       $cartId = $_POST['cartId'];
       $quantity = $_POST['quantity'];

        $update_Slcart = $ct->update_Slcart($quantity,$cartId);
    }
?>
<?php  
    if(isset($_GET['delid'])){
        $id = $_GET['delid'];
        $delcat = $ct->delete_cart($id);
    }

?>
<?php 
    $check = Session::get('customer_login');
    $check = true;
    if($check== false){
        header('Location:login.php');
    }else
    {
        
    }
 ?>
<?php  
    if(!isset($_GET['id'])){
       echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";

    }

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
  background-color: #7FAD39;
  border: none;
  border-radius: 15px;
}
  button.stylinggg:hover {background-color: #3e8e41}
  button.stylinggg:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);

}
    input.styling {
         background-color: #7FAD39;
  border: none;
  color: white;
  padding: 7px 12px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
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
                                <span>Hỗ trợ 24/7</span>
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
                        <h2>Thanh Toán Giỏ Hàng</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
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
                                    <th class="shoping__product">Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Size</th>
                                    <th>Số lượng</th>
                                    <th>Thành Tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $a=0;
                                $sub_total = 0; 
                                $sl = 0;
                                $get_cat = $ct->get_Cart();
                                if($get_cat){
                                    
                                    while ($result = $get_cat->fetch_assoc()) {
                                            
                           
                            ?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="admin/uploads/<?php echo $result['image']?>" width="70"? alt="">
                                        <h5><?php echo $result['productName']?> </h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php echo '$'.$fm->format_currency($result['price'])?> 
                                    </td>
                                    <td class="shoping__cart__price">
                                         <?php echo $result['size']?> 
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <form action="" method="post">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="hidden" name="cartId"min = 0 value="<?php echo $result['cartId']?>"/>
                                                <input type="number" name="quantity"min = 0 value="<?php echo $result['quantity']?>"/>

                                            </div>

                                        </div>
                                        <input class="styling" type="submit" name="submitupdate" value="Cập nhật"/>
                                        </form>
                                    </td>

                                    <td class="shoping__cart__total">
                                        <?php $total= $result['price'] * $result['quantity'];                               
                                    echo '$'.$fm->format_currency($total);
                                    $sl +=$result['quantity'];
                                    ?>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <!-- <span class="icon_close"></span> -->
                                        <td><a onclick ="return confirm('Bạn có muốn xóa?')" href="?delid=<?php echo $result['cartId']?>">X</a></td>
                                    </td>
                                </tr>
                            <?php 
                            $sub_total += $total;
                            }

                                    }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Mã giảm giá</h5>
                            <form action="" method="post">
                                <input type="text" name="codediscount" placeholder="Nhập mã giảm giá">
                                <button type="submit" name="discount" class="site-btn">APPLY</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="" method="post">
                    <div class="shoping__checkout">
                        <h5>Hoá đơn thanh toán</h5>
                        <ul>
                            <li>Tạm tính <span><?php  
                                    
                                    echo '$'.$fm->format_currency($sub_total);
                                    
                                ?></span></li>
                            <?php 
                                    $discount = $ct->get_Discount($code);
                                    if($discount){
                                    
                                        while ($result = $discount->fetch_assoc()) {
                                            
                           
                                ?>    
                                 
                            <li>Giảm giá (<?php echo $result['code']?>)

                                <span><?php echo $result['discount']."%"?>(<?php 
                                        $a =($result['discount']*$sub_total)/100;
                                        $a = ceil($a);
                                        echo '$'.$a;

                                  ?>)</span>
                                <?php 
                                    if($result['code']!=""){


                                 ?>
                                <button type="submit" name="undiscount" class="stylinggg">bỏ</button>
                                <?php 
                                } ?>
                            </li>

                            <li>Thành tiền <span><?php  
                                    
                                     $alltotal= ($sub_total - $a);
                                     echo '$'.$alltotal;
                                    Session::set('qtt',$sl);
                                    Session::set('total',$alltotal);
                                ?></td></span></li>
                                <?php 
                            
                            }

                                    }else{
                                     ?>
                                         
                                    <li>Thành tiền <span><?php  
                                    
                                    $alltotal= ($sub_total - $a);
                                    echo '$'.$fm->format_currency($alltotal);
                                    Session::set('qtt',$sl);
                                    Session::set('total',$alltotal);
                                ?></td></span></li>
                                   <?php  
                                   }
                                   ?> 
                           

                        </ul>
                        <?php 
                            $qtt=Session::get("qtt");
                            if($qtt!='0'){
                         ?>
                        <a href="checkout.php" class="primary-btn">TIẾN HÀNH THANH TOÁN</a>
                        <?php 
                        }else{

                         ?>
                           <a href="index.php" class="primary-btn">TIẾN HÀNH THANH TOÁN</a>
                           <?php 
                              }
                                                ?>
                      
                    </div>
                    </form>
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