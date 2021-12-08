<?php 
    include "includes/header.php";

?>

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
                                <button type="" class="site-btn">Tìm kiếm</button>

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
                        <h2>SNEAKER SHOP</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Trang chủ</a>
                          
                        <span>Tất cả sản phẩm</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Thương hiệu</h4>
                            <?php
                        $show = $brand->show_brand();
                        if($show){
                           
                            while($result = $show->fetch_assoc()){
                               
                        
                    ?>
                        <ul>

                            <li><a href="product.php?brandid=<?php echo $result['brandId'] ?>,&brandName=<?php echo $result['brandName'] ?>"><?php echo $result['brandName']; ?></a></li>
                            
                        </ul>
                        <?php
                    }
                        }
                        ?> 
                        </div>
                    <style> 
                    input[type=number]#fmin, select {
                        font-size: 18px;
                        width: 100%;
                        padding: 12px 20px;
                        margin: 8px 0;
                        display: inline-block;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        box-sizing: border-box;
                        }
                    input[type=number]#fmax, select {
                        font-size: 18px;
                        width: 100%;
                        padding: 12px 20px;
                        margin: 8px 0;
                        display: inline-block;
                        border: 1px solid #ccc;
                        border-radius: 4px;
                        box-sizing: border-box;
                        }
                        input[type=submit] {
                        width: 100%;
                        background-color: #4CAF50;
                        color: white;
                        padding: 14px 20px;
                        margin: 8px 0;
                        border: none;
                        border-radius: 4px;
                        cursor: pointer;
                        }
                        input[type=submit]:hover {
                        background-color: #45a049;
                        }
                    </style>
                    <?php
                        if(!isset($_GET['mincost']) || $_GET['mincost']==NULL){
                            $mincost = 1;
                            $maxcost = 999;
                        } else {
                            $mincost = $_GET['mincost'];
                            $maxcost = $_GET['maxcost'];
                        }
                    ?>
                    <form action="">
                        <label style="font-size:18px"  for="fname">Giá trị nhỏ nhất</label>
                        <input type="number" id="fmin" min = "0" value = "<?php echo $mincost; ?>" name="mincost" placeholder="Min value">

                        <label style="font-size:18px" for="lname">Giá trị lớn nhất</label>
                        <input type="number" id="fmax" min = "0" value = "<?php echo $maxcost; ?>" name="maxcost" placeholder="Max value">

                        <input style="font-size:18px" type="submit" value="Tìm kiếm">
                    </form>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                   
                        <div class="section-title product__discount__title">
                                   <?php  
                            
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                             $name=$_POST['search'];
                             echo "<h2>Search By '$name'</h2>";
                            
                        }elseif($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['namepro'])) {
                            $name=$_GET['namepro'];
                           echo "<h2>Search By '$name'</h2>";
                        }elseif ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['brandid'])) {
                            $brandname=$_GET['brandName'];
                           echo "<h2>$brandname's Product </h2>";
                        } else{
                           echo'<h2>TẤT CẢ SẢN PHẨM</h2>';
                        
                        }
                       
                        
                        

                        
                        ?>
                            
                            <div class="filter__item">
                        <div class="row">
                            
                            
                        </div>
                    </div>
                    <div class="row">
                            <?php  
                            if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['namepro'])) {
                                 $searchget=" A.productName LIKE  '%".$_GET['namepro']."%' AND";
                             }else{
                                $searchget="";
                             }
                        
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                             $searchpost=" A.productName LIKE  '%".$_POST['search']."%' AND";
                             
                            
                        }else{
                           $searchpost='';
                        }

                        
                            
                        
                 ?>
                        

             <?php 
                if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['brandid'])) {
                    $id=$_GET['brandid'];
                    $getProByBrand=$pro->Show_ProductByBrand($id);
                    if($getProByBrand){
                            while ($result = $getProByBrand->fetch_assoc()) {

                        
               ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="admin/uploads/<?php echo $result['image']?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="details.php?proname=<?php echo $result['productName'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="details.php?proname=<?php echo $result['productName'] ?>"><?php echo $result['productName'] ?></a></h6>
                                    <h5>$<?php echo  $fm->format_currency($result['price']) ?></h5>
                                </div>
                            </div>
                        </div>
            <?php 
                }
            }
             ?>                   
            <?php
                }else{
                    $prodList = $pro->Show_Product($searchpost,$searchget);
                    if(!isset($_GET['mincost']) || $_GET['mincost']==NULL){
                        $mincost = 1;
                        $maxcost = 999;
                    } else {
                        $mincost = $_GET['mincost'];
                        $maxcost = $_GET['maxcost'];
                    }
                        if($prodList){
                        
                            while ($result = $prodList->fetch_assoc()) {
                                if ($result['price'] >= $mincost && $result['price'] <= $maxcost) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="admin/uploads/<?php echo $result['image']?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="details.php?proname=<?php echo $result['productName'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="details.php?proname=<?php echo $result['productName'] ?>"><?php echo $result['productName'] ?></a></h6>
                                    <h5>$<?php echo   $fm->format_currency($result['price']) ?></h5>
                                </div>
                            </div>
                        </div>

            <?php 
                    }  
            
                }
            }
            }
              ?>
                    </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Footer Section Begin -->
<?php
    
    include "includes/footer.php";
    

?>