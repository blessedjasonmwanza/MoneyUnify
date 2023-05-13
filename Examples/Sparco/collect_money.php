<?php

/**
 * A demonstration on how you can collect money from a phone number purchasing products on your platform or website
 */


 include __DIR__.'/../core/MoneyUnify.php'; // path can change based on where your file is located

//Initiate MoneyUnify with a provider you're using
$MoneyUnify = new MoneyUnify('Sparco');

//configure once_off setup details
$provider = $MoneyUnify->config([
  'mode' => 'live',
  'private_key' => '123ws32ws',
  'public_key' => '123s112',
  "currency"=> "ZMW",
]);

// Set customer and order details
$provider->setCollectionDetails([
  "amount"=> 12.00,
  "customer_first_name"=> "Blessed",
  "customer_last_name"=> "Mwanza",
  "customer_email"=> "mwanzabj@gmail.com",
  "purchase_info"=> "ATOMS MKBHD 251 SNEAKER",
  "customer_mobile_number"=> "09xxxxxxxx",
]);

// Trigger request to collect funds from customer phone number
$payment_response_details = $provider->collect();

var_dump($payment_response_details);


?>
