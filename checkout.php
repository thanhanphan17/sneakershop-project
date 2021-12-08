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

<style>
@import url('https://fonts.googleapis.com/css?family=Lato');

    .container1{
        margin-top: 30px;
        display: block;
        position: relative;
        height: 200px;
        width: 500px;
    }

    .container1 ul{
        list-style: none;
        overflow: auto;
        margin-top: -50px;
        margin-left: -30px;
    }

    .container1 ul li{
        color: #AAAAAA;
        display: block;
        position: relative;
        float: left;
        width: 100%;
        height: 100px;
    }

    .container1 ul li input[type=radio]{
        position: absolute;
        visibility: hidden;
    }

    .container1 ul li label{
        color: #000;
        display: block;
        position: relative;
        font-weight: bold;
        font-size: 20px;
        padding: 25px 25px 25px 25px;
        margin: 0px 40px;
        height: 30px;
        cursor: pointer;
        /* -webkit-transition: all 0.25s linear; */
    }

    .container1 ul li:hover label{
        font-weight: bold;
        color: #0000ff;
    }

    .container1 ul li .check{
        display: block;
        position: absolute;
        border: 5px solid #AAAAAA;
        border-radius: 100%;
        height: 34px;
        width: 34px;
        top: 30px;
        left: 20px;
        z-index: 5;
        transition: border .25s linear;
        -webkit-transition: border .25s linear;
    }

    .container1 ul li:hover .check {
        border: 5px solid #FFFFFF;
    }

    .container1 ul li .check::before {
        display: block;
        position: absolute;
        content: '';
        border-radius: 100%;
        height: 15px;
        width: 15px;
        top: 5px;
        left: 5px;
        margin: auto;
        transition: background 0.25s linear;
        -webkit-transition: background 0.25s linear;
    }

    .container1 input[type=radio]:checked ~ .check {
        border: 5px solid #0DFF92;
    }

    .container1 input[type=radio]:checked ~ .check::before{
        background: #0DFF92;
    }

    .container1 input[type=radio]:checked ~ label{
        color: #0DFF92;
    }
</style>

<?php
    $error = array();
    $data = array();
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_buy'])){
        $data['name'] = isset($_POST['name']) ? $_POST['name'] : '';
        $data['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $data['address'] = isset($_POST['address']) ? $_POST['address'] : '';
        $data['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';

        if (empty($data['name'])){
            $error['name'] = 'Bạn chưa nhập tên';
        }

        if (empty($data['address'])){
            $error['address'] = 'Bạn chưa nhập địa chỉ';
        }

        if (empty($data['email'])){
            $error['email'] = 'Bạn chưa nhập email';
        }

        if (empty($data['phone'])){
            $error['phone'] = 'Bạn chưa nhập số điện thoại';
        }

        if (!$error) {
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

<script>
function validateForm() {
  var x = document.forms["myForm"]["name"].value;
  if (x == "" || x == null) {
    alert("Vui lòng điền tên");
    return false;
  }

  var y = document.forms["myForm"]["address"].value;
  if (y == "" || y == null) {
    alert("Vui lòng điền địa chỉ");
    return false;
  }

  
  var z = document.forms["myForm"]["email"].value;
  if (z == "" || z == null) {
    alert("Vui lòng điền email");
    return false;
  }

  
  var t = document.forms["myForm"]["phone"].value;
  if (t == "" || t == null) {
    alert("Vui lòng điền số điện thoại");
    return false;
  }

}
</script>
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
            <form action="" name="myForm" method="post" onsubmit="return validateForm()">
           
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
                                <input type="text" name="name" id = "name" value="">
                            </div>
                            
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" name="address" id="address" value="" class="checkout__input__add">
                                
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text" name="phone" id="phone" value="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" id="email" value="">
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

                                <div class="container1">
  
                                        <ul>
                                        <li>
                                            <input type="radio" checked id="f-option" name="payCode" value="0">

                                            <label  for="f-option">Thanh toán khi nhận hàng</label>
                                            
                                            <div class="check"></div>
                                        </li>
                                        
                                        <li>
                                            <input type="radio" id="s-option" name="payCode" value="1">
                                            <label for="s-option">Thanh toán VNPAY</label>
                                            
                                            <div class="check"><div class="inside"></div></div>
                                        </li>
                                        
                                        </ul>
                                        </div>

                                    <!-- <ul>
                                        <?php 
                                            $qtt=Session::get("total");
                                            $qtt = (int)$qtt;
                                            if ($qtt !=0) {
                                        ?>
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
                                        <?php 
                                            }
                                        ?>
                                    </ul> -->
                                </div>
                                <input type="submit" name="submit_buy"  value="ĐẶT HÀNG" style="margin-left: 90px; margin-top: 5px; font-size: 22px; font-weight: bold; background:#7fad39; color: white; ">
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