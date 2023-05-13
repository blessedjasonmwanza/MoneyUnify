# MoneyUnify

## How to Collect and Send Money Using MoneyUnify with a Sparco Merchant account

  > *AIRTEL*, *MTN*, & *ZAMTEL*  Instant mobile Money collections and disbursements

 
 ## SETUP
 - Create your account [here](https://gateway.sparco.io/) then, go to ```Settings``` tab in order to obtain both your public and private keys

 - Follow the demo instructions/guide in the [Collect_money.php](collect_money.php) sample file and modify it with the correct information for collection of payments on your website

 - You can also utilize the [Disburse / WithDraw](disburse_withdraw.php) sample file to learn how you can transfer money from your Virtual account after collection, to any mobile number. *Kindly note* After collection of payments from online clients, You'd have to wait for some 3 days or so in order to have your funds ready for disbursement. Contact the [Sparco Team](https://www.sparcopay.com/) for more information on this
<hr>

## Collecting online Mobile Payments [example]

```php
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


```
<hr />

## Withdrawing, sending and disbursing to mobile numbers [example]


```php

<?php
/**
 * A demonstration on how you can withdraw or transfer funds from your virtual account to any mobile number Using Sparco
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

```




## SUCCESS Message Examples

> If transaction request is successful, you will get a response like this one.
```php
 [
   "code" => 201, 
   "isError" => false, 
   "message" => "Waiting for wallet holder to authorize debit transaction.", 
   "reference" => "eyJ0aWQiOjM1MTM1NSwiZW52IjoicCJ9",  // this is used for transaction verification
   "status" => "TXN_AUTH_PENDING", 
   "transactionReference" => "09xxxxxxxx_1640602121" 
];

```

## Error Message examples

If transaction request has failed, you will get a response like this one.

```php
[
  ["isError"]=>true
  ["message"]=> "request not authorized"
  ["responseCode"]=> 403
]
```

<hr />

##  Verify Payment Transaction [example]

```php
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

$status_response = $provider->verify_payment($referenceString);

```

# This project was built with

- PHP 8

# Author

👤 **Blessed Jason Mwanza**
- Portfolio : [http://blessedjasonmwanza.me](http://blessedjasonmwanza.me)

- LinkedIn: [Connect with me on LinkedIn](https://www.linkedin.com/in/blessedjasonmwanza)

- Github : [@blessedjasonmwanza](https://github.com/blessedjasonmwanza)

- Twitter : [Follow me @mwanzabj](https://twitter.com/mwanzabj)

- Youtube : [Youtube](https://www.youtube.com/@blessedjasonmwanza)

# 🤝 Contributing

Contributions, issues, and feature requests are welcome!

Feel free to check the [issues page](https://github.com/blessedjasonmwanza/MoneyUnify/issues).

# Show your support

Give a ⭐️ if you like this project!