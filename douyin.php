<?php

declare(strict_types=1);

$webcastId = $_GET['id'] ?? '339638082961';

$userAgent = 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_7_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.7 Mobile/15E148 Safari/604.1';

$roomUrl = "https://live.douyin.com/$webcastId";

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => "User-Agent: $userAgent\r\n",
        'follow_location' => 0,
    ],
]);

file_get_contents($roomUrl, false, $context);

$headers = $http_response_header ?? [];

$redirectUrl = trim(substr($header, strlen('Location:')));

$urlParts = parse_url($redirectUrl);
$pathParts = explode('/', trim($urlParts['path'], '/'));
$roomId = end($pathParts);
parse_str($urlParts['query'] ?? '', $queryParams);
$secUserId = $queryParams['sec_user_id'] ?? '';

$apiUrl = "https://webcast.amemv.com/webcast/room/reflow/info/?type_id=0&live_id=1&room_id=$roomId&sec_user_id=$secUserId&app_id=1128";

$context = stream_context_create([
    'http' => [
        'header' => "User-Agent: userAgent\r\n",
    ],
]);

$responseBody = file_get_contents($apiUrl, false, $context);

$jsonData = json_decode($responseBody, true);

$roomData = $jsonData['data']['room'];

$streamDataJson = $roomData['stream_url']['live_core_sdk_data']['pull_data']['stream_data'];

$streamData = json_decode($streamDataJson, true);

$mainStream = $streamData['data']['origin']['main'] ?? [];

$flvUrlMap = $roomData['stream_url']['flv_pull_url_map'] ?? [];
$firstKey = array_key_first($flvUrlMap) ?? null;

$flvUrl = $mainStream['flv'] ?? ($flvUrlMap[$firstKey] ?? '');

header('Location: ' . $flvUrl);

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
