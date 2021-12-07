<?php  ob_start();
include "includes/header.php";
?>
<?php 
$check = Session::get('customer_login');
    if($check== true){
        header('Location:index.php');
    }
 ?>
<?php

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])){
    $insert_Customer=$user->insert_Customer($_POST);
}
?>
 <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript" charset="utf-8" async defer></script>
                    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<link rel="stylesheet" href="css/sign.css" type="text/css">


    <div class="container">
        
        <div class="checkout__form">
            <h2 style="text-align: center;">Đăng ký tài khoản</h2>
            <center><h3><?php if (isset($insert_Customer)) {
            echo $insert_Customer;

      } ?></h3></center>
            <form action="register.php" method="post">
                <div class="row">
                    <div class="modal-body">
                        <!-- <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Fist Name<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input type="text">
                                </div>
                            </div>
                        </div> -->
                        <div class="checkout__input">
                            <p>Tài khoản<span>*</span></p>
                            <input type="text" name="username" placeholder="Enter Username">
                        </div>
                        <div class="checkout__input">
                            <p> họ và tên<span>*</span></p>
                            <input type="text" name="name" placeholder="Enter Name">
                        </div>
                        <div class="checkout__input">
                            <p> Mật khẩu<span>*</span></p>
                            <input type="password" name="password" placeholder="Enter Password">
                        </div>
                        <div class="checkout__input">
                            <p>Nhật lại mật khẩu<span>*</span></p>
                            <input type="password" name="repeatpassword" placeholder="Repeat Password">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" name="phone" placeholder="Enter Phone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" name="email" placeholder="Enter Email">
                                </div>
                            </div>
                            
                        </div>

                                <div class="checkout__input">
                                    <p>Địa chỉ<span>*</span></p>
                                    <input type="text" name="address" placeholder="Enter Address">
                                </div>
                           
                        <td>
                        	
                        <center><button type="submit" class="btn btn-success btn-lg" name="register">Đăng ký</button></center>
                        </td>
                    </div>  	
                    
                </form>
            </div>
        </div>
        
    <?php
    include "includes/footer.php";
    
    ob_end_flush();?>