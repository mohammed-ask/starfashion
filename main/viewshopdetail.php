<?php
include './main/function.php';
include './main/conn.php';
$rowproduct = $obj->selectextrawhere('products', "id=" . $_GET['hakuna'] . "")->fetch_assoc();
$images = $obj->selectextrawhere('products_images', "productid=" . $_GET['hakuna'] . "");
$otherproducts = $obj->selectextrawhere("products", "category_id =" . $rowproduct['category_id'] . " and status =1 and isactive ='Yes' and id != " . $_GET['hakuna'] . " order by id desc limit 4");
$reviews = $obj->selectextrawhere('review', "productid=" . $_GET['hakuna'] . " and status = 1");
// $tablename = $_GET['hakuna'];
// $content = $obj->selectfieldwhere($tablename, 'content', 'status =1');
ob_flush();
ob_start()
?>
<style>
    .ratings {
        display: flex;
        justify-content: center;
        flex-direction: row-reverse;
    }

    .ratings input {
        display: none;
    }

    .ratings label {
        cursor: pointer;
        font-size: 25px;
        margin: 0 5px;
    }

    .ratings label:before {
        content: "\2605";
    }

    .ratings input:checked~label:before {
        content: "\2605";
        color: gold;
    }
</style>
<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./index.html">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Product Details</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="<?= $obj->fetchattachment($rowproduct['file_products']) ?>">
                                </div>
                            </a>
                        </li>
                        <?php
                        $i = 2;
                        while ($rowimage = $obj->fetch_assoc($images)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-<?= $i ?>" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="<?= $obj->fetchattachment($rowproduct['file_products']) ?>">
                                    </div>
                                </a>
                            </li>
                        <?php $i++;
                        } ?>
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="img/shop-details/thumb-4.png">
                                    <i class="fa fa-play"></i>
                                </div>
                            </a>
                        </li> -->
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="<?= $obj->fetchattachment($rowproduct['file_products']) ?>" alt="">
                            </div>
                        </div>
                        <?php
                        $i = 2;
                        while ($rowimage = $obj->fetch_assoc($images)) { ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-<?= $i ?>" role="tab">
                                    <div class="product__thumb__pic set-bg" data-setbg="<?= $obj->fetchattachment($rowproduct['file_products']) ?>">
                                    </div>
                                </a>
                            </li>
                        <?php $i++;
                        } ?>
                        <!-- 
                        <div class="tab-pane" id="tabs-4" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="img/shop-details/product-big-4.png" alt="">
                                <a href="https://www.youtube.com/watch?v=8PJ3_p7VqHw&list=RD8PJ3_p7VqHw&start_radio=1" class="video-popup"><i class="fa fa-play"></i></a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4><?= $rowproduct['product_name'] ?></h4>
                        <?php
                        $totalreview = $obj->selectfieldwhere("review", "count(id)", "status = 1 and productid= " . $_GET['hakuna'] . "");
                        $totalrating =  $obj->selectfieldwhere("review", "sum(rating)", "status = 1  and productid= " . $_GET['hakuna'] . "");
                        if ($totalreview > 0) {
                            $avgrat = $totalrating / $totalreview;
                        } else {
                            $avgrat = 0;
                        }
                        ?>
                        <div class="rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= ceil($avgrat)) { ?>
                                    <i style="color:gold" class="fa fa-star"></i>
                                <?php } else { ?>
                                    <i class="fa fa-star-o"></i>
                            <?php }
                            } ?>
                            <span> - <?= $totalreview ?> Reviews</span>
                        </div>
                        <h3><?= $currencysymbol . $rowproduct['final_price'] ?> <span><?= $rowproduct['final_price'] < $rowproduct['price'] ? $rowproduct['price'] : '' ?></span></h3>
                        <p><?= $rowproduct['description'] ?></p>
                        <div class="product__details__option">
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                <?php
                                foreach (explode(",", $rowproduct['size']) as $data) { ?>

                                    <label for="<?= $data ?>"><?= $data ?>
                                        <input name="size" value="<?= $data ?>" type="radio" id="<?= $data ?>">
                                    </label>
                                <?php } ?>
                            </div>
                            <div id="sizedetail">

                            </div>
                            <!-- <div class="product__details__option__color">
                                <span>Color:</span>
                                <label class="c-1" for="sp-1">
                                    <input type="radio" id="sp-1">
                                </label>
                                <label class="c-2" for="sp-2">
                                    <input type="radio" id="sp-2">
                                </label>
                                <label class="c-3" for="sp-3">
                                    <input type="radio" id="sp-3">
                                </label>
                                <label class="c-4" for="sp-4">
                                    <input type="radio" id="sp-4">
                                </label>
                                <label class="c-9" for="sp-9">
                                    <input type="radio" id="sp-9">
                                </label>
                            </div> -->
                        </div>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                            <?php
                            $customerid = empty($customerid) ? 0 : $customerid;
                            $chkcart = $obj->selectfieldwhere("cart", 'count(id)', "productid=" . $_GET['hakuna'] . " and userid= " . $customerid . " ");
                            if (empty($chkcart) || $chkcart === 0) { ?>
                                <a style="color:white;cursor:pointer" onclick="addcart(<?= $rowproduct['id'] ?>)" class="primary-btn">add to cart</a>
                            <?php } else { ?>
                                <a style="color:white" onclick="addcart(<?= $rowproduct['id'] ?>)" class="primary-btn">Added to cart</a>
                            <?php } ?>
                        </div>
                        <!-- <div class="product__details__btns__option">
                            <a href="#"><i class="fa fa-heart"></i> add to wishlist</a>
                            <a href="#"><i class="fa fa-exchange"></i> Add To Compare</a>
                        </div> -->
                        <div class="product__details__last__option">
                            <h5><span>Guaranteed Safe Checkout</span></h5>
                            <img src="img/shop-details/details-payment.png" alt="">
                            <ul>
                                <li><span>SKU:</span> <?= $rowproduct['sku'] ?></li>
                                <li><span>Categories:</span><?= $rowproduct['category_txt'] ?></li>
                                <!-- <li><span>Tag:</span> Clothes, Skin, Body</li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                    Previews(<?= $obj->selectfieldwhere('review', 'count(id)', "productid=" . $_GET['hakuna'] . " and status = 1"); ?>)</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Additional
                                    information</a>
                            </li> -->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <?= $rowproduct['description'] ?>
                                </div>
                            </div>

                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content" id="custreview">
                                    <?php
                                    if (!empty($customerid)) {
                                        $chkordered = $obj->selectfieldwhere("orders inner join orderitem on orderitem.orderid = orders.id", "count(orders.id)", "productid=" . $_GET['hakuna'] . " and orders.userid = " . $customerid . " and orders.status = 1");
                                        $chkreview = $obj->selectfieldwhere("review", "count(id)", "productid=" . $_GET['hakuna'] . " and userid=" . $customerid . " and status =1");
                                        if ($chkordered > 0 && $chkreview == 0) { ?>
                                            <form action="process_rating.php" method="post">
                                                <div class="ratings">
                                                    <input type="radio" name="rating" id="star5" value="5">
                                                    <label for="star5"></label>

                                                    <input type="radio" name="rating" id="star4" value="4">
                                                    <label for="star4"></label>

                                                    <input type="radio" name="rating" checked id="star3" value="3">
                                                    <label for="star3"></label>

                                                    <input type="radio" name="rating" id="star2" value="2">
                                                    <label for="star2"></label>

                                                    <input type="radio" name="rating" id="star1" value="1">
                                                    <label for="star1"></label>




                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6 offset-3">
                                                        <textarea style="resize:none" class="form-control mt-1 mb-3" id="customerreview" placeholder="write a review"></textarea>
                                                        <button id="ratingsubmit" class="form-control" value="">Submit Rating</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php }
                                    }
                                    while ($rowreview = $obj->fetch_assoc($reviews)) {
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-5 offset-3 mb-2">
                                                <div class="rating">
                                                    <?php
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        if ($i <= $rowreview['rating']) { ?>

                                                            <i style="color:gold" class="fa fa-star"></i>
                                                        <?php } else { ?>
                                                            <i class="fa fa-star-o"></i>
                                                    <?php }
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div style="height:56px" class="col-sm-5 offset-3 form-control">
                                                <!-- <div  class="col-sm-6 offset-3 form-control"> -->
                                                <?= $rowreview['review'] ?>
                                                <!-- </div> -->

                                            </div>
                                        </div>
                                        <div>
                                            <div class="col-sm-3 offset-7"><strong>- <?= $obj->selectfieldwhere("users", "name", "id=" . $rowreview['userid'] . "") ?></strong></div>
                                        </div>
                                    <?php } ?>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Related Product</h3>
            </div>
        </div>
        <div class="row">
            <?php
            while ($rowpro = $obj->fetch_assoc($otherproducts)) { ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <div class="product__item">
                        <div onclick="window.location.href='shopdetail?hakuna=<?= $rowpro['id'] ?>'" class="product__item__pic set-bg" data-setbg="<?= $obj->fetchattachment($rowpro['file_products']) ?>">
                            <?php if ($rowpro['sticker'] !== 'None') { ?>
                                <span class="label"><?= $rowpro['sticker'] ?></span>
                            <?php } ?>
                            <ul class="product__hover">
                                <!-- <li><a href="#"><img src="main/dist/img/icon/heart.png" alt=""></a></li> -->
                                <!-- <li><a href="#"><img src="main/dist/img/icon/compare.png" alt=""> <span>Compare</span></a></li> -->
                                <li><a href="#"><img src="main/dist/img/icon/search.png" alt=""></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><?= $rowpro['product_name'] ?></h6>
                            <a onclick="addcart(<?= $rowpro['id'] ?>)" class="add-cart text-danger" style="cursor:pointer">+ Add To Cart</a>
                            <?php
                            $totalreview = $obj->selectfieldwhere("review", "count(id)", "status = 1  and productid= " . $rowpro['id'] . "");
                            $totalrating =  $obj->selectfieldwhere("review", "sum(rating)", "status = 1  and productid= " . $rowpro['id'] . "");
                            if ($totalreview > 0) {
                                $avgrat = $totalrating / $totalreview;
                            } else {
                                $avgrat = 0;
                            }
                            ?>
                            <div class="rating">
                                <?php
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= ceil($avgrat)) { ?>
                                        <i style="color:gold" class="fa fa-star"></i>
                                    <?php } else { ?>
                                        <i class="fa fa-star-o"></i>
                                <?php }
                                } ?>
                                <!-- <span> - <?= $totalreview ?> Reviews</span> -->
                            </div>
                            <!-- <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div> -->
                            <h5><?= $currencysymbol ?><?= $rowpro['final_price'] ?></h5>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Related Section End -->
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "Star Fashion Shop";
$contentheader = "";
$pageheader = "";
include "main/templete.php";
?>
<script>
    const addcart = (productid) => {
        event.preventDefault()
        const selectedSize = $('input[name="size"]:checked').val();
        $.post({
            url: "main/addtocart.php",
            data: {
                productid: productid,
                userid: '<?= $customerid ?>',
                size: selectedSize
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

    $('.product__details__option__size input[type="radio"]').on('click', function() {
        const selectedSize = $('input[name="size"]:checked').val();
        // console.log('Selected Size:', selectedSize);
        $.post({
            url: "main/fetchsizedetail.php",
            data: {
                productid: <?= $_GET['hakuna'] ?>,
                size: selectedSize
            },
            success: function(response) {
                console.log(response)
                $('#sizedetail').html(response)
                // if (response === 'Success') {
                //     alertify.success('Item Added to Cart');
                // } else if (response === 'Failed') {
                //     alertify.error('Item Already Added to Cart');
                // }
            },
        });
        // Use the selectedSize variable for further processing
    });

    $('#ratingsubmit').on('click', function() {
        event.preventDefault();
        const selectedRating = $('input[name="rating"]:checked').val();
        const review = $('#customerreview').val();
        // console.log('Selected Size:', selectedRating);
        $.post({
            url: "main/fetchreviews.php",
            data: {
                productid: <?= $_GET['hakuna'] ?>,
                rating: selectedRating,
                review: review
            },
            success: function(response) {
                if (response === 'Success') {
                    alertify.success('Thanks for your review!');
                } else if (response === 'Failed') {
                    alertify.error('Sorry! Something went wrong');
                }
            },
        });
        // Use the selectedSize variable for further processing
    });
</script>