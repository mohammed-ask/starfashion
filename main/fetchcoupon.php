<?php
include "./function.php";
include "./conn.php";
// print_r($_POST);
// die;
$couponname = $_POST['cname'];
$subtotal = str_replace(['₹', ','], '', $_POST['subtotal']);
$rowcoupon = $obj->selectextrawhere('coupon', "name='" . $couponname . "' and status = 1 and expirydate > date(Now()) ")->fetch_assoc();
if (empty($rowcoupon)) {
    echo "Not Found";
} else if ($subtotal < $rowcoupon['orderabove']) {
    echo "Not Valid";
} else {
    $discountamt = $rowcoupon['type'] === 'Amount' ? $rowcoupon['number'] : $subtotal * $rowcoupon['number'] / 100;
    $total = $subtotal - $discountamt;
?>
    <div class="cart__discount">
        <h6>Discount codes</h6>
        <form action="#">
            <input type="text" readonly value="<?= $couponname ?>" class="couponname" placeholder="Coupon code">
            <button onclick="event.preventDefault();applycoupon()">Applied</button>
        </form>
    </div>
    <div class="cart__total">
        <h6>Cart total</h6>
        <ul>
            <li>Subtotal <span id="subtotal"><?= $currencysymbol . number_format($subtotal, 2) ?></span></li>
            <input hidden class="coupondiscount" type="text" value="<?= $discountamt ?>">
            <input hidden class="coupontype" type="text" value="<?= $rowcoupon['type'] ?>">
            <input hidden class="couponpercent" type="text" value="<?= $rowcoupon['number'] ?>">
            <li>Discount <span class="discountamt"><?= $currencysymbol . number_format($discountamt, 2) ?></span></li>
            <li>Total <span id="finaltotal"><?= $currencysymbol . number_format($total, 2) ?></span></li>
        </ul>
        <a href="checkout" class="primary-btn">Proceed to checkout</a>
    </div>
<?php }
?>