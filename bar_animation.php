<?php

$white_spaces = 1;

if(!isset($argv[1])){
    $argv[1] = 'images';
}

$files = glob("{$argv[1]}/*");
sort($files);
$files_count = count($files);
list($width, $height) = getimagesize($files[0]);

// create bar image! (the simple step!)
$im = imagecreatetruecolor($width * 2, $height * 2);
$bg = imagecolorallocatealpha($im, 0,0,0, 0);
$white = imagecolorallocatealpha($im, 255,255,255, 127);
imagefill($im, 0, 0, $bg);
imagealphablending($im, false);

$bar_width = $white_spaces * $files_count;
for ($temp_x = $bar_width; $temp_x < $width * 2; $temp_x += $bar_width){
    imagefilledrectangle($im, $temp_x - $white_spaces, 0, $temp_x - 1, $height * 2, $white);
}

imagesavealpha($im, true);
imagepng($im, 'bar.png');
imagedestroy($im);

// create image of images! (the complex step!)
$im = imagecreatetruecolor($width, $height);
$bg = imagecolorallocatealpha($im, 255,255,255, 127);
imagefill($im, 0, 0, $bg);

$start_x = -$bar_width;
$black_bar_width = $bar_width - $white_spaces;

// loop in images
for($i = 0; $i < $files_count; $i++){
    
    $src = imagecreatefrompng($files[$i]);
    $white = imagecolorallocatealpha($src, 255,255,255, 127);
    imagealphablending($src, false);

    // loop for removable bars
    for($temp_x = $start_x; $temp_x < $width; $temp_x += $bar_width){
        imagefilledrectangle($src, $temp_x, 0, $temp_x + $black_bar_width - 1, $height, $white);
    }
    
    imagesavealpha($src, false);
    imagealphablending($src, false); 
    imagecopy($im, $src, 0, 0, 0, 0, $width, $height);
    
    $start_x += $white_spaces;
}

imagesavealpha($im, true);
imagepng($im, 'image.png');
