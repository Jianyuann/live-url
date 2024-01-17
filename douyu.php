<?php
$id = $_GET['id'];
$apiUrl = 'https://wxapp.douyucdn.cn/Livenc/Getplayer/newRoomPlayer';

$data = file_get_contents($apiUrl, false, stream_context_create(array('http'=>array('method'=>'POST', 'content'=>http_build_query(array('room_id'=>$id, 'token'=>1))))));

$rawUrl = json_decode($data)->data->hls_url;
$playUrl = 'https://tc-tc2-interact.douyucdn2.cn/live/' . explode('_', basename($rawUrl))[0] . '.m3u8';
header('location:' . $playUrl);