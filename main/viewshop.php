<?php
include './main/function.php';
include './main/conn.php';
ob_flush();
ob_start();
$catid = '';
$priceid = '';
$size = '';
$sort = '';
$search = "";
$order = 'order by final_price asc';
if (isset($_GET['hakuna'])) {
    $catid = $_GET['hakuna'];
    $search .= " and category_id = $catid";
}
if (isset($_GET['matata']) && !empty($_GET['matata'])) {
    $priceid = $_GET['matata'];
    $minmax = $obj->selectextrawhere("pricerange", "id=$priceid")->fetch_assoc();
    $search .= " and final_price >= " . $minmax['minamt'] . " and final_price <= " . $minmax['maxamt'] . "";
}
if (isset($_GET['sonata'])  && !empty($_GET['sonata'])) {
    $size = $_GET['sonata'];
    $search .= " and size like '%$size%'";
}

if (isset($_GET['prata'])  && !empty($_GET['prata'])) {
    $size = $_GET['prata'];
    $order .= " order by final_price $sort";
}

$products = $obj->selectextrawhere("products", "status = 1 and isactive='Yes' $search $order", 1);
$category = $obj->selectextrawhere("subcategories", "status = 1");
$pricerange = $obj->selectextrawhere("pricerange", "status=1");
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shop</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.html">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <!-- <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div> -->
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <?php
                                                while ($rowcat = $obj->fetch_assoc($category)) {
                                                    $totalproduct = $obj->selectfieldwhere("products", "count(id)", "status=1 and isactive = 'Yes' and category_id = " . $rowcat['id'] . ""); ?>
                                                    <li onclick="applyfilter('Category',<?= $rowcat['id'] ?>)"><a <?= $catid === $rowcat['id'] ? "style='color:black'" : null ?>><?= $rowcat['name'] ?> (<?= $totalproduct ?>)</a></li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                </div>
                                <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__brand">
                                            <ul>
                                                <li><a href="#">Louis Vuitton</a></li>
                                                <li><a href="#">Chanel</a></li>
                                                <li><a href="#">Hermes</a></li>
                                                <li><a href="#">Gucci</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <?php
                                                while ($rowprice = $obj->fetch_assoc($pricerange)) { ?>
                                                    <li onclick="applyfilter('Price',<?= $rowprice['id'] ?>)"><a <?= $priceid === $rowprice['id'] ? "style='color:black'" : null ?>><?= $currencysymbol . $rowprice['minamt'] ?> - <?= $currencysymbol . $rowprice['maxamt'] ?></a></li>
                                                <?php } ?>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                </div>
                                <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__size">
                                            <label <?= $size === 'S' ? "class='active'" : null ?> for="sm">s
                                                <input onclick="applyfilter('Size','S')" value="S" type="radio" id="sm">
                                            </label>
                                            <label <?= $size === 'M' ? "class='active'" : null ?> for="md">m
                                                <input onclick="applyfilter('Size','M')" value="M" type="radio" id="md">
                                            </label>
                                            <label <?= $size === 'L' ? "class='active'" : null ?> for="l">l
                                                <input onclick="applyfilter('Size','L')" value="L" type="radio" id="l">
                                            </label>
                                            <label <?= $size === 'XL' ? "class='active'" : null ?> for="xl">xl
                                                <input onclick="applyfilter('Size','XL')" value="XL" type="radio" id="xl">
                                            </label>
                                            <label <?= $size === 'XXL' ? "class='active'" : null ?> for="xxl">2xl
                                                <input onclick="applyfilter('Size','XXl')" value="XXL" type="radio" id="xxl">
                                            </label>
                                            <label <?= $size === 'xxxl' ? "class='active'" : null ?> for="3xl">3xl
                                                <input onclick="applyfilter('Size','XXXl')" value="xxxl" type="radio" id="3xl">
                                            </label>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                </div>
                                <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__color">
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
                                            <label class="c-5" for="sp-5">
                                                <input type="radio" id="sp-5">
                                            </label>
                                            <label class="c-6" for="sp-6">
                                                <input type="radio" id="sp-6">
                                            </label>
                                            <label class="c-7" for="sp-7">
                                                <input type="radio" id="sp-7">
                                            </label>
                                            <label class="c-8" for="sp-8">
                                                <input type="radio" id="sp-8">
                                            </label>
                                            <label class="c-9" for="sp-9">
                                                <input type="radio" id="sp-9">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                                </div>
                                <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__tags">
                                            <a href="#">Product</a>
                                            <a href="#">Bags</a>
                                            <a href="#">Shoes</a>
                                            <a href="#">Fashio</a>
                                            <a href="#">Clothing</a>
                                            <a href="#">Hats</a>
                                            <a href="#">Accessories</a>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sort by Price:</p>
                                <select id="pricesort">
                                    <option value="asc">Low To High</option>
                                    <option value="desc">High to Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="products">
                    <?php
                    while ($rowproducts = $obj->fetch_assoc($products)) { ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div onclick="window.location.href='shopdetail?hakuna=<?= $rowproducts['id'] ?>'" class="product__item__pic set-bg" data-setbg="<?= $obj->fetchattachment($rowproducts['file_products']) ?>">
                                    <?php if ($rowproducts['sticker'] !== 'None') { ?>
                                        <span class="label"><?= $rowproducts['sticker'] ?></span>
                                    <?php } ?>
                                    <ul class="product__hover">
                                        <!-- <li><a href="#"><img src="main/dist/img/icon/heart.png" alt=""></a></li> -->
                                        <!-- <li><a href="#"><img src="main/dist/img/icon/compare.png" alt=""> <span>Compare</span></a></li> -->
                                        <li><a href="#"><img src="main/dist/img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><?= $rowproducts['product_name'] ?></h6>
                                    <a onclick="addcart(<?= $rowproducts['id'] ?>)" class="add-cart text-danger" style="cursor:pointer">+ Add To Cart</a>
                                    <?php
                                    $totalreview = $obj->selectfieldwhere("review", "count(id)", "status = 1  and productid= " . $rowproducts['id'] . "");
                                    $totalrating =  $obj->selectfieldwhere("review", "sum(rating)", "status = 1  and productid= " . $rowproducts['id'] . "");
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
                                    </div>
                                    <h5><?= $currencysymbol ?><?= $rowproducts['final_price'] ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "Star Fashion Contact Us";
$contentheader = "";
$pageheader = "";
include "main/templete.php";
?>
<script>
    $(document).ready(function() {
        // Select the <select> element by its ID
        $("#pricesort").change(function() {
            // Get the selected option's value
            var selectedValue = $(this).val();
            $.post({
                url: "main/fetchproductbypricesort.php",
                data: {
                    catid: '<?= $catid ?>',
                    priceid: '<?= $priceid ?>',
                    size: '<?= $size ?>',
                    sort: selectedValue
                },
                success: function(response) {
                    $("#products").html(response)
                },
            });
            // Display the selected value in the console
            console.log("Selected Value: " + selectedValue);

            // You can perform further actions based on the selected value here
        });
    });

    const applyfilter = (type, val) => {
        if (type === 'Category') {
            // window.location.href = `shop?hakuna=${val}&matata=&sonata=`
            console.log(type, ' ', val, 'cat')
        } else if (type === 'Price') {
            // window.location.href = `shop?hakuna=&matata=${val}&sonata=`
            console.log(type, ' ', val, 'ppr')
        } else if (type === 'Size') {
            // window.location.href = `shop?hakuna=&matata=&sonata=${val}`
            console.log(type, ' ', val, 'ppr')
        }
        $.post({
            url: "main/fetchsearch.php",
            data: {
                catid: '<?= $catid ?>',
                priceid: '<?= $priceid ?>',
                size: '<?= $size ?>',
                type: type,
                val: val
            },
            success: function(response) {
                console.log(response)
                // eval(response)
                window.location.href = response
                // window.location.href = `shop?hakuna=&matata=&sonata=${val}`

            },
        });
    }
</script>