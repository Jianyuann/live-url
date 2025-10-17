<?php

$shortId = $_GET['id'] ?? '55';
$realIdResponse = file_get_contents("https://api.live.bilibili.com/room/v1/Room/get_info?room_id=$shortId");
$roomId = json_decode($realIdResponse, true) ['data']['room_id'] ?? '';
$playResponse = file_get_contents("https://api.live.bilibili.com/room/v1/Room/playUrl?quality=4&cid=$roomId");
$playUrl = json_decode($playResponse, true) ['data']['durl'][0]['url'] ?? '';
header('Location: ' . $playUrl);

/*<?php
$id = $_GET['id'] ?? '55';
//access_key需抓包获取，否则获取不到原画质
$apiUrl = 'https://api.live.bilibili.com/xlive/app-room/v2/index/getRoomPlayInfo?access_key=0&appkey=27eb53fc9058f8c3&build=77500100&codec=0&device=phone&device_name=iPhone%20130&dolby=5&format=1&need_hdr=1&platform=ios&protocol=1&qn=10000&room_id='.$id;
$codec = json_decode(file_get_contents($apiUrl), true)['data']['playurl_info']['playurl']['stream'][0]['format'][0]['codec'][0];
$playUrl = $codec['url_info'][0]['host'].$codec['base_url'].$codec['url_info'][0]['extra'];
header('location:' . $playUrl);
*/
