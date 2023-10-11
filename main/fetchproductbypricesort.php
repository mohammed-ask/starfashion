<?php
include "./function.php";
include "./conn.php";
// print_r($_POST);
$catid = '';
$priceid = '';
$size = '';
$sort = '';
$search = "";
$order = 'order by final_price asc';
if (isset($_POST['catid']) && !empty($_POST['catid'])) {
    $catid = $_POST['catid'];
    $search .= " and category_id = $catid";
}
if (isset($_POST['priceid']) && !empty($_POST['priceid'])) {
    $priceid = $_POST['priceid'];
    $minmax = $obj->selectextrawhere("pricerange", "id=$priceid")->fetch_assoc();
    $search .= " and final_price >= " . $minmax['minamt'] . " and final_price <= " . $minmax['maxamt'] . "";
}
if (isset($_POST['size'])  && !empty($_POST['size'])) {
    $size = $_POST['size'];
    $search .= " and size like '%$size%'";
}

if (isset($_POST['sort'])  && !empty($_POST['sort'])) {
    $sort = $_POST['sort'];
    $order = " order by final_price $sort";
}

$products = $obj->selectextrawhere("products", "status = 1 and isactive='Yes' $search $order");
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
<script>
    $('.set-bg').each(function() {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });
</script>