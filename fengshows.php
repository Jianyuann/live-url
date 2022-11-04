<?php
$id = isset( $_GET[ 'id' ] ) ? $_GET[ 'id' ] : '3'; // 1=凤凰资讯 2=凤凰中文 3=凤凰HK
$id = $id - 1;
$idUrl = 'https://m.fengshows.com/api/v3/live?live_type=tv&page=1&page_size=15';
$headers = array(
  'fengshows-client: app(ios,5020201);iPhone14,5;15.6',
  'Cookie: acw_tc=0bc159c416601310655302310e60a16525c75b28a289968d7981e08cf77999',
  'User-Agent: FengWatch/5.2.2 (iPhone; iOS 15.6; Scale/3.00)'
);
$data = curlClient( $idUrl, $headers );
$json = json_decode( $data );
$liveId = $json[ $id ]->_id;

$authUrl = 'https://m.fengshows.com/api/v3/hub/live/auth-url?live_id=' . $liveId . '&live_qa=HD';
$data = curlClient( $authUrl, null );
$playUrl = json_decode( $data, true )[ 'data' ][ 'live_url' ];
#echo $playUrl;
//header( 'location:' . str_replace( '.flv', '.m3u8', $playUrl ) );
header( 'location:'. $playUrl );

function curlClient( $url, $headers ) {
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, $url );
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );
  if ( !empty( $headers ) ) {
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
  }
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
  $data = curl_exec( $ch );
  curl_close( $ch );
  return $data;
}

?>
