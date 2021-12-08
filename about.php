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
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sneaker Shop</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
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
    <link rel="stylesheet" href="css/about.css" type="text/css">

</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

   
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>sneaker@shop.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="admin">Admin</i></a>
                                <a href="about.php">Về chúng tôi</i></a>
                                <?php 
                                    $login = Session::get('customer_login');
                                    // $login = true;
                                    if($login == false){
                                    } else {
                                        echo '<a href="profile.php">Trang cá nhân</i></a>';
                                       
                                        // echo  '<li><a href="./bill.php">Đơn hàng</a></li>';
                                    }
                                ?>  
                            </div>
                            
                            <?php 
                                $check = Session::get('customer_login');
                                // $check = true;
                                if ($check== false) {
                            ?>
                                 <div class="header__top__right__social">
                                     <a href="register.php"><i ></i> Đăng ký</a>
                                 </div>
                                 
                            <?php 
                                }
                             ?>             
                            <div class="header__top__right__auth">
                                <?php 
                                    $check = Session::get('customer_login');
                                    if($check== false){
                                        echo '<a href="login.php"><i class="fa fa-user"></i>Đăng nhập</a>';
                                    } else {
                                        echo '<a href="?customer_user='.Session::get('customer_user').'"><i class="fa fa-user"></i>Đăng xuất</a></div>'; 
                                    }
                                ?>
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
                    <a href="./index.php"><img src="https://fontmeme.com/permalink/211119/a55336a31565af302eda2de519567d27.png" alt="3d-fonts" border="0"></a>                    
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="./index.php">Trang chủ</a></li>
                            <li><a href="./product.php">Sản phẩm</a></li>
                            <li><a href="./saleproduct.php">Hàng giảm giá</a></li>
                            <li><a href="./bill.php">Đơn hàng</a></li>
                            
                            <?php 
                                $login = Session::get('customer_login');
                                $login = true;
                                if($login == false){
                                    echo '';
                                } else {
                                    // echo  '<li><a href="./profile.php">Thông tin </a></li>';
                                    // echo  '<li><a href="./bill.php">Đơn hàng</a></li>';
                                }
                            ?>                         
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="cart.php"><i class="fa fa-shopping-bag"></i> <span>
                                <?php  
                                        $qtt = '0';
                                        $qtt=Session::get("qtt");
                                        echo $qtt;
                                ?></span></a></li>
                        </ul>
                        <div class="header__cart__price">Total: <span>
                            <?php  
                                        $a = '0';
                                        $a=Session::get('total');
                                        echo '$'.$a ;
                            ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header section end -->
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
                                <span>Hổ trợ 24/7</span>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="hero__item set-bg" data-setbg="img/banner.jpg"> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About section start -->
    <section class="about">
        <div class="member">
            <div class="container">
                <h2>Thành Viên</h2>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <img src="./img/members/Thu.png" alt="Avatar">
                        <h4>Lê Anh Thư</h4>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <img src="./img/members/Thien.png" alt="Avatar">
                        <h4>Huỳnh Đức Thiện</h4>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <img src="./img/members/An.png" alt="Avatar">
                        <h4>Phan Thanh An</h4>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="./img/members/Phuc.png" alt="Avatar">
                        <h4>Châu Hoàng Bảo Phúc</h4>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <img src="./img/members/Bao.png" alt="Avatar">
                        <h4>Phạm Hồng Gia Bảo</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About section end -->

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
            <!-- <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                <div class="footer__widget">
                    <h6>Useful Links</h6>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">About Our Shop</a></li>
                        <li><a href="#">Secure Shopping</a></li>
                        <li><a href="#">Delivery infomation</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Our Sitemap</a></li>
                    </ul>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Projects</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Innovation</a></li>
                        <li><a href="#">Testimonials</a></li>
                    </ul>
                </div>
            </div> -->
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