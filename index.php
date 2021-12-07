<?php
    include "includes/header.php";
?>
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Thương hiệu</span>
                        </div>
                         <?php
                             $show = $brand->show_brand();
                            if ($show) {
                                while ($result = $show->fetch_assoc()) {
                        ?>
                            <ul>
                                <li><a href="product.php?brandid=<?php echo $result['brandId'] ?>,&brandName=<?php echo $result['brandName'] ?>"><?php echo $result['brandName']; ?></a></li>
                            </ul>
                        <?php
                                }
                            }
                        ?> 
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
                    <div class="hero__item set-bg" data-setbg="img/banner.jpg">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    
    <!-- Categories Section End -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm nổi bật</h2>
                    </div>
                    
                </div>
            </div>
            <div class="row featured__filter">
            <?php 
                $get_ProductbyType = $pro->Get_ProductFeathered();
                if ($get_ProductbyType) {
                    while($result =$get_ProductbyType->fetch_assoc()) {
                
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="admin/uploads/<?php echo $result['image']?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="details.php?proname=<?php echo $result['productName'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="details.php?proname=<?php echo $result['productName'] ?>"><?php echo $result['productName'] ?></a></h6>
                            <h5>$<?php echo $result['price'] ?> </h5>
                        </div>
                    </div>
                </div>
            <?php  
                    } // end while
                } // end if
            ?>
            </div>
        </div>
    </section>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm mới</h2>
                    </div>
                    
                </div>
            </div>
            <div class="row featured__filter">
            <?php 
                $get_ProductbyType = $pro->get_ProductNew();
                if($get_ProductbyType){
                    while($result =$get_ProductbyType->fetch_assoc()){
            ?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="admin/uploads/<?php echo $result['image']?>">
                            <ul class="featured__item__pic__hover">
                                <li><a href="details.php?proname=<?php echo $result['productName'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="details.php?proname=<?php echo $result['productName'] ?>"><?php echo $result['productName'] ?></a></h6>
                            <h5>$<?php echo $result['price'] ?> </h5>
                        </div>
                    </div>
                </div>
            <?php  
                    } // end while
                } // end if
            ?>
                
            </div>
        </div>
    </section>
   
<?php
    include "includes/footer.php";
?>
