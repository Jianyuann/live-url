<?php

$webcastId = $_GET['id'] ?? '339638082961';

$roomUrl = "https://live.douyin.com/$webcastId";

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 18_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7 Mobile/15E148 Safari/604.1\r\n",
        'follow_location' => 0,
    ],
]);

file_get_contents($roomUrl, false, $context);

$headers = $http_response_header ?? [];

$redirectUrl = '';
foreach ($headers as $header) {
    if (stripos($header, 'Location:') === 0) {
        $redirectUrl = trim(substr($header, strlen('Location:')));
        break;
    }
}

$redirectUrl !== '' or exit;
$urlParts = parse_url($redirectUrl);
$pathParts = explode('/', trim($urlParts['path'], '/'));
$roomId = end($pathParts);
parse_str($urlParts['query'] ?? '', $queryParams);
$secUserId = $queryParams['sec_user_id'] ?? '';

$apiUrl = "https://webcast.amemv.com/webcast/room/reflow/info/?type_id=0&live_id=1&room_id=$roomId&sec_user_id=$secUserId&app_id=1128";

$stream_data_json = json_decode(file_get_contents($apiUrl, false, $context), true)['data']['room']['stream_url']['live_core_sdk_data']['pull_data']['stream_data'];
$stream_data = json_decode($stream_data_json, true);
$hls_url = $stream_data['data']['origin']['main']['hls'];
$flv_url = $stream_data['data']['origin']['main']['flv'];
header('location:' . $flv_url);

/*
<?php
$id = $_GET['id'];
$apiUrl = 'https://live.douyin.com/webcast/room/web/enter/?aid=6383&a_bogus=1&device_platform=web&browser_language=zh-CN&browser_platform=iPad&browser_name=Safari&browser_version=17.6&web_rid=' . $id;
$options = ['http' => ['method' => 'GET', 'header' => ['Cookie: ttwid=1%7CYqdH7G5MetcLz-SYn5w09SR81BSavm6lW81orliZUbA%7C1719753328%7Ccb83acfa23ce88b920c26fef1746820e6a701528adfe7c48847cfb5925eb1a0f']]];
$json = json_decode(file_get_contents($apiUrl, false, stream_context_create($options)), true);
$stream_data_json = $json['data']['data'][0]['stream_url']['live_core_sdk_data']['pull_data']['stream_data'];
$stream_data = json_decode($stream_data_json, true);
$hls_url = $stream_data['data']['origin']['main']['hls'];
//$flv_url = $stream_data['data']['origin']['main']['flv'];
header('location:' . $hls_url);
*/
