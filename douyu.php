<?php
    $id = $_GET['id'];
    $ch = curl_init();
    curl_setopt_array($ch,[
  CURLOPT_URL => 'https://wxapp.douyucdn.cn/api/nc/stream/roomPlayer',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>"room_id=$id&big_ct=cpn-androidmpro&did=10000000000000000000000000001501&mt=2",
]);

    $playUrl = json_decode(curl_exec($ch))->data->live_url;
    curl_close($ch);
    header('location:'.$playUrl);

?>
