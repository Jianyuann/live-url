<?php
$id = $_GET[ "id" ];
$QUALITY = $_GET[ "q" ];

function get_data( $url ){
  return extracted( $url );
}

/**
 * @param $url
 * @return bool|string
 */
function extracted( $url ) {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
  curl_setopt( $ch, CURLOPT_USERAGENT, "facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)" );
  curl_setopt( $ch, CURLOPT_REFERER, "http://facebook.com" );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
  $data = curl_exec( $ch );
  curl_close( $ch );
  return $data;
}

$string = get_data( 'https://www.youtube.com/watch?v=' . $id );
preg_match_all( '/hlsManifestUrl(.*m3u8)/', $string, $matches, PREG_PATTERN_ORDER );
$rawURL = str_replace( "\/", "/", substr( $matches[ 1 ][ 0 ], 3 ) );

$QUALITY_REGEX = match( $QUALITY ) {
  '301' => '/(https:\/.*\/301\/.*index.m3u8)/',
  '300' => '/(https:\/.*\/300\/.*index.m3u8)/',
  //'96' => '/(https:\/.*\/96\/.*index.m3u8)/',
  '95' => '/(https:\/.*\/95\/.*index.m3u8)/',
  '94' => '/(https:\/.*\/94\/.*index.m3u8)/',
  default => '/(https:\/.*\/96\/.*index.m3u8)/',
};
preg_match_all( $QUALITY_REGEX, get_data( $rawURL ), $playURL, PREG_PATTERN_ORDER );
header( "Content-type: application/vnd.apple.mpegurl" );
header( "Location: " . $playURL[ 1 ][ 0 ] );
