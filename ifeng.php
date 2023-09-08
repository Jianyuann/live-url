<?php
$id = $_GET['id'] ?? '1';
$channelId = [
    '1' => '7c96b084-60e1-40a9-89c5-682b994fb680',  //资讯台
'2' => 'f7f48462-9b13-485b-8101-7b54716411ec',  //中文台
'3' => '15e02d92-1698-416c-af2f-3e9a872b4d78',  //深圳旁边台
];
$type = $_GET['qa'] ?? 'HD';
$authUrl = 'https://m.fengshows.com/api/v3/hub/live/auth-url?stream_type=hls&live_id=';

$headers = array(
    'Fengshows-Client: app(ios,5040873);iPhone14,5;16.6',
    'Cookie: acw_tc=0bc159c416601310655302310e60a16525c75b28a289968d7981e08cf77999',
    'User-Agent: FengWatch/5.4.8 (com.phoenixtv.videoapp; build:5040873; iOS 16.6.0) Alamofire/5.6.4'
);

$liveUrl = json_decode(get_data($authUrl . $channelId[$id] . '&live_qa=' . $type, $headers), true)['data']['live_url'];
$m3u8 = get_data($liveUrl, $headers);
$serverUrl = 'http://qctv.fengshows.cn/live/';
if ($type == 'audio') {
    $playUrl = preg_replace('/(\d{4}\w{3})(_audio-\d+\.ts)\?.*/', $serverUrl . '$1$2', $m3u8);
} else {
    $playUrl = preg_replace('/0701(\w{3})(\d{2})(-\d+\.ts)\?.*/', $serverUrl . '0701${1}72$3', $m3u8);
}
header('Content-Type: application/vnd.apple.mpegURL');
header('Content-Disposition: attachment; filename=playlist.m3u8');
echo $playUrl;

function get_data($url, $headers){
    $curl = curl_init();
    if (str_starts_with($url, 'https')) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}
