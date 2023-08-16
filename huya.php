<?php
    $rid=$_GET['id'];
    $apiUrl = "https://mp.huya.com/cache.php?m=Live&do=profileRoom&roomid=" . $rid;
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);
    $multiLine = $data["data"]["stream"]["flv"]["multiLine"];
    $playUrl = str_replace("http", "https", $multiLine[0]["url"]);
    header( 'location:' . $playUrl );
