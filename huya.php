<?php
declare(strict_types=1);

$roomId = $_GET['id'] ?? '';
$cdn = $_GET['cdn'] ?? 'tx';        // 可选: tx, al, hs, hw
$format = $_GET['format'] ?? 'flv'; // 可选: flv 或 hls

$info = json_decode(file_get_contents("https://mp.huya.com/cache.php?m=Live&do=profileRoom&roomid=$roomId"), true);
$stream = $info['data']['stream']['baseSteamInfoList'][0];
$streamName = $stream['sStreamName'];

parse_str($stream['sFlvAntiCode'] ?? '', $anti);

$uid = '1560173900';
$type = 102;
$ctype = 'tars_wap';
$wsTime = dechex(time() + 3600);
$seqId = (string)(int)(microtime(true) * 1000);
$hash = md5("$seqId|$ctype|$type");
$fm = base64_decode(urldecode($anti['fm'] ?? ''));
$wsSecret = md5(strtr($fm, ['$0' => $uid, '$1' => $streamName, '$2' => $hash, '$3' => $wsTime]));

$ext = $format === 'hls' ? 'm3u8' : 'flv';
$domain = $format === 'hls' ? 'hls' : 'flv';
$playUrl = "https://$cdn.$domain.huya.com/src/$streamName.$ext?" . http_build_query([
    'wsSecret' => $wsSecret,
    'wsTime'   => $wsTime,
    'ctype'    => $ctype,
    'seqid'    => $seqId,
    'uid'      => $uid,
    'fs'       => $anti['fs'] ?? '',
    'ver'      => 1,
    't'        => $type,
]);

header("Location: $playUrl");


//huya.php?id=xxx
//huya.php?id=xxx&cdn=hw
//huya.php?id=xxx&cdn=al&format=hls
