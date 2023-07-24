<?php
session_start();
$path = $_SERVER['HTTP_HOST'] == 'localhost' ? 'arial.ttf' : '/home/hc020wtvnu2k/public_html/main/arial.ttf';
$code = rand(1000, 9999);

// Store the code in a session variable
$_SESSION['captcha_code'] = $code;

// Create the image
$image = imagecreatetruecolor(100, 30);
// $bg_color = imagecolorallocate($image, 0, 255, 0);
$text_color = imagecolorallocate($image, 5, 124, 124);
$col = imagecolorallocatealpha($image, 238, 255, 255, 127);
imagefill($image, 0, 0, $col);
// Add noise to the image
for ($i = 0; $i < 500; $i++) {
    imagesetpixel($image, rand(0, 100), rand(0, 30), $text_color);
}

// Distort the text
$font = $path;
imagettftext($image, 20, -5, 15, 25, $text_color, $font, $code);


// Output the image as a PNG
header('Content-Type: image/png');
imagepng($image);

// Clean up
imagedestroy($image);
