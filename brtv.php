<?php
$id = $_GET[ 'id' ];
$channel_id = array(
  "3" => "brtv8kappweishi", //北京卫视
  "5" => "brtv8kappkejiao", //北京科教
  "6" => "brtv8kappyingshi", //北京影视
  "7" => "brtv8kappcaijing", //北京财经
  "10" => "brtv8kappqingnian", //北京青年
  "12" => "brtv8kappkaku", //卡酷少儿
  "13" => "brtv8kappwenyi", //北京文艺
  "14" => "brtv8kappshenghuo", //北京生活
  "15" => "brtv8kappxinwen", //北京新闻
  "16" => "brtv8kapp4ktiyu", //纪实科教
  "17" => "wenyiradio8kapp", //北京文艺广播
  "18" => "sportsradio8kapp", //北京体育广播
  "19" => "musicradio8kapp", //北京音乐广播
  "20" => "jiaotongradio8kapp", //北京交通广播
  "24" => "1502rongmeike8k", //纪实科教8K
  "25" => "newsradio8kapp", //新闻广播
  "26" => "newsradio8kapp", //北京新闻广播
  "27" => "englishradio8kapp", //北京外语广播
  "28" => "cityradio8kapp", //北京城市广播
  "29" => "storyradio8kapp", //北京故事广播
  "30" => "youngradio8kapp", //北京青年广播
  "31" => "jjjradio8kapp", //京津冀之声
);
/*
$bstrURL = 'https://btv8k.sobeylingyun.com/tvradio/api/getLiveConfig';
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $bstrURL );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
$data = curl_exec( $ch );
curl_close( $ch );
$url = 'https://down.brtvcloud.com/brtv8kapptv/' . $channel_id[ $id ] . '.m3u8';
$hexTime = dechex( time() + 1800 );
$txkey = json_decode( $data )->data->tx_auth_key;
$txSecret = md5( $txkey . $channel_id[ $id ] . $hexTime );
*/
$url = 'http://down.brtvcloud.com/brtvradio8kapp/' . $channel_id[ $id ] . '.m3u8';
$hexTime = dechex( 4102415999 );
$txSecret = md5('N3rQKabDCaibe8EWzfMy' .$channel_id[$id]. $hexTime);
$playurl = $url . '?txSecret=' . $txSecret . '&txTime=' . $hexTime;
header( 'Location:' . $playurl );

/*

http://down.brtvcloud.com/brtvradio8kapp/brtv8kappweishi.m3u8?txSecret=6a5ab8a63dd5fac28899cc34e748a60f&txTime=f485e67f 
http://down.brtvcloud.com/brtvradio8kapp/brtv8kappkejiao.m3u8?txSecret=ae8653622ea294326e077f09417721ee&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/brtv8kappcaijing.m3u8?txSecret=1f66832732bc8538fc044ae29199a13c&txTime=f485e67f 
http://down.brtvcloud.com/brtvradio8kapp/brtv8kappqingnian.m3u8?txSecret=d77f4e19f711299de9c65704b3340f14&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/brtv8kappkaku.m3u8?txSecret=20178f4f1c3d5c95a72fd646a7ea1585&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/brtv8kappwenyi.m3u8?txSecret=9abf1ade2f02cafe8d7203631debfd85&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/brtv8kappshenghuo.m3u8?txSecret=102c3efe4e35c750e76d85b822aa0e95&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/brtv8kappxinwen.m3u8?txSecret=14a7012e129036994ed9e5d9468dc4b0&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/brtv8kapp4ktiyu.m3u8?txSecret=93784d9650a45eedf5af21f8bd7cf466&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/wenyiradio8kapp.m3u8?txSecret=51a9abc812d11a788d7a79e7f1f2032a&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/sportsradio8kapp.m3u8?txSecret=936eac647f6a367cdd72872aeae45efa&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/musicradio8kapp.m3u8?txSecret=e2d9b9eb4564e311da5734ab45143695&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/jiaotongradio8kapp.m3u8?txSecret=ec0e62f1e7ac3b67227493b5e5a7ad66&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/1502rongmeike8k.m3u8?txSecret=1bb7a4b64d99c11b4bffc4de56fb0ca9&txTime=f485e67f 
http://down.brtvcloud.com/brtvradio8kapp/newsradio8kapp.m3u8?txSecret=46c5248a20d7efc67503f9c8d11fe602&txTime=f485e67f 
http://down.brtvcloud.com/brtvradio8kapp/englishradio8kapp.m3u8?txSecret=bc428246f194ed9fd9a7c6e9e2cd9814&txTime=f485e67f 
http://down.brtvcloud.com/brtvradio8kapp/cityradio8kapp.m3u8?txSecret=76f680e4c6f494bbce82fe0751f31f97&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/storyradio8kapp.m3u8?txSecret=59f37cc57d07a84ae4389ad470091aea&txTime=f485e67f
http://down.brtvcloud.com/brtvradio8kapp/youngradio8kapp.m3u8?txSecret=4ce299dd4476e5da8665a705ebd6ae08&txTime=f485e67f 
http://down.brtvcloud.com/brtvradio8kapp/jjjradio8kapp.m3u8?txSecret=1be6ef49e82d0ab632f21298cef3f405&txTime=f485e67f

*/
