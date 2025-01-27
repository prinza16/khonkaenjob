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

function getCompanyLogo($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $logo_elements = $xpath->query('//section[@class="logo-wrapper"]//img[@data-cfsrc]');

    if ($logo_elements->length > 0) {
        return $logo_elements->item(0)->getAttribute('data-cfsrc');
    } else {
        $noscript_elements = $xpath->query('//section[@class="logo-wrapper"]//noscript//img');
        if ($noscript_elements->length > 0) {
            return $noscript_elements->item(0)->getAttribute('src');
        }
    }

    return null;
}

function getContactDetails($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $list_elements = $xpath->query('//ul[@class="list-unstyled sec-list"]/li');

    $contact_details = [];
    foreach ($list_elements as $element) {
        $contact_details[] = trim($element->nodeValue);
    }

    return $contact_details;
}

function getBusinessType($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    $business_elements = $xpath->query('//p[contains(text(), "ประเภทธุรกิจ:")]//a');

    $business_data = [];

    if ($business_elements->length > 0) {
        foreach ($business_elements as $element) {
            $business_data[] = [
                'name' => trim($element->nodeValue)
            ];
        }
    }

    return $business_data;
}

function getAboutcompany($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    $aboutcompany_elements = $xpath->query('//p[contains(@class, "about-company")]');

    $aboutcompany_data = [];

    if ($aboutcompany_elements->length > 0) {
        foreach ($aboutcompany_elements as $element) {
            $aboutcompany_data[] = [
                'name' => trim($element->nodeValue)
            ];
        }
    }

    return $aboutcompany_data;
}

function getJobDetails($url)
{
    // เริ่มต้น cURL เพื่อดึงข้อมูลจาก URL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }
    curl_close($ch);

    // แปลง HTML เป็น DOM
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    // ใช้ XPath เพื่อดึงข้อมูลที่ต้องการ
    $xpath = new DOMXPath($dom);

    // ดึงข้อมูลตำแหน่งงาน, อัตราที่รับ, รูปแบบงาน ฯลฯ
    $job_title = '';
    $vacancy_count = '';
    $job_type = '';
    $job_category = '';
    $job_location = '';
    $salary = '';

    // ดึงข้อมูลตำแหน่งงาน
    $job_title_element = $xpath->query('//li[span[contains(text(), "ตำแหน่งงาน")]]');
    if ($job_title_element->length > 0) {
        $job_title = trim(str_replace('ตำแหน่งงาน : ', '', $job_title_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลอัตราที่รับ
    $vacancy_count_element = $xpath->query('//li[span[contains(text(), "อัตราที่รับ")]]');
    if ($vacancy_count_element->length > 0) {
        $vacancy_count = trim(str_replace('อัตราที่รับ : ', '', $vacancy_count_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลรูปแบบงาน
    $job_type_element = $xpath->query('//li[span[contains(text(), "รูปแบบงาน")]]');
    if ($job_type_element->length > 0) {
        $job_type = trim(str_replace('รูปแบบงาน : ', '', $job_type_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลประเภทงาน
    $job_category_element = $xpath->query('//li[span[contains(text(), "ประเภทงาน")]]');
    if ($job_category_element->length > 0) {
        $job_category = trim(str_replace('ประเภทงาน : ', '', $job_category_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลสถานที่ปฏิบัติงาน
    $job_location_element = $xpath->query('//li[span[contains(text(), "สถานที่ปฏิบัติงาน")]]');
    if ($job_location_element->length > 0) {
        $job_location = trim(str_replace('สถานที่ปฏิบัติงาน : ', '', $job_location_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลเงินเดือน
    $salary_element = $xpath->query('//li[span[contains(text(), "เงินเดือน(บาท)")]]');
    if ($salary_element->length > 0) {
        $salary = trim(str_replace('เงินเดือน(บาท) : ', '', $salary_element->item(0)->nodeValue));
    }

    // จัดเก็บข้อมูลทั้งหมดใน array
    $job_details = [
        'job_title' => $job_title,
        'vacancy_count' => $vacancy_count,
        'job_type' => $job_type,
        'job_category' => $job_category,
        'job_location' => $job_location,
        'salary' => $salary
    ];

    return $job_details;
}

function getLiTextFromSecList($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดขึ้นผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    $li_elements = $xpath->query('//div[@class="col-sm-6"]//ul[contains(@class, "sec-list")]//li');

    $li_texts = [];
    foreach ($li_elements as $li) {
        $li_texts[] = trim($li->nodeValue);
    }

    return $li_texts;
}

function getBenefits($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $html = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดขึ้นผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    // แก้ไข XPath
    $li_elements = $xpath->query('//div[@class="col-sm-6 xs-mt30"]//div[@class="content"]');

    $li_texts = [];
    foreach ($li_elements as $li) {
        $li_texts[] = trim($li->nodeValue);
    }

    return $li_texts;
}