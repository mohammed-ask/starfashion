<?php
$carttotal = 0.00;
if (!empty($customerid)) {
    $pids = $obj->selectfieldwhere("cart", "group_concat(productid)", "userid=" . $customerid . " and status = 1");
    if (!empty($pids)) {
        $carttotal = $obj->selectfieldwhere("cart inner join products on products.id = cart.productid", "sum(final_price)", "products.id in ($pids) and cart.status = 1 and products.isactive='Yes' and products.status=1");
    }
} elseif (isset($_COOKIE['cartData'])) {
    $CartData = json_decode($_COOKIE['cartData'], true);
    foreach ($CartData as $data) {
        $carttotal += $obj->selectfieldwhere("products", "final_price", "id=" . $data['productid'] . " and status = 1 and isactive='Yes'");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "headincludes.php"; ?>
</head>
<style>
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8) url(main/images/loader.gif) no-repeat center center;
        z-index: 10000;
    }

    .help-block {
        color: red;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }


    .switch {
        position: relative;
        display: inline-block;
        width: 42px;
        height: 20px;
    }

    .switch input {
        display: none;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #eb8a88;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 15px;
        width: 15px;
        left: 0px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #945afa;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #945afa;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(40px);
        -ms-transform: translateX(40px);
        transform: translateX(25px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

    a {
        text-decoration: none !important;
    }

    .anchorstyle:hover {
        color: white !important;
    }

    .menu {
        display: none;
        position: absolute;
        top: 40px;
        right: 10px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        z-index: 999;

    }

    .menu a {
        display: block;
        padding: 10px;
        color: #333;
        text-decoration: none;
    }

    .menu a:hover {
        background-color: #f1f1f1;
    }
</style>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <?php if (!empty($customerid)) { ?>
                    <div class="header__top__hover">
                        <span style="color:black"><?= $customername ?> <i class="arrow_carrot-down"></i></span>
                        <ul>
                            <li class="m-2"><i class="fa fa-user"></i><a style="color:black;margin-left:5px" href="#">Profile</a></li>
                            <li class="m-2"><i class="fa fa-sign-out"></i><a style="color:black" href="logout">Logout</a></li>
                        </ul>
                    </div>
                <?php } else { ?>
                    <a class="anchorstyle" href="login">Sign in</a>
                <?php } ?>
                <a href="faqs">FAQs</a>
            </div>
            <!-- <div class="offcanvas__top__hover">
                <span>Usd <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>USD</li>
                    <li>EUR</li>
                    <li>USD</li>
                </ul>
            </div> -->
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="main/dist/img/icon/search.png" alt=""></a>
            <!-- <a href="#"><img src="main/dist/img/icon/heart.png" alt=""></a> -->
            <a href="cart"><img src="main/dist/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price"><?= $currencysymbol ?><?= number_format($carttotal, 2) ?></div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Free shipping, 6-day return or refund guarantee.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->
    <!-- Top Bar Start -->
    <?php include "header.php"
    ?>
    <!-- Top Bar End -->
    <div>
        <?php echo $pagemaincontent ?>
        <?php //include "sidecolumn.php" 
        ?>

        <?php include "footer.php" ?>
        <!-- end page content -->
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title m-0 mb-n1" id="modalheading">Add Service Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modaldata">
                </div>
                <div class="p-3">
                    <button type="button" class="btn btn-success w-10 my-3" id="modalfooterbtn" onclick="$('#modalsubmit').click();">Submit</button>
                    <!-- <button type="button" class="btn btn-primary" id="modalfooterbtn" onclick="$('#modalsubmit').click();">Save changes</button> -->
                    <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript  -->

    <?php include "footerincludes.php" ?>




</body><!--end body-->

<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>