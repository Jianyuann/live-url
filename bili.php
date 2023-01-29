<?php
$id = $_GET[ 'id' ];

$apiUrl='https://api.live.bilibili.com/xlive/web-room/v2/index/getRoomPlayInfo?protocol=1&format=1&codec=0&qn=30000&platform=web&room_id='. $id;

$rawUrl=json_decode(get_data($apiUrl,null,null),true);

$host=$rawUrl['data']['playurl_info']['playurl']['stream'][0]['format'][0]['codec'][0]['url_info'][0]['host'];
$baseUrl=$rawUrl['data']['playurl_info']['playurl']['stream'][0]['format'][0]['codec'][0]['base_url'];
$extra=$rawUrl['data']['playurl_info']['playurl']['stream'][0]['format'][0]['codec'][0]['url_info'][0]['extra'];

$playUrl=$host.$baseUrl.$extra;
header('location:'.$playUrl);

function get_data($url,$headers, $payload): bool|string
{
    $curl = curl_init();
    if(str_starts_with($url, 'https')){
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
    }
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $curl, CURLOPT_URL, $url );
    if ( !empty( $payload ) ) {
        curl_setopt( $curl, CURLOPT_POST, 1 );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $payload );
    }
    if ( !empty( $headers ) ) {
        curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
    }
    curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec( $curl );
    curl_close( $curl );
    return $data;
}
