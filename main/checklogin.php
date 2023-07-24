<?php
session_start();
$captcha_code = $_SESSION['captcha_code'];
if ($captcha_code !== (int)$_POST['captcha']) {
    echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative' role='alert'>Invalid Captcha</div>";
    die;
}
ob_start();
include 'function.php';
include 'conn.php';

$email = $_POST['email'];
$pwd = $_POST['password'];
$table = "users";
$condition = " (`email` = '" . $email . "' ) and type = 2 and status != 99";
$result = $obj->selectextrawhereupdate($table, "*", $condition);
$num = $obj->total_rows($result);
if ($num) {
    $row = $obj->fetch_assoc($result);

    $result12 = $obj->fixedselect($table, "id", $row['id']);
    $num12 = $obj->total_rows($result12);
    if ($num12) {
        $row12 = $obj->fetch_assoc($result12);

        $pwd1 = $row12['password'];
        if ($pwd == $pwd1) {
            if ($row['status'] == 99) {
                echo "Error : Can't Login! Your account no longer exists.";
            } elseif ($row['activate'] === 'No') {
                echo "Error : Your account has been de-activated for some reason, please contact our support team.";
            } elseif ($row['status'] == 0) {
                echo "Error : Can't Login! Your Account Has Not Yet Approved.";
            } else {
                $data = array();

                $_SESSION['username'] = $row['name'];
                $_SESSION['userid'] = $row['id'];
                $_SESSION['useremail'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['type'] = $row['type'];
                $_SESSION['name'] = $row['name'];

                $log['ipaddress'] = $_SERVER['REMOTE_ADDR'];
                $log['username'] = $_SESSION['name'];
                $log['userid'] = $_SESSION['userid'];
                $log['datetime'] = date('Y-m-d H:i:s');
                $log['status'] = 1;
                $userData = array(
                    'username' => $row['name'],
                    'useremail' => $row['email'],
                    'userid' => $row['id'],
                    'role' => $row['role'],
                    'type' => $row['type'],
                    'name' => $row['name'],
                );

                $cookieData = json_encode($userData);
                setcookie('userData', $cookieData, time() + (86400 * 30), '/');
                $obj->insertnew('loginlog', $log);
                if ($email === 'mohammedmaheswer12@gmail.com') {
                    echo "Redirect : Logged in SuccessfullyURLhttps://dev-openapi.5paisa.com/WebVendorLogin/VLogin/Index?VendorKey=GN26BJxQ3LnyNJ5vCi8cJobynsIdMgSp&ResponseURL=$redirecturl/dashboard";
                } else {
                    echo "Redirect : Logged in SuccessfullyURLdashboard";
                }
            }
        } else {
            echo "Error : Password is incorrect.";
        }
    } else {


        echo "Error : Not Allow To login .";
    }
} else {
    echo "Error : Invalid Email and Password";
}
