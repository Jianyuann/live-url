<?php
$id = $_GET['id'] ?? '23';
$apiUrl = 
'https://api.live.bilibili.com/xlive/web-room/v2/index/getRoomPlayInfo?protocol=1&format=1&codec=0&room_id='.$id;
$codec = json_decode(file_get_contents($apiUrl), true)['data']['playurl_info']['playurl']['stream'][0]['format'][0]['codec'][0];
$playUrl = $codec['url_info'][0]['host'] . preg_replace('/_([a-zA-Z0-9]+)\.m3u8/', '.m3u8', $codec['base_url']). $codec['url_info'][0]['extra'];
header('location:' . $playUrl);