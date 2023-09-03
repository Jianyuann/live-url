<?php
$id = $_GET['id'];

$apiUrl = 'https://wxapp.douyucdn.cn/Livenc/Getplayer/newRoomPlayer';
$payload = 'room_id='.$id.'&token=1';
$ch = curl_init();
curl_setopt( $ch, CURLOPT_URL, $apiUrl );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
curl_setopt( $ch, CURLOPT_POST, TRUE );
curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0" );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
$data = curl_exec( $ch );
curl_close( $ch );

$rawUrl = json_decode( $data )->data->hls_url;
$hlsName = explode( '_', basename( parse_url( $rawUrl, PHP_URL_PATH ) ) );
$playUrl = 'https://tc-tc2-interact.douyucdn2.cn/live/' . $hlsName[ 0 ] . '.m3u8';
header( 'location:' . $playUrl );
