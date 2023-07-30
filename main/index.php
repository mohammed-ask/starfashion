<?php
include './main/function.php';
include './main/conn.php';

ob_start();
$rowslides = $obj->selectextrawhere("slide", "isactive='Yes' and status = 1");
$featured = $obj->selectextrawhere("products", "isactive='Yes' and status = 1 and product_display_position like '%Featured%' order by id desc limit 3 ");
$bestseller = $obj->selectextrawhere("products", "isactive='Yes' and status = 1 and product_display_position like '%Best-Seller%' order by id desc limit 8 ");
$newarrival = $obj->selectextrawhere("products", "isactive='Yes' and status = 1 and product_display_position like '%New-Arrival%' order by id desc limit 8 ");
$hotsales = $obj->selectextrawhere("products", "isactive='Yes' and status = 1 and product_display_position like '%Hot-Sales%' order by id desc limit 8 ");
$rowspecial = $obj->selectextrawhere("products", "isactive='Yes' and status = 1 and product_display_position like '%Special%' order by id desc limit 1 ")->fetch_assoc();
// echo "<pre>";
$rowfeatured = mysqli_fetch_all($featured, 1);
$rowbestseller = mysqli_fetch_all($bestseller, 1);
$rownewarrival = mysqli_fetch_all($newarrival, 1);
$rowhotsales = mysqli_fetch_all($hotsales, 1);
$alltrends = array_merge($rowbestseller, $rownewarrival, $rowhotsales);
$alltrendsfiltered = array();
foreach ($alltrends as $item) {
    $id = $item['id'];
    if (!isset($alltrendsfiltered[$id])) {
        $alltrendsfiltered[$id] = $item;
    }
}
// print_r($uniqueArr);
// echo "</pre>";

?>
<style>
    .size {
        width: 470px;
        height: 470px;
    }
</style>
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <?php
        while ($rowdata = $obj->fetch_assoc($rowslides)) { ?>
            <div class="hero__items set-bg" data-setbg="<?= $obj->fetchattachment($rowdata['file_picture']) ?>">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6><?= $rowdata['title'] ?></h6>
                                <h2><?= $rowdata['heading'] ?></h2>
                                <p><?= $rowdata['desc'] ?></p>
                                <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                                <div class="hero__social">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- <div class="hero__items set-bg" data-setbg="main/dist/img/hero/hero-2.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Summer Collection</h6>
                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <?php if (isset($rowfeatured[0])) { ?>
                <div class="col-lg-7 offset-lg-4">
                    <div class="banner__item">
                        <div class="banner__item__pic size">
                            <img src="<?= $obj->fetchattachment($rowfeatured[0]["file_products"]) ?>" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2><?= $rowfeatured[0]['product_name'] ?></h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            <?php }
            if (isset($rowfeatured[1])) {  ?>
                <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic size">
                            <img src="<?= $obj->fetchattachment($rowfeatured[1]["file_products"])  ?>" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2><?= $rowfeatured[1]['product_name'] ?></h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            <?php }
            if (isset($rowfeatured[2])) {  ?>
                <div class="col-lg-7">
                    <div class="banner__item banner__item--last">
                        <div class="banner__item__pic size">
                            <img src="<?= $obj->fetchattachment($rowfeatured[2]["file_products"]) ?>" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2><?= $rowfeatured[2]['product_name'] ?></h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="main/dist/img/banner/banner-3.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>Shoes Spring 2030</h2>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".Best-Seller">Best Sellers</li>
                    <li data-filter=".New-Arrival">New Arrivals</li>
                    <li data-filter=".Hot-Sales">Hot Sales</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php foreach ($alltrendsfiltered as $key => $value) { ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix <?= str_replace(',', ' ', $value['product_display_position']) ?>">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="<?= $obj->fetchattachment($value['file_products']) ?>">
                            <?php if ($value['sticker'] !== 'None') { ?>
                                <span class="label"><?= $value['sticker'] ?></span>
                            <?php } ?>
                            <ul class="product__hover">
                                <li><a href="#"><img src="main/dist/img/icon/heart.png" alt=""></a></li>
                                <!-- <li><a href="#"><img src="main/dist/img/icon/compare.png" alt=""> <span>Compare</span></a></li> -->
                                <li><a href="#"><img src="main/dist/img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><?= $value['product_name'] ?></h6>
                            <a onclick="addcart(<?= $value['id'] ?>)" class="add-cart text-danger" style="cursor:pointer">+ Add To Cart</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5><?= $currencysymbol ?><?= $value['final_price'] ?></h5>
                            <div class="product__color__select">
                                <label for="pc-1">
                                    <input type="radio" id="pc-1">
                                </label>
                                <label class="active black" for="pc-2">
                                    <input type="radio" id="pc-2">
                                </label>
                                <label class="grey" for="pc-3">
                                    <input type="radio" id="pc-3">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Categories Section Begin -->
<section class="categories spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="categories__text">
                    <h2><?= $rowspecial['parent_category_txt'] ?> <br /> <span><?= $rowspecial['category_txt'] ?></span> <br /> <?= $rowspecial['product_name'] ?></h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories__hot__deal">
                    <img src="<?= $obj->fetchattachment($rowspecial["file_products"]) ?>" alt="">
                    <div class="hot__deal__sticker">
                        <span>Sale Of</span>
                        <h5><?= $currencysymbol ?><?= $rowspecial['discount'] ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">
                <div class="categories__deal__countdown">
                    <span>Deal Of The Week</span>
                    <h2><?= $rowspecial['product_name'] ?></h2>
                    <div class="categories__deal__countdown__timer" id="countdown">
                        <div class="cd-item">
                            <span>3</span>
                            <p>Days</p>
                        </div>
                        <div class="cd-item">
                            <span>1</span>
                            <p>Hours</p>
                        </div>
                        <div class="cd-item">
                            <span>50</span>
                            <p>Minutes</p>
                        </div>
                        <div class="cd-item">
                            <span>18</span>
                            <p>Seconds</p>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">Shop now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Instagram Section Begin -->
<section class="instagram spad mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="instagram__pic">
                    <div class="instagram__pic__item set-bg" data-setbg="main/dist/img/instagram/instagram-1.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="main/dist/img/instagram/instagram-2.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="main/dist/img/instagram/instagram-3.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="main/dist/img/instagram/instagram-4.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="main/dist/img/instagram/instagram-5.jpg"></div>
                    <div class="instagram__pic__item set-bg" data-setbg="main/dist/img/instagram/instagram-6.jpg"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="instagram__text">
                    <h2>Instagram</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.</p>
                    <h3>#Fellow</h3>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram Section End -->

<!-- Latest Blog Section Begin -->
<!-- <section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <span>Latest News</span>
                    <h2>Fashion New Trends</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="main/dist/img/blog/blog-1.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="main/dist/img/icon/calendar.png" alt=""> 16 February 2020</span>
                        <h5>What Curling Irons Are The Best Ones</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="main/dist/img/blog/blog-2.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="main/dist/img/icon/calendar.png" alt=""> 21 February 2020</span>
                        <h5>Eternity Bands Do Last Forever</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="main/dist/img/blog/blog-3.jpg"></div>
                    <div class="blog__item__text">
                        <span><img src="main/dist/img/icon/calendar.png" alt=""> 28 February 2020</span>
                        <h5>The Health Benefits Of Sunglasses</h5>
                        <a href="#">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Latest Blog Section End -->
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "Star Fashion Homepage";
$contentheader = "";
$pageheader = "";
include "main/templete.php";
?>
<script>
    const addcart = (productid) => {
        $.post({
            url: "main/addtocart.php",
            data: {
                productid: productid,
                userid: '<?= $customerid ?>'
            },
            success: function(response) {
                console.log(response)
                if (response === 'Success') {
                    alertify.success('Item Added to Cart');
                } else if (response === 'Failed') {
                    alertify.error('Item Already Added to Cart');
                }
            },
        });
    }
</script>