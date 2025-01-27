<?php
set_time_limit(300);
$rss_url = 'https://www.thaijob.com/rss/jooble.xml';

// ฟังก์ชันสำหรับดึงข้อมูล HTML จาก URL
function fetchUrlContent($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_ENCODING, '');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    $data = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'เกิดข้อผิดพลาด cURL: ' . curl_error($ch);
        curl_close($ch);
        return null;
    }

    curl_close($ch);
    
    return $data;
}

// ฟังก์ชันดึง RSS Feed
$data = fetchUrlContent($rss_url);

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

// ฟังก์ชันดึงข้อมูลโลโก้
function getCompanyLogo($url) {
    $html = fetchUrlContent($url);
    if (!$html) return null;

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

// ฟังก์ชันดึงข้อมูลติดต่อ
function getContactDetails($url) {
    $html = fetchUrlContent($url);
    if (!$html) return null;

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

// ฟังก์ชันดึงประเภทธุรกิจ
function getBusinessType($url) {
    $html = fetchUrlContent($url);
    if (!$html) return null;

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $business_elements = $xpath->query('//p[contains(text(), "ประเภทธุรกิจ:")]//a');

    $business_data = [];
    if ($business_elements->length > 0) {
        foreach ($business_elements as $element) {
            $business_data[] = ['name' => trim($element->nodeValue)];
        }
    }

    return $business_data;
}

// ฟังก์ชันดึงข้อมูลเกี่ยวกับบริษัท
function getAboutCompany($url) {
    $html = fetchUrlContent($url);
    if (!$html) return null;

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $aboutcompany_elements = $xpath->query('//p[contains(@class, "about-company")]');

    $aboutcompany_data = [];
    if ($aboutcompany_elements->length > 0) {
        foreach ($aboutcompany_elements as $element) {
            $aboutcompany_data[] = ['name' => trim($element->nodeValue)];
        }
    }

    return $aboutcompany_data;
}

// ฟังก์ชันดึงรายละเอียดงาน
function getJobDetails($url) {
    $html = fetchUrlContent($url);
    if (!$html) return null;

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);

    $job_details = [
        'job_title' => '',
        'vacancy_count' => '',
        'job_type' => '',
        'job_category' => '',
        'job_location' => '',
        'salary' => ''
    ];

    // ดึงข้อมูลตำแหน่งงาน
    $job_title_element = $xpath->query('//li[span[contains(text(), "ตำแหน่งงาน")]]');
    if ($job_title_element->length > 0) {
        $job_details['job_title'] = trim(str_replace('ตำแหน่งงาน : ', '', $job_title_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลอัตราที่รับ
    $vacancy_count_element = $xpath->query('//li[span[contains(text(), "อัตราที่รับ")]]');
    if ($vacancy_count_element->length > 0) {
        $job_details['vacancy_count'] = trim(str_replace('อัตราที่รับ : ', '', $vacancy_count_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลรูปแบบงาน
    $job_type_element = $xpath->query('//li[span[contains(text(), "รูปแบบงาน")]]');
    if ($job_type_element->length > 0) {
        $job_details['job_type'] = trim(str_replace('รูปแบบงาน : ', '', $job_type_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลประเภทงาน
    $job_category_element = $xpath->query('//li[span[contains(text(), "ประเภทงาน")]]');
    if ($job_category_element->length > 0) {
        $job_details['job_category'] = trim(str_replace('ประเภทงาน : ', '', $job_category_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลสถานที่ปฏิบัติงาน
    $job_location_element = $xpath->query('//li[span[contains(text(), "สถานที่ปฏิบัติงาน")]]');
    if ($job_location_element->length > 0) {
        $job_details['job_location'] = trim(str_replace('สถานที่ปฏิบัติงาน : ', '', $job_location_element->item(0)->nodeValue));
    }

    // ดึงข้อมูลเงินเดือน
    $salary_element = $xpath->query('//li[span[contains(text(), "เงินเดือน(บาท)")]]');
    if ($salary_element->length > 0) {
        $job_details['salary'] = trim(str_replace('เงินเดือน(บาท) : ', '', $salary_element->item(0)->nodeValue));
    }

    return $job_details;
}

// ฟังก์ชันดึงข้อมูลจากรายการ ul.sec-list
function getLiTextFromSecList($url) {
    $html = fetchUrlContent($url);
    if (!$html) return null;

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

// ฟังก์ชันดึงข้อมูลสวัสดิการ
function getBenefits($url) {
    $html = fetchUrlContent($url);
    if (!$html) return null;

    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML($html);
    libxml_clear_errors();

    $xpath = new DOMXPath($dom);
    $li_elements = $xpath->query('//div[@class="col-sm-6 xs-mt30"]//div[@class="content"]');

    $li_texts = [];
    foreach ($li_elements as $li) {
        $li_texts[] = trim($li->nodeValue);
    }

    return $li_texts;
}
?>
