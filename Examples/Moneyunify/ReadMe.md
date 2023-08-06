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

$curl = curl_init();

//Setup transaction details
$data = [
    'muid' => 'YOUR_MONEY_UNIFY_ID_HERE', //get it from your MoneyUnify dashboard https://dashboard.moneyunify.com/
    'first_name' => 'Customer_first_name',
    'last_name' => 'Customer_last_name',
    'email' => 'Customer_email',
    'phone_number' => 'customer_phone_number', // Customer mobile money phone number where funds are to be deducted. e.g 260971943638 
    'transaction_details' => 'Dell Laptop 3400', //Description of transaction / product being purchased
    'amount' => '2500' // valid number amount e.g 2.45 or 2345 or 23213.04. 2500 is just an example
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.moneyunify.com/moneyunify/request_payment",
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
    "transaction_token": "eyJ0eXAiOkJKc1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJLZXkiOiI0N2MwY2NhNjNkNTM0MmQ0YmI0MDNhYWEwNjBmNjEyOCJ9.NcnLBTk9A1A6KRVEWtJpjBa_gsYHlyxXvgijQTioqr8"
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
  'reference' => 'ayC0aWQiOoI5ODMxNjEsImVudiI6InAifQ',
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
    "transaction_token": "eyJ0eXAiOkJKc1QiLCJhbGciOiJIUzI1NiJ9.eyJwdWJLZXkiOiI0N2MwY2NhNjNkNTM0MmQ0YmI0MDNhYWEwNjBmNjEyOCJ9.NcnLBTk9A1A6KRVEWtJpjBa_gsYHlyxXvgijQTioqr8"
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
 
