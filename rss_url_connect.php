<?php
$rss_url = 'https://www.thaijob.com/rss/jooble.xml';

// เริ่มต้น cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $rss_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, ''); // รองรับการบีบอัด GZIP
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

// ดึงข้อมูล
$data = curl_exec($ch);

// ตรวจสอบข้อผิดพลาด
if (curl_errno($ch)) {
    echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

// ปิด cURL
curl_close($ch);

// ตรวจสอบว่าได้ข้อมูลมาหรือไม่
if (empty($data)) {
    echo 'ไม่มีข้อมูลจาก RSS Feed';
    exit;
}

// แปลง XML เป็น SimpleXML object
$rss = simplexml_load_string($data);

// ตรวจสอบการแปลง XML
if ($rss === false) {
    echo 'ไม่สามารถแปลงข้อมูล RSS ได้:';
    foreach (libxml_get_errors() as $error) {
        echo "<br>" . $error->message;
    }
    libxml_clear_errors();
    exit;
}
