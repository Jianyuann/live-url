<?php

declare(strict_types=1);

use Random\RandomException;

$roomId = $_GET['id'] ?? '999';
$timestamp = (string)time();
$deviceId = '10000000000000000000000000001501';
$rate = '0';
$cdn = '';

$pageContent = file_get_contents('https://www.douyu.com/' . $roomId);

preg_match('/(vdwdae325w_64we[\s\S]*?function\s+ub98484234[\s\S]*?)function/', $pageContent, $matches) || exit;

$patchedJs = preg_replace('/eval.*?;}/s', 'strc;}', $matches[1]);

try {
    $tempJsFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . ('dy_' . bin2hex(random_bytes(8)) . '.js');
} catch (RandomException $e) {

}
$envRoomId = escapeshellarg($roomId);
$envDeviceId = escapeshellarg($deviceId);
$envTimestamp = escapeshellarg($timestamp);
$envPatchedJs = base64_encode($patchedJs);

$nodeScript = <<<NODE
    const crypto = require('crypto');
    const rid = process.env.RID || '';
    const did = process.env.DID || '';
    const tt  = process.env.TT  || '';
    const ub9_b64 = process.env.UB9 || '';
    var window={},document={},navigator={},console={log:function(){}};
    
    try{
      const code = Buffer.from(ub9_b64,'base64').toString('utf8');
      eval(code); // define ub98484234()
      var res = ub98484234(); 
      var m   = /v=(\\d+)/.exec(res);
      var v   = m ? m[1] : '';
      var rb  = crypto.createHash('md5').update(rid + did + tt + v).digest('hex');
    
      var func = res.replace(/return rt;\\}\\);?/, 'return rt;}');
      func = func.replace('(function (','function sign(')
                 .replace('CryptoJS.MD5(cb).toString()', "'" + rb + "'");
      eval(func); 
      var out = (typeof sign==='function') ? sign(rid,did,tt) : '';
      process.stdout.write(out);
    } catch(e){
      process.stdout.write('');
    }
NODE;

file_put_contents($tempJsFile, $nodeScript);
$command = "RID=$envRoomId DID=$envDeviceId TT=$envTimestamp UB9=" . escapeshellarg($envPatchedJs) . ' node ' . escapeshellarg($tempJsFile);
$postParams = (string)shell_exec($command);
@unlink($tempJsFile);

$postParams .= '&cdn=' . rawurlencode($cdn) . '&rate=' . rawurlencode($rate);

$apiUrl = 'https://www.douyu.com/lapi/live/getH5Play/' . $roomId;
$context = stream_context_create([
    'http' => [
        'method' => 'POST',
        'content' => $postParams,
    ],
]);
$jsonData = json_decode(file_get_contents($apiUrl, false, $context), true);

$rtmpUrl = (string)($jsonData['data']['rtmp_url'] ?? '');
$rtmpLive = (string)($jsonData['data']['rtmp_live'] ?? '');

$streamUrl = rtrim($rtmpUrl, '/') . '/' . ltrim($rtmpLive, '/');

header('Location: ' . $streamUrl);

/*<?php
date_default_timezone_set("Asia/Shanghai");
$id = $_GET['id'];
$apiUrl = 'https://wxapp.douyucdn.cn/Livenc/Getplayer/newRoomPlayer';
$data = file_get_contents($apiUrl, false, stream_context_create(array('http'=>array('method'=>'POST', 'content'=>http_build_query(array('room_id'=>$id, 'token'=>1))))));
$rawUrl = json_decode($data)->data->hls_url;
//tc-tct、open-tct、alia
$playUrl = 'https://alia.douyucdn2.cn/live/' . explode('_', basename($rawUrl))[0] . '.m3u8';
header('location:' . $playUrl);
*/
