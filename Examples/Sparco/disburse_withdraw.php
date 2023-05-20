<?php
/**
 * @package MoneyUnify
 * A demonstration on how you can withdraw or transfer funds from your virtual account to any mobile number Using Sparco
 */


include __DIR__.'/../../core/MoneyUnify.php'; // path can change based on where your file is located

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
$provider->setDisbursementDetails([
  "amount"=> 12.00,
  "destination_first_name"=> "Blessed",
  "destination_last_name"=> "Mwanza",
  "destination_email"=> "mwanzabj@gmail.com",
  "transfer_description"=> "ATOMS MKBHD 251 SNEAKER",
  "destination_mobile_number"=> "09xxxxxxxx",
]);

// Trigger request to collect funds from customer phone number
$payment_response_details = $provider->disburse();

var_dump($payment_response_details);


?>
