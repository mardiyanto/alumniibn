<?php
include 'koneksi.php';
include 'config/initsoap.php';
$datanama= $_GET['id_d'];
  $filter = '';
  $order = '';
  $limit = '5';
  $offset = '';
  $dictejum = [
      // 'act' => "GetListDosen",
      'act' => $datanama,
      'token' => $_token,
      'filter' => $filter, 
      'order' => $order, 
      'limit' => $limit, 
      'offset' => $offset
  ];
  $datajson = json_decode($_ws->execute($dictejum), true);
//   echo"<pre>";
//   print_r($datajson);
//   echo"</pre>";
  $response = [
      'error_code' => 0,
      'error_desc' => '',
      'jumlah' => count($datajson['data']),
      'data' => $datajson['data']
  ];



// Mengubah array menjadi JSON dengan format yang lebih bagus
$json = json_encode($response, JSON_PRETTY_PRINT);

// Menampilkan hasil JSON
header('Content-Type: application/json');
echo $json;
?>
