
<?php

$apiUrl = 'https://subre.vn/api/v2';
$apiKey = 'KvhM2Ao7wJ0ltnjqqYt7vBIZZ95d4dKgQdI6uxNVPqTd2UVnmbsfSr3eZc7m'; 
$action = 'balance';
$service = '';
$link = '';
$quantity = '';

$data = array(
    'key' => $apiKey,
    'action' => $action,
  //  'orders' => $service,
 //   'link' => $link,
  //  'quantity' => $quantity
);

$ch = curl_init($apiUrl);

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));

$response = curl_exec($ch);

curl_close($ch);

header('Content-Type: application/json');
echo $response; 

?>