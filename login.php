<?php
    include 'lib/session.php';
    session::init();
     include_once ("lib/database.php");
    include_once ("helpers/format.php");
    Spl_autoload_register(function ($className){ 
        include_once ("classes/".$className.".php");
    });
    $db=new database();
    $fm=new format();
    $ct=new cart();
    $cat=new category();
    $brand = new brand();
    $pro=new product();
    $city=new city();
    $user=new User();
    $bill=new bill();
?>
<?php 
$buyer= Session::get('customer_user');
 ?>
 <?php  
    if (isset($_GET['customer_user'])) {
        $destroyCart = $ct->Del_cart_by_Session();
        Session::destroy();
    }
?>

<?php 
    ob_start();
?>
<?php 
        $check = Session::get('customer_login');
        if(!isset($check)){
           header('Location:login.php');
        }
?>
<?php 

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $loginCus = $user->Login_Customer($_POST);
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sneaker Shop</title>

    <!-- Favicon -->
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/sign.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Header section start -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>sneaker@shop.com</li>
                                <!-- <li>Miễn phí giao hàng cho hóa đơn từ 99$</li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="admin">Admin</i></a>
                                <a href="about.php">Về chúng tôi</i></a>
                            </div>
                                 <div class="header__top__right__social">
                                     <a href="register.php"><i ></i> Đăng ký</a>
                                 </div>
                            <div class="header__top__right__auth">
                                    <a href="login.php"><i class="fa fa-user"></i>Đăng nhập</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="https://fontmeme.com/permalink/211119/a55336a31565af302eda2de519567d27.png" alt="3d-fonts" border="0"></a>                    </div>
                </div>

                <div class="col-lg-8">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.php">Trang chủ</a></li>
                            <li><a href="./product.php">Sản phẩm</a></li>
                            <li><a href="./saleproduct.php">Hàng giảm giá</a></li>
                            <li><a href="./bill.php">Đơn hàng</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-lg-1">
                    <div class="header__cart">
                        <ul>
                            <!-- Href cart.php -->
                            <li><a href="./cart.php"><i class="fa fa-shopping-bag"></i> <span>
                            </span></a></li>
                        </ul>
                        <!-- <div class="header__cart__price">item: <span> -->
                        </span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header section end -->

    <!-- Signin section start -->
    <div class="container">
        <div class="sign">
        <form action="" method="post">
            <h2>Đăng Nhập</h2>
            <div class="sign-items">
                <div class="input-group-lg">
                    <p>Tên Đăng Nhập</p>
                    <label for="formGroupExampleInput" class="form-label"></label>
                    <input type="text" name="username" required class="form-control" id="formGroupExampleInput" placeholder="Username">
                </div>
                <div class="input-group-lg">
                    <p>Mật Khẩu</p>
                    <label for="formGroupExampleInput2" class="form-label"></label>
                    <input type="password" name="password" required class="form-control" id="formGroupExampleInput2" placeholder="Password">
                    <?php  
                        if(isset($loginCus)){
                                        echo $loginCus;
                                    }
                    ?>  
                </div>
                <button type="submit" name ="login" class="btn btn-success btn-lg">ĐĂNG NHẬP</button>
                <p>Bạn chưa có tài khoản?</p>
                <a href="./register.php">ĐĂNG KÝ</a>
                <p>Hoăc đăng nhập với</p>
                <span>
                    <a href="https://www.facebook.com"><i class="fa fa-facebook fa-lg"></i></a>
                    <a href="https://www.google.com/"><i class="fa fa-google fa-lg"></i></a>
                </span>
            </div>
        </form>
        </div>    
    </div>
    <!-- Signin section end -->

   <!-- Footer Section Start -->
   <footer class="footer spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="footer__about">
                    <div class="footer__about__logo">
                        <a href="./index.php"><img src="img/logo.png" alt=""></a>
                    </div>
                    <ul>
                        <li>  Address: 227 Nguyễn Văn Cừ, Phường 4, Quận 5, Thành phố Hồ Chí Minh</li>
                        <li>  Phone: +84 639 40 59</li>
                        <li>  Email: sneaker@shop.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="footer__widget">
                    <h6>Đăng Ký Thông Báo Ngay Bây Giờ</h6>
                    <p>Nhận thông tin cập nhật mới nhất qua email về cửa hàng của chúng tôi và các ưu đãi đặc biệt trong thời gian sắp tới.</p>
                    <form action="#">
                        <input type="text" placeholder="Email của bạn">
                        <button type="submit" class="site-btn">Đăng Ký</button>
                    </form>
                    <div class="footer__widget__social">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                    </div>

                </div>
            </div>
        </div>

    </div>
</footer>
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>

<?php
 ob_end_flush();

?>