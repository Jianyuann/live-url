<?php

$key = "5b28bae827e651b3";
$id = $_GET['id'] ?? '254';

$channels = [
    2 => '吉林卫视',
    3 => '都市频道',
    4 => '生活频道',
    5 => '影视频道',
    6 => '乡村频道',
    7 => '新闻频道',
    8 => '文化频道',
    9 => '戏曲频道',
    254 => '内蒙古卫视',
    126 => '蒙古语卫视',
    127 => '新闻综合频道',
    128 => '经济生活',
    129 => '少儿频道',
    130 => '文体娱乐频道',
    131 => '农牧频道',
    132 => '蒙古语文化',
    140 => '呼和浩特',
    141 => '文体娱乐',
    156 => '锡林郭勒盟',
    157 => '阿拉善',
    158 => '巴彦淖尔',
    159 => '鄂尔多斯',
    161 => '赤峰',
    163 => '通辽',
    164 => '乌兰察布',
    165 => '乌海',
    166 => '呼伦贝尔',
    167 => '兴安盟',
    168 => '包头'
];

$targetId = intval($id);
if (strlen($id) <= 2) {
    $apiUrl = "https://clientapi.jlntv.cn/broadcast/list";
} else {
    $apiUrl = "https://api-bt.nmtv.cn/broadcast/list";
}

$options = [
    'http' => [
        'method' => 'POST',
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36\r\nContent-Type: application/json; charset=UTF-8",
        'content' => "n6wT4YYLUZiY/41vQYu5oSHD2lotdczz5ohPQw=="
    ]
];

$response = file_get_contents($apiUrl, false, stream_context_create($options));
$data = base64_decode($response);
$decrypted = _xxtea_decrypt($data, $key);
$json = json_decode($decrypted, true);
$streamUrl = "";

foreach ($json['data'] as $item) {
    if ($item['data']['id'] == $targetId) {
        $streamUrl = $item['data']['streamUrl'];
        break;
    }
}

header('location:' . $streamUrl);

// XXTEA解密函数
function _xxtea_decrypt($str, $key): false|string
{
    if ($str == "") return "";
    $v = _xxtea_str2long($str, false);
    $k = _xxtea_str2long(substr($key . str_repeat("\0", 16), 0, 16), false);
    $n = count($v);
    if ($n < 2) return false;

    $y = $v[0];
    $delta = 0x9E3779B9;
    $q = floor(6 + 52 / $n);
    $sum = ($q * $delta) & 0xffffffff;

    while ($sum != 0) {
        $e = ($sum >> 2) & 3;
        for ($p = $n - 1; $p > 0; $p--) {
            $z = $v[$p - 1];
            $mx = ((($z >> 5) ^ ($y << 2)) + (($y >> 3) ^ ($z << 4))) ^ (($sum ^ $y) + ($k[($p & 3) ^ $e] ^ $z));
            $y = $v[$p] = ($v[$p] - $mx) & 0xffffffff;
        }
        $z = $v[$n - 1];
        $mx = ((($z >> 5) ^ ($y << 2)) + (($y >> 3) ^ ($z << 4))) ^ (($sum ^ $y) + ($k[(0 & 3) ^ $e] ^ $z));
        $y = $v[0] = ($v[0] - $mx) & 0xffffffff;
        $sum = ($sum - $delta) & 0xffffffff;
    }

    return _xxtea_long2str($v, true);
}

function _xxtea_long2str($v, $w): false|string
{
    $len = count($v);
    $n = ($len - 1) << 2;
    if ($w) {
        $m = $v[$len - 1];
        if ($m < $n - 3 || $m > $n) return false;
        $n = $m;
    }
    $s = '';
    for ($i = 0; $i < $len; $i++) {
        $s .= pack("V", $v[$i]);
    }
    return $w ? substr($s, 0, $n) : $s;
}

function _xxtea_str2long($s, $w): array
{
    $len = strlen($s);
    $v = array();
    for ($i = 0; $i < $len; $i += 4) {
        $v[] = unpack("V", substr($s, $i, 4) . str_repeat("\0", 4 - (strlen(substr($s, $i, 4)))))[1];
    }
    if ($w) $v[] = $len;
    return $v;
}
