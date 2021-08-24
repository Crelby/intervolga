<?php
/***
Задача:
На диске лежит файл image.png, размер 20000 на 20000.
Вывести картинку как баннер размером 200 на 100 пикселей.
***/

/* Возможный вариант решения: */

// используем бибилиотеку GD

$picname = __DIR__ . '/donut.png';
 
$picinfo   = getimagesize($picname);
$width  = $picinfo[0];
$height = $picinfo[1];
$pictype = $picinfo[2];

$img = imageCreateFromPng($picname); 
imageSaveAlpha($img, true);

// Размеры новой фотки.
$newwidth = 200;
$newheight = 100;

if (empty($newwidth)) {
	$newwidth = ceil($newheight / ($height / $width));
}
if (empty($newheight)) {
	$newheight = ceil($newwidth / ($width / $height));
}

$tmpimg = imageCreateTrueColor($newwidth, $newheight);

imagealphablending($tmpimg, true); 
imageSaveAlpha($tmpimg, true);
$transparent = imagecolorallocatealpha($tmpimg, 0, 0, 0, 127); 
imagefill($tmpimg, 0, 0, $transparent); 
imagecolortransparent($tmpimg, $transparent);   

$tmpwidth = ceil($newheight / ($height / $width));
$tmpheight = ceil($newwidth / ($width / $height));
if ($tmpwidth < $newwidth) {
	imageCopyResampled($tmpimg, $img, ceil(($newwidth - $tmpwidth) / 2), 0, 0, 0, $tmpwidth, $newheight, $width, $height);        
} else {
	imageCopyResampled($tmpimg, $img, 0, ceil(($newheight - $tmpheight) / 2), 0, 0, $newwidth, $tmpheight, $width, $height);    
}   

$img = $tmpimg;
$src =  __DIR__ . '/donut-200x100.png';

imagePng($img, $src);
 
imagedestroy($img);