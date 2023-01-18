<?php

$pid = $_GET['id'] ?? '2007524';
$apiUrl ='https://api-leap.nbcsports.com/feeds/assets/'.$pid.'?application=NBCNews&format=nbc-player&platform=desktop';
$headers = array(
    "content-type" => "application/json",
    "User-Agent" => "Mozilla/5.0 (X11; Linux x86_64; rv:108.0) Gecko/20100101 Firefox/108.0",
    "Accept "=> "application/json, text/plain, */*"
);

$dataSources = json_decode(get_data($apiUrl,null,null),true);
$sourceUrl = $dataSources['videoSources'][0]['cdnSources']['primary'][0]['sourceUrl'];
$cdn = $dataSources['videoSources'][0]['cdnSources']['primary'][0]['cdn'];
$requestorId=$dataSources['auth']['requestorId'];
$authType=$dataSources['auth']['authenticationType'];
$tokenUrl=$dataSources['playerVars']['cdnTokenEndpoint'];

$post='{
  "requestorId": "'.$requestorId.'",
  "pid": "'.$pid.'",
  "application": "NBCSports",
  "version": "v1",
  "platform": "desktop",
  "token": "",
  "resourceId": "",
  "inPath": "false",
  "authenticationType": "'.$authType.'",
  "cdn": "akamai",
  "url": "'.$sourceUrl.'"
}';

$rawUrl=json_decode(get_data($tokenUrl, $headers,$post),true);
$playUrl=$rawUrl['akamai'][0]['tokenizedUrl'];

header('location:'.$playUrl);

function get_data($url,$headers, $post): bool|string
{
    $curl = curl_init();
    if(str_starts_with($url, 'https')){
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, FALSE );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, FALSE );
    }
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $curl, CURLOPT_URL, $url );
    if ( !empty( $post ) ) {
        curl_setopt( $curl, CURLOPT_POST, 1 );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $post );
    }
    if ( !empty( $headers ) ) {
        curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers );
    }
    curl_setopt ($curl, CURLOPT_CONNECTTIMEOUT, 5);
    $data = curl_exec( $curl );
    curl_close( $curl );
    return $data;
}
