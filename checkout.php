<?php ob_start();
include "includes/header.php";
?>
<?php
    $login = Session::get('customer_login');
    $login = true;
    if($login == false){
        header('Location:login.php');
    }
?>

<?php
    $a = Session::get('qtt');
    if($a == '0') {
        header('Location:cart.php');
    }
?>

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_buy'])){
        $buyer= Session::get('customer_user');
        $insertOrder = $bill->insert_Order($_POST,$buyer);
        $MaxId = $ct->get_Max_Id();
        if($MaxId){
            while ($result = $MaxId->fetch_assoc()){
                $insertOrderDetails = $bill->insert_OrderDetail($result['order_Id']);
            }
        }
        $destroyCart = $ct->Del_cart_by_Session();

        $radioVal = $_POST["payCode"];
        if ($radioVal == "1") {
            header("Location:vnpay_php/index.php");
        } else  {
            header('Location:success.php');
        }
    }
?>

<style>
    ul li label{
        font-weight: 300;
        font-size: 1.35em;
        padding: 5px 10px 05px 10px;
        height: 20px;
        cursor: pointer;
    }

</style>
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
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.php">Trang chủ</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        
        <div class="checkout__form">
            <h4>Chi tiết đơn hàng
            </h4>
            <form action="" method="post">
           
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <?php
                        $userr= Session::get('customer_user');
                        $show_Cus = $user->Get_User($userr);
                        if($show_Cus){
                        while($result =$show_Cus->fetch_assoc()){
                        
                        ?>
                        <div class="checkout__input">
                            <p>Tên khách hàng<span>*</span></p>
                            <input type="text" name="name" value="<?php echo $result['nameCus'] ?>">
                        </div>
                        
                        
                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" name="address" value="<?php echo $result['address'] ?>" class="checkout__input__add">
                            
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" name="phone" value="<?php  echo "0".$result['phone'] ?>">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" value="<?php echo $result['emailCus'] ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    }
                    ?>

                    <?php 
                        $login = Session::get('customer_login');
                        if($login == false){
                            echo <<<END
                            
                            <div class="checkout__input">
                                <p>Tên khách hàng<span>*</span></p>
                                <input type="text" name="name" value="">
                            </div>
                            
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" name="address" value="" class="checkout__input__add">
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="phone" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="">
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            END;
                        }
                    ?>

                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm<span>Thành tiền</span> </div>
                            <ul>
                                <?php
                                
                                $get_cat = $ct->get_Cart();
                                if($get_cat){
                                
                                while ($result = $get_cat->fetch_assoc()) {
                                
                                
                                ?>
                                <li>  <?php
                                    
                                    echo $fm->textShorten($result['productName'],25);
                                    echo " X".$result['quantity'];
                                    ?>  <span><?php echo "$".$fm->format_currency($result['price'])?></span>
                                    <span></span>
                                </li>
                                    <input type="hidden" name="quantity" value="<?php echo $result['quantity']?>"/>
                                    <input type="hidden" name="size" value="<?php echo $result['size']?>"/>
                                    <?php
                                    }
                                    }
                                    ?>
                                </ul>
                                <br>
                                <div class="checkout__order__total">Tổng cộng<span><?php
                                   
                                    $qtt=Session::get("total");
                                    echo "$".$qtt;
                                ?></span></div>
                                <div class="container">
                                    <ul>
                                        <li>
                                            <input type="radio" checked name="payCode" value="0">
                                            <label for="f-option">Ship Code</label>
                                            <div class="check"></div>
                                        </li>
                                        
                                        <li>
                                            <input type="radio" name="payCode" value="1">
                                            <label for="s-option">Thanh toán VNPAY</label>
                                            <div class="check"><div class="inside"></div></div>
                                        </li>
                                    </ul>
                                </div>
                                <input type="submit" name="submit_buy"  value="Đặt hàng" style="margin-left: 70px; font-size: 30px;  padding: 0 10px;background:#7fad39; color: white; ">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </section>
    
    
    <?php
    
    include "includes/footer.php";
    
    ob_end_flush();
?>