<?php
date_default_timezone_set("Asia/Shanghai");
$rid = $_GET['id'] ?? '';
$cdn = $_GET['cdn'] ?? 'tx'; // 默认 tx，可选 al/hs/hw
$uid = '1560173900';

$apiUrl = "https://mp.huya.com/cache.php?m=Live&do=profileRoom&roomid=$rid";
$info = json_decode(file_get_contents($apiUrl), true)["data"]["stream"]["baseSteamInfoList"][0];
$streamName = $info["sStreamName"];
parse_str($info["sFlvAntiCode"], $p);

$ctype = 'tars_wap'; $fs = $p['fs']; $ver = 1; $t = 102;
$wsTime = dechex(time() + 3600);
$seqid = (int)(microtime(true) * 1000);
$hash = md5("$seqid|$ctype|$t");
$wsSecret = md5("{$uid}_{$streamName}_{$hash}_$wsTime");

$playUrl = "http://$cdn.flv.huya.com/src/$streamName.flv?" . http_build_query([
        'wsSecret'=>$wsSecret,'wsTime'=>$wsTime,'ctype'=>$ctype,'seqid'=>$seqid,
        'uid'=>$uid,'fs'=>$fs,'ver'=>$ver,'t'=>$t
    ]);
header("Location: $playUrl");
