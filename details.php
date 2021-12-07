<?php 
    ob_start();
    include "includes/header.php";
?>

<?php 
    if(!isset($_GET['proname']) || $_GET['proname']==NULL){
        echo "<script>window.location = '404.php'</script>";
        
    }else{
        $name = $_GET['proname'];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){

       $size = $_POST['size'];
       $quantity = $_POST['quantity'];
       $addCart = $ct->AddToCart($name,$quantity,$size);
   }
 ?>
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
                        <h2>Product's Package</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <a href="./index.html">Products</a>
                            <span>Product's Package</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <form action="" method="post">  
     <?php
                    
                    $prodList = $pro->get_1Product($name);
                    if($prodList){
                    
                        while ($result_1pro = $prodList->fetch_assoc()) {
                            
                        
                 ?>

    <section class="product-details spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="admin/uploads/<?php echo $result_1pro['image']?>" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $result_1pro['productName'] ?></h3>
                        <div class="product__details__rating">
                        </div>
                        <div class="product__details__price" style="display: inline-block">$<?php echo  $fm->format_currency($result_1pro['price']) ?></div>
                        <?php
                            if(!isset($_GET['discount']) || $_GET['discount']==NULL){
                                $a = 10;                                
                            }else{
                        ?>
                            <div class="product__details__price" style="text-decoration: line-through; color: #828282">
                            $<?php echo  $fm->format_currency($result_1pro['price']) * 110 / 100 ?></div>

                        <?php
                            }
                        ?>
                        <p><?php echo $result_1pro['description']?></p>
                         
                            <select id="size" name="size" class="">
                                <!-- <option>Chọn size</option> -->
                                <?php
                   
                                    $size = $pro->getSize_1Product($name);
                                    if($size){
                                        while ($result1 = $size->fetch_assoc()) {
                                            
                                    ?>
                                        <option><?php echo $result1['size']?></option>
                                    <?php  
                                    }
                                }
                                ?>
                            </select>
                        
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="quantity" type="text" value="1" min="1">
                                </div>
                            </div>
                        </div>
                       
                        <button type="submit" class="site-btn" name="submit">ADD TO CARD</button>
                        
                        <ul>
                            <li><b>Availability</b> <span>In Stock</span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
      <?php  
                                    }
                                }
                                ?>
                                </form> 
       
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    
    <!-- Related Product Section End -->

    <!-- Footer Section Begin -->
<?php
    include "includes/footer.php";
    ob_end_flush();
?>