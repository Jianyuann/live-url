<?php

declare(strict_types=1);

$roomId = $_GET['id'] ?? '';
$cdn = $_GET['cdn'] ?? 'tx'; // tx, al, hs, hw

$apiUrl = "https://mp.huya.com/cache.php?m=Live&do=profileRoom&roomid=$roomId";
$infoData = json_decode(file_get_contents($apiUrl), true);
$streamInfo = $infoData['data']['stream']['baseSteamInfoList'][0];
$streamName = $streamInfo['sStreamName'];

parse_str($streamInfo['sFlvAntiCode'] ?? '', $antiCodeParams);

$userId = '1560173900';
$contentType = 'tars_wap';
$type = 102;
$wsTime = dechex(time() + 3600);
$seqId = (string) (int) (microtime(true) * 1000);
$hash = md5("$seqId|$contentType|$type");
$fmEncoded = $antiCodeParams['fm'] ?? '';
$fmDecoded = base64_decode(urldecode($fmEncoded));
$fmReplaced = str_replace('$0', $userId, $fmDecoded);
$fmReplaced = str_replace('$1', $streamName, $fmReplaced);
$fmReplaced = str_replace('$2', $hash, $fmReplaced);
$fmReplaced = str_replace('$3', $wsTime, $fmReplaced);
$wsSecret = md5($fmReplaced);
$queryParams = [
    'wsSecret' => $wsSecret,
    'wsTime' => $wsTime,
    'ctype' => $contentType,
    'seqid' => $seqId,
    'uid' => $userId,
    'fs' => $antiCodeParams['fs'] ?? '',
    'ver' => 1,
    't' => $type,
];

$playUrl = "https://$cdn.flv.huya.com/src/$streamName.flv?" . http_build_query($queryParams);
header("Location: $playUrl");
