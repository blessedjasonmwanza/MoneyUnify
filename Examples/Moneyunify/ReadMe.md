# [MoneyUnify](https://github.com/blessedjasonmwanza/MoneyUnify)

## How to Receive payments in Zambia through Mobile Money Payments

  > *AIRTEL*, *MTN*, & *ZAMTEL*  Instant mobile Money collections and disbursements **in Zambia** highly recommended for businesses operating within **Zambia**, with the flexibility of settling funds to your bank or mobile money account.

 
## SETUP

 - Create your account on [MoneyUnify](https://dashboard.moneyunify.com) and use your above-obtained keys to create your  muid (MoneyUnify ID)
 - No need for KYC

<hr>

## Collecting online Mobile Payments [example]
> Use your favorite programming language to collect money via USSD from customers in Zambia

- **API Collection URL** ***https://api.moneyunify.com/moneyunify/request_payment*** - *POST*

### PHP Curl Example - Request payment from customer
```PHP

<?php

$body = array(
    'muid' => 'YOUR_MONEY_UNIFY_ID',
    'phone_number' => 'CUSTOMER_PHONE_NUMBER', // 10 digits customer phone number eg. 09700000
    'transaction_details' => 'Test order', -  this is just a sample
    'amount' => '1', // this is just a sample - amount to deduct e.g 5.50. or 2
    'email' => 'mwanzabj@gmail.com', //customer email -  this is just a sample
    'first_name' => 'Blessed Jason', //customer first name -  this is just a sample
    'last_name' => 'Mwanza', //customer last name -  this is just a sample
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.moneyunify.com/moneyunify/request_payment'); //endpoint
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($body));

$response = curl_exec($curl);

if ($response === false) {
    echo 'cURL Error: ' . curl_error($curl);
} else {
    echo $response;
}

curl_close($curl);

// see API responses below image examples for your eased debugging

```

**You love learning using videos?** 
 > We have API documentation videos [here](https://www.youtube.com/watch?v=FSiqu8u0SjE&list=PLfHq8ygfMtd7pvjYNQUuZAaxLAxg6hSN8&pp=gAQBiAQB)

<hr />



## SUCCESS Message Examples

> If transaction request is successful, you will get a response like this one.
```json
{
  "message": "Transaction pending authorization.",
  "data": {
    "amount": 1,
    "currency": "ZMW",
    "customerFirstName": "Blessed Jason",
    "customerLastName": "Mwanza",
    "customerMobileWallet": "0971943638",
    "feeAmount": 0,
    "feePercentage": 0,
    "merchantReference": "0971943638_1623338549",
    "reference": "ayC0aWQiOoI5ODfxNjEsImVudiI6InAifQ",
    "responseCode": 200,
    "status": "TXN_AUTH_PENDING",
    "transactionAmount": 1,
  },
  "isError": false
}
```

## Error Message examples

If transaction request has failed, you will get a response like this one.

```json
{
    "isError": true,
    "message": "request not authorized",
    "console":
    {
        "responseCode": 403
    }
}
```

<hr />


## Verifying transactions [example]
> Use your favorite programming language to verify transaction statuses


- **API Disbursement URL** ***https://api.moneyunify.com/moneyunify/verify_transaction*** - *using POST method*

### PHP Curl Example - verify transaction status
```PHP

<?php

$curl = curl_init();

//Setup verification details
$data = [
  'muid' => 'YOUR_MONEY_UNIFY_ID_HERE', //get it from your MoneyUnify dashboard https://dashboard.moneyunify.com/
  'reference' => 'ayC0aWQiOoI5ODMxNjEsImVudiI6InAifQ', //provide a transaction reference this is just an example reference
];

curl_setopt_array($curl, [
  CURLOPT_URL => "https://api.moneyunify.com/moneyunify/verify_transaction",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => [
    "Accept: */*",
    "Content-Type: application/x-www-form-urlencoded"
  ],
]);

// Trigger payment
$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}

// see API responses below image examples for your eased debugging

```

## Verification response example

> Check the status of the transaction
```json
{
  "message": "Transaction was successful",
  "data": {
    "amount": 0.97,
    "currency": "ZMW",
    "customerFirstName": "Blessed Jason",
    "customerLastName": "Mwanza",
    "customerMobileWallet": "0971943638",
    "feeAmount": 0.03,
    "feePercentage": 3,
    "merchantReference": "0971943638_139938267",
    "message": "Transaction was successful",
    "reference": "eyJ0aWciOjI3adDMxNTksImVudiI6InAifQ",
    "responseCode": 200,
    "status": "TXN_AUTH_SUCCESSFUL",
    "transactionAmount": 1
  },
  "isError": false
}
```

## Response Status Description

The following response statuses are returned when requesting payment or verifying transactions

| Status                 | Description                                        |
|------------------------|----------------------------------------------------|
| TXN_AUTH_PENDING       | Transaction awaiting authorization.               |
| TXN_PENDING            | Transaction still processing.                     |
| TXN_AUTH_SUCCESSFUL    | Transaction successfully processed. Successful authorization. |
| TXN_AUTH_UNSUCCESSFUL  | Transaction failed. Unsuccessful authorization.   |
| TXN_SUCCESSFUL         | Transaction successfully processed.               |
| TXN_FAILED             | Transaction failed.                               |
| TXN_PROCESSING         | Transaction was successfully submitted for processing. |


<br />

# This project was built/tested with

- PHP 8

# Author

👤 **Blessed Jason Mwanza** - [Donate to project](https://www.buymeacoffee.com/mwanzabj) 

- Portfolio : [https://blessedjasonmwanza.tech](https://blessedjasonmwanza.tech)

- LinkedIn: [Connect with me on LinkedIn](https://www.linkedin.com/in/blessedjasonmwanza)

- Github : [@blessedjasonmwanza](https://github.com/blessedjasonmwanza)

- Twitter : [Follow me @mwanzabj](https://twitter.com/mwanzabj)

- Youtube : [Youtube](https://www.youtube.com/@blessedjasonmwanza)

# 🤝 Contributing

Contributions, issues, and feature requests are welcome!

Feel free to check the [issues page](https://github.com/blessedjasonmwanza/MoneyUnify/issues).

# Show your support

Give a ⭐️ if you like this project!
 
