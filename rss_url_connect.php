<?php
$rss_url = 'https://www.thaijob.com/rss/jooble.xml';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $rss_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

$data = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
    curl_close($ch);
    exit;
}

curl_close($ch);

if (empty($data)) {
    echo 'ไม่มีข้อมูลจาก RSS Feed';
    exit;
}

$rss = simplexml_load_string($data);

if ($rss === false) {
    echo 'ไม่สามารถแปลงข้อมูล RSS ได้:';
    foreach (libxml_get_errors() as $error) {
        echo "<br>" . $error->message;
    }
    libxml_clear_errors();
    exit;
}
