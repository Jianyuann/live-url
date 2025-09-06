<?php

$type = $_GET['type'] ?? 'LIVECAST';
$id = $_GET['id'] ?? '0';
$apiUrl = "https://api.vtibet.cn/xizangmobileinf/rest/xz/cardgroups";
$data = file_get_contents($apiUrl, false, stream_context_create(['http' => ['method' => 'POST', 'content' => http_build_query(['json' => '{"cardgroups" :"' . $type . '"}'])]]));

$playUrl = json_decode($data)->cardgroups[1]->cards[$id]->video->url;
header('Location: ' . $playUrl);

/*
//电视频道：
西藏卫视：http://server/vtibet.php?id=0
藏语卫视：http://server/vtibet.php?id=1
影视文化：http://server/vtibet.php?id=2

//广播频道：
藏语广播：http://server/vtibet.php?id=0&type=BROADCAST
汉语广播：http://server/vtibet.php?id=1&type=BROADCAST
康巴语广播：http://server/vtibet.php?id=2&type=BROADCAST
都市生活广播：http://server/vtibet.php?id=3&type=BROADCAST
藏语科教广播：http://server/vtibet.php?id=4&type=BROADCAST
*/
