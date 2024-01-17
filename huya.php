<?php
$rid = $_GET['id'];
date_default_timezone_set("Asia/Shanghai");
$apiUrl = "https://mp.huya.com/cache.php?m=Live&do=profileRoom&roomid=" . $rid;
$data = json_decode(file_get_contents($apiUrl), true);
$sStreamName = $data["data"]["stream"]["baseSteamInfoList"][0]["sStreamName"];
$sFlvAntiCode= $data["data"]["stream"]["baseSteamInfoList"][0]["sFlvAntiCode"];
header('location:'.'https://hs.flv.huya.com/src/'.$sStreamName.'.flv?'.$sFlvAntiCode);

//cdnType : al tx hw hs