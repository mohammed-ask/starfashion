<!-- Header Section Begin -->
<header class="header">
    <div class="header__top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-7">
                    <div class="header__top__left">
                        <p>Free shipping, 6-day return or refund guarantee.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-5">
                    <div class="header__top__right">
                        <div class="header__top__links">
                            <?php if (!empty($customerid)) { ?>
                                <div class="header__top__hover">
                                    <span><?= $customername ?> <i class="arrow_carrot-down"></i></span>
                                    <ul>
                                        <li class="m-2"><i class="fa fa-user"></i><a style="color:black;margin-left:5px" href="#">Profile</a></li>
                                        <li class="m-2"><i class="fa fa-sign-out"></i><a style="color:black" href="logout">Logout</a></li>
                                    </ul>
                                </div>
                            <?php } else { ?>
                                <a class="anchorstyle" href="login">Sign in</a>
                            <?php } ?>
                            <a class="anchorstyle ml-2" href="faqs">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                    <a href="./index.html"><img src="main/dist/img/starfashion.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a class="noun" href="./index">Home</a></li>
                        <li><a class="noun" href="shop">Shop</a></li>
                        <!-- <li><a class="noun" href="blogl">Blog</a></li> -->
                        <li><a class="noun" href="orders">My Orders</a></li>
                        <li><a class="noun" href="info?hakuna=contact_us">Contacts</a></li>
                        <li><a class="noun" href="#">More</a>
                            <ul class="dropdown">
                                <li><a href="info?hakuna=about">About Us</a></li>
                                <!-- <li><a href="./shop-details.html">Shop Details</a></li> -->
                                <!-- <li><a href="./shopping-cart.html">Shopping Cart</a></li> -->
                                <!-- <li><a href="./checkout.html">Check Out</a></li> -->
                                <li><a href="info?hakuna=terms_condition">Terms and Conditions</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                    <a href="#" class="search-switch"><img src="main/dist/img/icon/search.png" alt=""></a>
                    <a href="#"><img src="main/dist/img/icon/heart.png" alt=""></a>
                    <a style="cursor:pointer" onclick="window.location.href='cart'">
                        <img src="main/dist/img/icon/cart.png" alt="">
                        <span>0</span>
                    </a>
                    <div class="price"><?= $currencysymbol ?><?= number_format($carttotal, 2) ?></div>
                    <div id='redirect'></div>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->