<?php
include './main/function.php';
include './main/conn.php';
$cartdata = [];
$subtotal = 0;
$total = 0;
if (!empty($customerid)) {
    $cartdata = $obj->selectextrawhereupdate("cart inner join products on products.id = cart.productid ", "products.id,products.file_products,products.product_name,products.final_price", "userid=" . $customerid . " and cart.status = 1 and products.isactive='Yes'");
    $subtotal = $obj->selectfieldwhere("cart inner join products on products.id = cart.productid ", "sum(final_price)", "userid=" . $customerid . " and cart.status = 1 and products.isactive='Yes' and products.status = 1");
    $total = $subtotal;
} else {
    $cookiecart = json_decode($_COOKIE['cartData'], true);
    $productIds = implode(',', array_column($cookiecart, 'productid'));
    if (!empty($productIds)) {
        $cartdata = $obj->selectextrawhere("products", "id in ($productIds) and status = 1 and isactive='Yes'");
        $subtotal = $obj->selectfieldwhere("products", "sum(final_price)", "id in ($productIds) and status = 1 and isactive='Yes'");
        $total = $subtotal;
    }
}
// $tablename = $_GET['hakuna'];
// $content = $obj->selectfieldwhere($tablename, 'content', 'status =1');
ob_flush();
ob_start()
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Shopping Cart</h4>
                    <div class="breadcrumb__links">
                        <a href="index">Home</a>
                        <a href="shop">Shop</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table id="products">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ((empty($customerid) && !empty($cartdata)) || $cartdata->num_rows > 0) {
                                while ($rowcartdata = $obj->fetch_assoc($cartdata)) { ?>
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
                                    <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="shop">Continue Shopping</a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn update__btn">
                            <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-lg-4 totalsection">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" class="couponname" placeholder="Coupon code">
                        <button onclick="event.preventDefault();applycoupon()">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span id="subtotal"><?= $currencysymbol . number_format($subtotal, 2) ?></span></li>
                        <input hidden class="coupondiscount" type="text" value="<?= 0 ?>">
                        <li>Total <span id="finaltotal"><?= $currencysymbol . number_format($total, 2) ?></span></li>
                    </ul>
                    <a href="checkout" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "Star Fashion Cart";
$contentheader = "";
$pageheader = "";
include "main/templete.php";
?>
<script>
    const removecart = (productid) => {
        var tbody = $('#products tbody');
        // tbody.html('')
        $.post({
            url: "main/removecartproduct.php",
            data: {
                productid: productid,
                userid: '<?= $customerid ?>'
            },
            success: function(response) {
                tbody.html(response);
                cartamount()
            },
        });
    }

    const applycoupon = () => {
        var cname = $(".couponname").val()
        var amountsection = $('.totalsection');
        // amountsection.html('')
        var subtotal = $("#subtotal").html()
        $.post({
            url: "main/fetchcoupon.php",
            data: {
                cname: cname,
                subtotal: subtotal
            },
            success: function(response) {
                if (response === 'Not Found') {
                    alertify.error('It appears the coupon code you provided is not valid. Feel free to try again or contact our support team for assistance.')
                } else if (response === 'Not Valid') {
                    alertify.error('Oops! Your order total doesn\'t meet the minimum amount required for this coupon. Please add more items to your cart and enjoy the discount.')
                } else {
                    amountsection.html(response);
                }
            },
        });
    }

    const cartamount = () => {
        var total = 0
        var discount = 0;
        $('.cartitems').each(function() {
            val = $(this).html()
            price = $(this).find('.pprice').val()
            qty = $(this).find('.pqty').val()
            producttotal = price * qty
            console.log(producttotal)
            $(this).find('.cart__price').html('<?= $currencysymbol ?>' + producttotal)
            total += producttotal
        })
        cdiscount = $('.coupondiscount').val()
        coupontype = $('.coupontype').val()
        percent = $('.couponpercent').val()
        console.log(cdiscount, 'cd', percent, coupontype)
        $('#subtotal').html('<?= $currencysymbol ?>' + total.toFixed(2))
        if (coupontype === 'Percent') {
            discount = total * percent / 100
            total = total - discount
        } else {
            discount = parseFloat(cdiscount)
            total -= cdiscount
        }
        $('.discountamt').html('<?= $currencysymbol ?>' + discount.toFixed(2))
        $('#finaltotal').html('<?= $currencysymbol ?>' + total.toFixed(2))

    }
</script>