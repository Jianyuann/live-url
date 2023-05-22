<?php

$id = $_GET['id'];
$rawUrl ='https://live.douyin.com/webcast/room/web/enter/?aid=6383&app_name=douyin_web&live_id=1&device_platform=web&language=zh-CN&cookie_enabled=true&screen_width=1280&screen_height=720&browser_language=zh-CN&browser_platform=Win32&browser_name=Firefox&browser_version=113.0&web_rid='.$id;

$headers = array(
    'Cookie:ttwid=1%7CSgKP1ROhC9lf8AU5VR_bGvYOFXI5tlLJet4y-z2wb3s%7C1658845728%7C9ad3516d2604d385964001c61ff48275b9dacf7b7789bb1f78ae9dedf354206e',
	'User-Agent:Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:105.0) Gecko/20100101 Firefox/105.0'
	);
	
	$data = curlClient($rawUrl, $headers);
	$json = json_decode($data, true);
	$hls_url = $json['data']['data'][0]['stream_url']['hls_pull_url_map']['FULL_HD1'];
	//$flv_url = $json['data']['data'][0]['stream_url']['flv_pull_url']['FULL_HD1'];
	header('location:'.$hls_url);
	
function curlClient($url, $headers)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    if (!empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
