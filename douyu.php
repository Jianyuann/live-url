<?php
declare(strict_types=1);

$roomId = $_GET['id'] ?? '999';
$deviceId = '10000000000000000000000000001501';
$timestamp = (string)time();

$encUrl = 'https://www.douyu.com/wgapi/livenc/liveweb/websec/getEncryption?did=' . $deviceId;
$encData = json_decode(file_get_contents($encUrl), true)['data'] ?? [];

extract($encData); 

$isSpecial = (int)($is_special ?? 0);
$encTime   = (int)($enc_time ?? 0);

$i = ($isSpecial === 1) ? '' : $roomId . $timestamp;
$f = $rand_str;
for ($p = 0; $p < $encTime; $p++) {
    $f = md5($f . $key);
}
$auth = md5($f . $key . $i);

$postParams = http_build_query([
    'enc_data' => $enc_data,
    'tt'       => $timestamp,
    'did'      => $deviceId,
    'auth'     => $auth,
    'cdn'      => '',
    'rate'     => '0',
    'hevc'     => '0',
    'fa'       => '0',
    'ive'      => '0'
]);

$apiUrl = 'https://www.douyu.com/lapi/live/getH5PlayV1/' . $roomId;
$context = stream_context_create([
    'http' => [
        'method'  => 'POST',
        'content' => $postParams,
        'header'  => "Content-Type: application/x-www-form-urlencoded\r\n"
    ]
]);

$json = json_decode(file_get_contents($apiUrl, false, $context), true);
$data = $json['data'] ?? [];

$rtmpUrl = (string)($data['rtmp_url'] ?? '');
$rtmpLive = (string)($data['rtmp_live'] ?? '');
$streamUrl = rtrim($rtmpUrl, '/') . '/' . ltrim($rtmpLive, '/');

header('Location: ' . $streamUrl);
