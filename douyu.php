<?php
declare(strict_types=1);

$roomId = $_GET['id'] ?? '999';
$deviceId = '10000000000000000000000000001501';
$timestamp = (string)time();

$encryptionUrl = 'https://www.douyu.com/wgapi/livenc/liveweb/websec/getEncryption?did=' . $deviceId;
$encryptionData = json_decode(file_get_contents($encryptionUrl), true);

if (!$encryptionData || ($encryptionData['error'] ?? 1) !== 0) {
    die('Failed to get encryption data');
}

$encData = $encryptionData['data'];
$key = $encData['key'];
$randStr = $encData['rand_str'];
$encTime = $encData['enc_time'];
$isSpecial = $encData['is_special'] ?? 0;
$encDataValue = $encData['enc_data'];

$i = ($isSpecial === 1) ? '' : $roomId . $timestamp;
$f = $randStr;
for ($p = 0; $p < $encTime; $p++) {
    $f = md5($f . $key);
}
$auth = md5($f . $key . $i);

$rate = '0';
$postParams = http_build_query([
    'enc_data' => $encDataValue,
    'tt' => $timestamp,
    'did' => $deviceId,
    'auth' => $auth,
    'cdn' => '',
    'rate' => $rate,
    'hevc' => '0',
    'fa' => '0',
    'ive' => '0'
]);

$apiUrl = 'https://www.douyu.com/lapi/live/getH5PlayV1/' . $roomId;

$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'content' => $postParams,
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
    ],
]);
$jsonData = json_decode(file_get_contents($apiUrl, false, $context), true);

$rtmpUrl = (string)($jsonData['data']['rtmp_url'] ?? '');
$rtmpLive = (string)($jsonData['data']['rtmp_live'] ?? '');

$streamUrl = rtrim($rtmpUrl, '/') . '/' . ltrim($rtmpLive, '/');

header('Location: ' . $streamUrl);
