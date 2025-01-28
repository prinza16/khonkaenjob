<?php
// สร้างภาพพื้นฐาน
$width = 200;
$height = 50;
$image = imagecreate($width, $height);

// กำหนดสีพื้นหลังและสีข้อความ
$bgColor = imagecolorallocate($image, 255, 255, 255); // สีขาว
$textColor = imagecolorallocate($image, 0, 0, 0); // สีดำ

// กำหนดข้อความที่ต้องการแสดง (อีเมล)
$text = "example@email.com";

// กำหนดฟอนต์และขนาด (ใช้ path แบบ relative)
$font = './font/Nunito/static/Nunito-Bold.ttf';  // ฟอนต์ที่ใช้
$fontSize = 12;

// หาตำแหน่งของข้อความให้แสดงในตำแหน่งที่เหมาะสม
$textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
$textWidth = $textBoundingBox[2] - $textBoundingBox[0];
$textHeight = $textBoundingBox[3] - $textBoundingBox[5];
$x = ($width - $textWidth) / 2;
$y = ($height + $textHeight) / 2;

// แสดงข้อความบนภาพ
imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);

// สร้าง output buffer เพื่อส่งออกเป็น Base64
ob_start();
imagepng($image);
$imageData = ob_get_contents();
ob_end_clean();

// แปลงข้อมูลเป็น Base64
$base64Image = base64_encode($imageData);

// ปิด resource ของภาพ
imagedestroy($image);
?>

<!-- แสดงภาพที่แปลงเป็น Base64 -->
<img src="data:image/png;base64,<?php echo $base64Image; ?>" alt="Email Image" />