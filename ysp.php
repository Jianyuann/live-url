<?php
$id = $_GET['id'] ?? 'cctv1';
$cdn = $_GET['cdn'] ?? 'ws-tpgq';

$apiUrl = "https://ytpvdn.cctv.cn/cctvmobileinf/rest/cctv/videoliveUrl/getstream";
$headers = ["User-Agent: cctv_app_tv", "Referer: api.cctv.cn", "UID: 1234123122","Content-Type: application/x-www-form-urlencoded"];
$payload = http_build_query(['appcommon' => json_encode(['ap' => 'cctv_app_tv', 'an' => '央视投屏助手', 'adid' => '1234123122', 'av' => '1.1.7']), 'url' => 'http://live'.$cdn.'.cctv.cn/live/'.$id.'.m3u8']);

$playUrl = json_decode(file_get_contents($apiUrl, false, stream_context_create(['http' => ['header' => implode("\r\n", $headers), 'method' => 'POST', 'content' => $payload,]])))->url;
$liveUrl = preg_replace('/(.*?.ts)/i', 'http://live'.$cdn.'.cctv.cn/live/$1', file_get_contents($playUrl, false, stream_context_create(['http' => ['header' => implode("\r\n", $headers)]])));

header("Content-Type: application/vnd.apple.mpegurl");
header("Content-Disposition: attachment; filename=".$id.".m3u8");
echo $liveUrl;
