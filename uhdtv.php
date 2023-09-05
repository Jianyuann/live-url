<?php

$id = $_GET['id'] ?? '8kh';
$idUrl = array(
    '4k' => 'http://livews-tp4k.cctv.cn/live/4K0219.stream/',
	'8kh' => 'http://livews-tp4k.cctv.cn/live/4K36M/',
    '8k' => 'http://liveten-tp4k.cctv.cn/live/4K36M/'
);
function mk_dir($newDir)
{
    $dir = $newDir;
    if (!is_dir('./' . $dir)) {
        mkdir('./' . $dir, 0777, true);
    }
    return $dir;
}

mk_dir('./cache/');
$cache = new Cache(3600, "cache/");
$playUrl = $cache->get('cctv_' . $id . '_cache');
$headers = [
    "User-Agent: cctv_app_tv",
    "Referer: api.cctv.cn",
    "UID: 1234123122"
];

if (!$playUrl) {
    $apiUrl = "https://ytpvdn.cctv.cn/cctvmobileinf/rest/cctv/videoliveUrl/getstream";
    $payload = http_build_query([
        'appcommon' => json_encode([
            'ap' => 'cctv_app_tv',
            'an' => '央视投屏助手',
            'adid' => '1234123122',
            'av' => '1.1.7'
        ]),
		'url' => $idUrl[$id] . 'playlist.m3u8'
    ]);
    $playUrl = json_decode(get_data($apiUrl, $headers, $payload))->url;
    if (str_contains($id, '4k')) {
        $playUrl = str_replace("playlist.m3u8", "1.m3u8", $playUrl);
    }
    $cache->put('cctv_' . $id . '_cache', $playUrl);
}

$liveUrl = preg_replace('/(.*?.ts)/i', "$idUrl[$id]$1", get_data($playUrl, $headers, null));
header("Content-Type: application/vnd.apple.mpegurl");
header("Content-Disposition:attachment;filename=playlist.m3u8");
echo $liveUrl;

function get_data($url, $headers, $payload): bool|string
{
    $curl = curl_init();
    if (str_starts_with($url, 'https')) {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    }
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_URL, $url);
    if (!empty($payload)) {
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    }
    if (!empty($headers)) {
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec($curl);
    curl_close($curl);
    return $data;
}

class Cache
{
    private mixed $cache_path;
    private mixed $cache_expire;

    public function __construct($exp_time = 3600, $path = "cache/")
    {
        $this->cache_expire = $exp_time;
        $this->cache_path = $path;
    }

    private function fileName($key): string
    {
        return $this->cache_path . md5($key);
    }

    public function put($key, $data): false|int
    {
        return file_put_contents($this->fileName($key), serialize($data));
    }

    public function get($key)
    {
        return time() < (filemtime($this->fileName($key)) + $this->cache_expire) ? unserialize(file_get_contents($this->fileName($key))) : false;
    }
}
