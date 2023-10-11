<?php
include './main/function.php';
include './main/conn.php';
ob_flush();
ob_start();
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// die;
$customerdata = [];
if (!empty($customerid)) {
    $customerdata = $obj->selectextrawhere("users", "id=" . $customerid . "")->fetch_assoc();
} elseif (!empty($_POST)) {
    $checkoutData = json_encode($_POST);
    setcookie('checkoutData', $checkoutData, time() + (86400 * 60), '/');
    header('location:login');
} else {
    header('location:cart');
}
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Check Out</h4>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
                        <a href="./shop">Shop</a>
                        <span>Check Out</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="insertorder" id="checkout" method="post" onsubmit="event.preventDefault();sendForm('', '', 'insertorder', 'resultid', 'checkout');return 0;">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                here</a> to enter your code</h6>
                        <h6 class="checkout__title">Billing Details</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout__input">
                                    <p>Name<span>*</span></p>
                                    <input value="<?= !empty($customerdata) ? $customerdata['name'] : '' ?>" type="text">
                                </div>
                            </div>
                            <!-- <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Last Name<span>*</span></p>
                                    <input value="<?= !empty($customerdata) ? $customerdata['name'] : '' ?>" type="text">
                                </div>
                            </div> -->
                        </div>
                        <div class="checkout__input">
                            <p>Country<span>*</span></p>
                            <input value="<?= !empty($customerdata) ? $obj->selectfieldwhere("country", "country_name", "id=" . $customerdata['country_id'] . "") : '' ?>" name="country" type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Address<span>*</span></p>
                            <input value="<?= !empty($customerdata) ? $customerdata['address'] : '' ?>" name="address" type="text" placeholder="Street Address" class="checkout__input__add">
                            <!-- <input type="text" placeholder="Apartment, suite, unite ect (optinal)"> -->
                        </div>
                        <div class="checkout__input">
                            <p>Town/City<span>*</span></p>
                            <input value="<?= !empty($customerdata) ? $customerdata['city'] : '' ?>" name="city" type="text">
                        </div>
                        <div class="checkout__input">
                            <p>Country/State<span>*</span></p>
                            <input type="text" name="state" value="<?= !empty($customerdata) ? $customerdata['state'] : '' ?>">
                        </div>
                        <div class="checkout__input">
                            <p>Postcode / ZIP<span>*</span></p>
                            <input value="<?= !empty($customerdata) ? $customerdata['zip'] : '' ?>" name="zip" type="text">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Phone<span>*</span></p>
                                    <input value="<?= !empty($customerdata) ? $customerdata['mobile'] : '' ?>" name="phone" type="text">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input value="<?= !empty($customerdata) ? $customerdata['email'] : '' ?>" name="email" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="checkout__input">
                            <p>Order notes<span>*</span></p>
                            <input type="text" name="ordernote" placeholder="Notes about your order, e.g. special notes for delivery.">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Your order</h4>
                            <div class="checkout__order__products">Product <span>Total</span></div>
                            <ul class="checkout__total__products">
                                <?php
                                $i = 1;
                                foreach ($_POST['productid'] as $key => $data) {
                                ?>
                                    <input name="productid[]" hidden value="<?= $data ?>" type="text">
                                    <input name="qty[]" hidden value="<?= $_POST['pqty'][$key] ?>" type="text">
                                    <input name="price[]" hidden value="<?= $_POST['pprice'][$key] ?>" type="text">
                                    <input name="size[]" hidden value="<?= $_POST['size'][$key] ?>" type="text">

                                    <li><?= $i . '. ' . $obj->selectfieldwhere('products', 'product_name', 'id=' . $data . ' and status = 1 and isactive="Yes"') ?> <span><?= $currencysymbol . $_POST['pprice'][$key] ?></span></li>
                                <?php $i++;
                                } ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <input name="subtotal" hidden value="<?= $_POST['subtotal'] ?>" type="text">
                                <input name="discount" hidden value="<?= $_POST['coupondiscount'] ?>" type="text">
                                <?php
                                if (isset($_POST['couponid'])) { ?>
                                    <input name="couponid" hidden value="<?= $_POST['couponid'] ?>" type="text">
                                <?php } ?>
                                <input name="total" hidden value="<?= $_POST['finaltotal'] ?>" type="text">

                                <li>Subtotal <span><?= $currencysymbol . $_POST['subtotal'] ?></span></li>
                                <?=
                                $_POST['coupondiscount'] > 0 ? "<li>Discount <span>" . $currencysymbol . $_POST['coupondiscount'] . '</span></li>' : null; ?>
                                <li>Total <span><?= $currencysymbol . $_POST['finaltotal'] ?></span></li>
                            </ul>
                            <button type="submit" class="site-btn">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
                <div id="resultid"></div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<?php
//Assign all Page Specific variables
$pagemaincontent = ob_get_contents();
ob_end_clean();
$pagemeta = "";
$pagetitle = "Star Fashion Checkout";
$contentheader = "";
$pageheader = "";
include "main/templete.php";
?>