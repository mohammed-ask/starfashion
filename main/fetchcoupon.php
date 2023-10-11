<?php
include "./function.php";
include "./conn.php";
// print_r($_POST);
// die;
$couponname = $_POST['cname'];
$subtotal = str_replace(['₹', ','], '', $_POST['subtotal']);
$rowcoupon = $obj->selectextrawhere('coupon', "name='" . $couponname . "' and status = 1 and expirydate > date(Now()) ")->fetch_assoc();
$couponused = $obj->selectfieldwhere("orders", "count(id)", "couponid = " . $rowcoupon['id'] . " and userid = " . $customerid . " and status = 1");
if (empty($rowcoupon)) {
    echo "Not Found";
} else if ($subtotal < $rowcoupon['orderabove']) {
    echo "Not Valid";
} else if ($couponused != 0) {
    echo "Used";
} else {
    $discountamt = $rowcoupon['type'] === 'Amount' ? $rowcoupon['number'] : $subtotal * $rowcoupon['number'] / 100;
    $total = $subtotal - $discountamt;
?>
    <div class="cart__discount">
        <h6>Discount codes</h6>
        <!-- <form action="#"> -->
        <div>
            <input type="text" readonly value="<?= $couponname ?>" class="couponname" placeholder="Coupon code">
            <button onclick="event.preventDefault();applycoupon()">Applied</button>
        </div>
        <!-- </form> -->
    </div>
    <div class="cart__total">
        <h6>Cart total</h6>
        <ul>
            <li>Subtotal <span id="subtotal"><?= $currencysymbol . number_format($subtotal, 2) ?></span></li>
            <input hidden name="coupondiscount" class="coupondiscount" type="text" value="<?= $discountamt ?>">
            <input hidden class="coupontype" type="text" value="<?= $rowcoupon['type'] ?>">
            <input hidden class="couponpercent" type="text" value="<?= $rowcoupon['number'] ?>">
            <input hidden class="coupontype" name="couponid" type="text" value="<?= $rowcoupon['id'] ?>">
            <input hidden name="subtotal" id="subtotalinput" type="text" value="<?= $subtotal ?>">
            <input hidden name="finaltotal" id="finaltotalinput" type="text" value="<?= $total ?>">
            <li>Discount <span class="discountamt"><?= $currencysymbol . number_format($discountamt, 2) ?></span></li>
            <li>Total <span id="finaltotal"><?= $currencysymbol . number_format($total, 2) ?></span></li>
        </ul>
        <button type="submit" class="primary-btn">Proceed to checkout</button>
    </div>
<?php }
?>