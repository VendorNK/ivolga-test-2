<?php

ini_set('memory_limit', '3000M');
set_time_limit(60);

// Изменение размера изображний PNG
function resizePng($source_image, $dest_image, $dst_width, $dst_height)
{
    $image = imagecreatefrompng($source_image);

    list($width, $height) = getimagesize($source_image);
    $new_img = imagecreatetruecolor($dst_width, $dst_height);

    imagealphablending($new_img, false);
    imagesavealpha($new_img, true);
    $transparent = imagecolorallocatealpha($new_img, 255, 255, 255, 127);
    imagefilledrectangle($new_img, 0, 0, $width, $height, $transparent);
    imagecopyresampled($new_img, $image, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);

    imagepng($new_img, $dest_image);
    imagedestroy($new_img);
}

$image = dirname(__FILE__) . '/image.png';
$image_resize = dirname(__FILE__) . '/image-resize.png';

if(!file_exists($image_resize)) resizePng($image, $image_resize, "200", "100");

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2. Веб-разработка</title>
    <style>
        body {
            background-color: #cecece;;
        }
        img {
            display: block;
            margin: 100px auto;
        }
    </style>
</head>
<body>
    <img src="image-resize.png" alt="">
</body>
</html>