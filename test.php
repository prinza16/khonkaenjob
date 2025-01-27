<?php
// สร้างภาพพื้นฐาน
$width = 300;
$height = 100;
$image = imagecreate($width, $height);

// กำหนดสีพื้นหลังและสีข้อความ
$bgColor = imagecolorallocate($image, 255, 255, 255); // สีขาว
$textColor = imagecolorallocate($image, 0, 0, 0); // สีดำ

// กำหนดข้อความที่ต้องการแสดง
$text = "Hello World!";

// กำหนดฟอนต์และขนาด
$font = 'font/Nunito/static/Nunito-Bold.ttf';  // กำหนด path ไปยังฟอนต์ที่ใช้
$fontSize = 20;

// หาตำแหน่งของข้อความให้แสดงในตำแหน่งที่เหมาะสม
$textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
$textWidth = $textBoundingBox[2] - $textBoundingBox[0];
$textHeight = $textBoundingBox[3] - $textBoundingBox[5];
$x = ($width - $textWidth) / 2;
$y = ($height + $textHeight) / 2;

// แสดงข้อความบนภาพ
imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);

// ตั้งชื่อไฟล์ภาพ
$filePath = 'images/text_image.png';  // ตั้งชื่อไฟล์และโฟลเดอร์ที่ต้องการบันทึก

// บันทึกภาพลงในโฟลเดอร์
imagepng($image, $filePath);

// ทำลายภาพหลังใช้งานเสร็จ
imagedestroy($image);

echo "ภาพถูกบันทึกที่: $filePath";
?>