<?php
include "./function.php";
include "./conn.php";
if (!empty($_POST['userid'])) {
    $obj->deletewhere("cart", "userid=" . $_POST['userid'] . " and productid=" . $_POST['productid'] . " and status = 1");
    $cartdata = $obj->selectextrawhereupdate("cart inner join products on products.id = cart.productid ", "products.id,products.file_products,products.product_name,products.final_price", "userid=" . $_POST['userid'] . " and cart.status = 1 and products.isactive='Yes'");
    print_r($cartdata);
    if ($cartdata->num_rows > 0) {
        while ($rowcartdata = $obj->fetch_assoc($cartdata)) {  ?>
            <tr class="cartitems">
                <td class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img style="height: 100px;width:100px" src="<?= $obj->fetchattachment($rowcartdata['file_products']) ?>" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <h6><?= $rowcartdata['product_name'] ?></h6>
                        <h5><?= $currencysymbol . $rowcartdata['final_price'] ?></h5>
                    </div>
                </td>
                <td class="quantity__item">
                    <div class="quantity">
                        <div class="pro-qty-2">
                            <input class="pqty" type="text" value="1">
                        </div>
                        <input hidden class="pprice" type="text" value="<?= $rowcartdata['final_price'] ?>">
                    </div>
                </td>
                <td class="cart__price"><?= $currencysymbol . $rowcartdata['final_price'] ?></td>
                <td class="cart__close"><i style="cursor:pointer" onclick="removecart('<?= $rowcartdata['id'] ?>')" class="fa fa-close"></i></td>
            </tr>
        <?php }
    } else { ?>
        <tr>
            <td colspan="3" style="text-align: center;">
                <img style="height:100px;" src="main/dist/img/lonelycart.jpg" />
                <em>
                    Your cart is feeling a bit lonely. Let's add some items to keep it company!</em>
            </td>
        </tr>
        <?php }
} else {
    $cookiecart = json_decode($_COOKIE['cartData'], true);
    foreach ($cookiecart as $key => $item) {
        if ($item['productid'] === $_POST['productid']) {
            unset($cookiecart[$key]);
        }
    }
    $data = array_values($cookiecart);
    $cookieData = json_encode($data);
    setcookie('cartData', $cookieData, time() + (86400 * 60), '/');
    $productIds = implode(',', array_column($data, 'productid'));
    if (!empty($productIds)) {
        $cartdata = $obj->selectextrawhere("products", "id in ($productIds) and status = 1 and isactive='Yes'");
        while ($rowcartdata = $obj->fetch_assoc($cartdata)) {  ?>
            <tr class="cartitems">
                <td class="product__cart__item">
                    <div class="product__cart__item__pic">
                        <img style="height: 100px;width:100px" src="<?= $obj->fetchattachment($rowcartdata['file_products']) ?>" alt="">
                    </div>
                    <div class="product__cart__item__text">
                        <h6><?= $rowcartdata['product_name'] ?></h6>
                        <h5><?= $currencysymbol . $rowcartdata['final_price'] ?></h5>
                    </div>
                </td>
                <td class="quantity__item">
                    <div class="quantity">
                        <div class="pro-qty-2">
                            <input class="pqty" type="text" value="1">
                        </div>
                        <input hidden class="pprice" type="text" value="<?= $rowcartdata['final_price'] ?>">
                    </div>
                </td>
                <td class="cart__price"><?= $currencysymbol . $rowcartdata['final_price'] ?></td>
                <td class="cart__close"><i style="cursor:pointer" onclick="removecart('<?= $rowcartdata['id'] ?>')" class="fa fa-close"></i></td>
            </tr>
        <?php }
    } else { ?>
        <tr>
            <td colspan="3" style="text-align: center;">
                <img style="height:100px;" src="main/dist/img/lonelycart.jpg" />
                <em>
                    Your cart is feeling a bit lonely. Let's add some items to keep it company!</em>
            </td>
        </tr>
<?php }
};
