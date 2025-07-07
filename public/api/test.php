
<?php

$apiUrl = 'https://api.baostar.pro/api/v2';
$apiKey = 'bm93ZGFjYmM3MWY1MDZiZmYzNzI0NTA0OWM4OTY5N2VlZTQ1NWU5ZWFkMTUwOWMzNTNhYzgxNjlmOTgzYmYzNDc4MQ'; 
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