<?php
$id = $_GET['id'] ?? '55';
//access_key需抓包获取，否则获取不到原画质
$apiUrl = 'https://api.live.bilibili.com/xlive/app-room/v2/index/getRoomPlayInfo?access_key=0&appkey=27eb53fc9058f8c3&build=77500100&codec=0&device=phone&device_name=iPhone%20130&dolby=5&format=1&need_hdr=1&platform=ios&protocol=1&qn=10000&room_id='.$id;
$codec = json_decode(file_get_contents($apiUrl), true)['data']['playurl_info']['playurl']['stream'][0]['format'][0]['codec'][0];
$playUrl = $codec['url_info'][0]['host'].$codec['base_url'].$codec['url_info'][0]['extra'];
header('location:' . $playUrl);
