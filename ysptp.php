<?php
$id = $_GET['id'] ?? '8k120m';

if (str_contains($id, '8k')) {
    $baseUrl = 'http://livews-tp4k.cctv.cn/live/' . ($id === '8k120m' ? '8K120M/playlist.m3u8' : '4K36M/playlist.m3u8');
} else {
    $baseUrl = 'http://livews-tpgq.cctv.cn/live/' . $id . '.m3u8';
}

$apiUrl = "https://ytpvdn.cctv.cn/cctvmobileinf/rest/cctv/videoliveUrl/getstream";
$headers = ["User-Agent: cctv_app_tv", "Referer: api.cctv.cn", "UID: 1234123122", "Content-Type: application/x-www-form-urlencoded"];
$payload = http_build_query(['appcommon' => json_encode(['ap' => 'cctv_app_tv', 'an' => '央视投屏助手', 'adid' => '1234123122', 'av' => '1.1.7']), 'url' => $baseUrl]);

$playUrl = json_decode(file_get_contents($apiUrl, false, stream_context_create(['http' => ['header' => implode("\r\n", $headers), 'method' => 'POST', 'content' => $payload,]])))->url;
$liveUrl = preg_replace('/(.*?.ts)/i', str_replace('playlist.m3u8', '', $baseUrl) . '$1', file_get_contents($playUrl, false, stream_context_create(['http' => ['header' => implode("\r\n", $headers)]])));

if (!str_contains($id, '8k')) {
    $liveUrl = str_replace($id . '.m3u8', '', $liveUrl);
}

header("Content-Type: application/vnd.apple.mpegurl");
header("Content-Disposition: attachment; filename=" . $id . ".m3u8");
echo $liveUrl;
