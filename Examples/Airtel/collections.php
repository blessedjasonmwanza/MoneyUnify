<?php

/**
 * @package MoneyUnify
 * Payments - USSD Push AIRTEL Specific ref: https://developers.airtel.africa/
 * This API is used to request a payment from a consumer(Payer). 
 * The consumer(payer) will be asked to authorize the payment. 
 * After authorization, the transaction will be executed.
 */

include __DIR__.'/../../core/MoneyUnify.php'; // path can change based on where your file is located

$MoneyUnify = new MoneyUnify('Airtel');

//configure once_off setup details
$provider = $MoneyUnify->config([
  'mode' => 'sandbox', //sanbox for testing or live for production
  'public_key' => '', //Airtel client_key
  'private_key' => '', // Airtel client secret key
]);

$provider->setCollectionDetails([
  'amount' => 12.00, // amount to deduct from client wallet
  'subscriber_country' => "ZM",
  'subscriber_currency' => "ZMW",
  'customer_mobile_number' => "9xxxxxxxx", //exclude country codes such as 260
  'transaction_country' => "ZM", //The country in which the transaction is happening, basically used for cross border payments. For the same country, this field is not required (optional)
  'transaction_currency' => "ZMW", //The currency in which the transaction is happening, basically used for cross border payments.For the same country, this field is not required (optional)
  "purchase_info" => "", //Reference for service / goods purchased.
]);

// Trigger request to collect funds from customer phone number
$payment_response_details = $provider->collect();

var_dump($payment_response_details);