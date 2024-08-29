<?php
$id = $_GET['id'];
$apiUrl = 'https://live.douyin.com/webcast/room/web/enter/?aid=6383&device_platform=web&browser_language=zh-CN&browser_platform=iPad&browser_name=Safari&browser_version=17.6&web_rid=' . $id;
$options = ['http' => ['method' => 'GET', 'header' => ['Cookie: ttwid=1%7CYqdH7G5MetcLz-SYn5w09SR81BSavm6lW81orliZUbA%7C1719753328%7Ccb83acfa23ce88b920c26fef1746820e6a701528adfe7c48847cfb5925eb1a0f']]];
$json = json_decode(file_get_contents($apiUrl, false, stream_context_create($options)), true);
$stream_data_json = $json['data']['data'][0]['stream_url']['live_core_sdk_data']['pull_data']['stream_data'];
$stream_data = json_decode($stream_data_json, true);
$hls_url = $stream_data['data']['origin']['main']['hls'];
//$flv_url = $stream_data['data']['origin']['main']['flv'];
header('location:' . $hls_url);
