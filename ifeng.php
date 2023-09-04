<?php
date_default_timezone_set("Asia/Shanghai");
$id = $_GET['id'] ?? '1';
$channelId = array(
    '1'=>'0701pin72',
    '2'=>'0701pcc72',
    '3'=>'0701phk72',
    '4'=>'0701pin_audio',
    '5'=>'0701pcc_audio',
    '6'=>'0701phk_audio',
);

if (str_contains($id, '4')) {
    $seq = intval(time() / 3.029 + 1134263867);
} else if (str_contains($id, '5')) {
    $seq = intval(time() / 3.026 + 1130361490);
} else if (str_contains($id, '6')) {
    $seq = intval(time() / 3.008 + 1130361113);
} else {
    $seq = intval(time() / 4.000 + 1269967457);
}

$content = "#EXTM3U\n#EXT-X-VERSION:3\n#EXT-X-TARGETDURATION:4\n#EXT-X-MEDIA-SEQUENCE:$seq\n";
for($i=0;$i<3;$i++){
    $content .= "#EXTINF:4.000,\n";
    $content .= "http://qctv.fengshows.cn/live/".$channelId[$id]."-". $seq+$i .".ts\n";
}
header("Content-Type: application/vnd.apple.mpegurl");
header("Content-Disposition: attachment; filename=playlist.m3u8");
echo $content;
