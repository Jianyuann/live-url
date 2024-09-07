<?php
$id = $_GET['id'] ?? '4k';
$streams = [
    '4k' => '4K0219.stream/1.m3u8',
    '4k10m' => '4K10M.stream/1.m3u8',
    '16-4k' => 'CCTV16-4K.stream/1.m3u8',
    '8k' => '4K36M/playlist.m3u8',
    '8k60m' => '4K60M/4K60M.m3u8',
    '8k120m' => '8K120M/playlist.m3u8'
];
$baseUrl = 'http://liveten-tp4k.cctv.cn/live/' . $streams[$id];
$pathUrl = preg_replace("/(\w+\.m3u8)/i", "", $baseUrl);

$headers = [
    "User-Agent: cctv_app_tv",
    "Referer: api.cctv.cn",
    "UID: 1234123122"
];

$apiUrl = "https://ytpvdn.cctv.cn/cctvmobileinf/rest/cctv/videoliveUrl/getstream";
$payload = http_build_query([
    'appcommon' => json_encode([
        'ap' => 'cctv_app_tv',
        'an' => '央视投屏助手',
        'adid' => '1234123122',
        'av' => '1.1.7'
    ]),
    'url' => $baseUrl
]);
$playUrl = json_decode(file_get_contents($apiUrl, false, stream_context_create(['http' => ['header' => implode("\r\n", $headers), 'method' => 'POST', 'content' => $payload,]])))->url;

$liveUrl = preg_replace('/(.*?.ts)/i', "$pathUrl$1", file_get_contents($playUrl, false, stream_context_create(['http' => ['header' => implode("\r\n", $headers)]])));

header("Content-Type: application/vnd.apple.mpegurl");
header("Content-Disposition:attachment;filename=playlist.m3u8");
echo $liveUrl;
