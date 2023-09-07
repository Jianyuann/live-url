<?php
$id = $_GET['id'] ?? '23';

$apiUrl = 'https://api.live.bilibili.com/xlive/web-room/v2/index/getRoomPlayInfo?protocol=1&format=1&codec=0&qn=30000&platform=web&room_id=' . $id;

$json = json_decode(get_data($apiUrl), true);
$codec = $json['data']['playurl_info']['playurl']['stream'][0]['format'][0]['codec'][0];
$playUrl = $codec['url_info'][0]['host'] . $codec['base_url'] . $codec['url_info'][0]['extra'];

header('location:' . $playUrl);
function get_data($url): bool|string
{
    $curl = curl_init();
    if (str_starts_with($url, 'https')) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
