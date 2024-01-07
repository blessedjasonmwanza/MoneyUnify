
# [MoneyUnify](https://github.com/blessedjasonmwanza/MoneyUnify)

## How to Receive Payments in Zambia through Mobile Money

Receive instant mobile money collections in Zambia through all 3 mobile networks; AIRTEL, MTN, and ZAMTEL. `moneyunify` endpoint is recommended for businesses operating within Zambia, providing the flexibility of settling funds to your bank or mobile money account.

## Setup

- Create an account on [MoneyUnify](https://dashboard.moneyunify.com) and use the obtained keys to create your MoneyUnify ID (muid).
- No need for KYC.
- Customer support available via - 📞 [WhatsApp](https://wa.me/+260971943638)

### Visit https://documenter.getpostman.com/view/11980646/2s9YsJBXZT for a comprehensive and easy-to-use documentation.

---

## Collecting Online Mobile Payments [Example]

Use your favorite programming language to collect money via USSD from customers in Zambia.
- **API Collection URL**: `https://api.moneyunify.com/moneyunify/request_payment` - use **POST** method
  > Before any transaction fees A ZMW 1 (`amount + 1`) charge is added on every collection /request to pay request by MNO.

### PHP Curl Example - Request Payment from Customer

```php
<?php

/* body or params must be form-data and not json if you're using any other programming language
this is an example in PHP
*/
$body = array(
    'muid' => 'YOUR_MONEY_UNIFY_ID',
    'phone_number' => 'CUSTOMER_PHONE_NUMBER', // 10 digits customer phone number, e.g., 09700000
    'transaction_details' => 'Test order',
    'amount' => '1', // Amount to deduct, e.g., 5.50 or 2
    'email' => 'mwanzabj@gmail.com',
    'first_name' => 'Blessed Jason',
    'last_name' => 'Mwanza',
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://api.moneyunify.com/moneyunify/request_payment');
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
```

---

## Success Message Example

If the transaction request is successful, you'll receive a response like this:



```json
// always returns a json object 
{
  "message": "Transaction was successful",
  "data": {
    "amount": 1,
    "currency": "ZMW",
    "customerFirstName": "Blessed Jason",
    "customerLastName": "Mwanza",
    "customerMobileWallet": "0971943638",
    "merchantReference": "0971943638_1693599460",
    "reference": "eyJ0aWQiOjI5ODg4ODQsImVudiI6InAifQ",
    "responseCode": 200,
    "status": "TXN_AUTH_SUCCESSFUL",
    "transactionAmount": 1
  },
  "isError": false
}
```

---

## Error Message Example

If the transaction request fails, you'll receive a response like this:

```json
{
    "isError": true,
    "message": "request not authorized",
    "console": {
        "responseCode": 403
    }
}
```


---

## Settle Funds to Mobile Wallet [Example]

Use your favorite programming language to Settle Funds to your mobile wallet.

<h4 style="color: red"> WARNINGS ⚠️⚠️ </h4>

  - ⚠️ Settlements **are None Reversible**! **keep your muid and email private!**
  - ⚠️ This endpoint will move all your funds into the destination phone number use it with extra care


### PHP Curl Example - Settle funds to mobile money wallet

- **TRANSACTION SETTLEMENT URL**: `https://api.moneyunify.com/moneyunify/settle` - use **POST** method

```php
<?php

$curl = curl_init();

/* body or params must be form-data and not json if you're using any other programming language
this is an example in PHP
*/
$body = array(
    "muid" => "YOUR_MUID",
    "email" => "user@site.domain", // your email associated with moneyunify
    "first_name" => "Blesson", //receiving account holder first name
    "last_name" => "Mwanza", //receiving account holder last name
    "transaction_details" => "Settle all money to mobile wallet", 
    "phone_number" => "096xxxxxxx", // 10 digits MTN receiving/settlement phone number
);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.moneyunify.com/moneyunify/settle",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($body),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
```

---

## Settlement Response Example

Check the status of the transaction:

```json
{
  "message": "Settlement successful!",
  "data": {
    "reference": "eyJ0aWQiOjI5ODc3MzEsImVudiI6InAifQ",
    "status": "TXN_SUCCESSFUL"
  },
  "isError": false
}
```





---

## Verifying Transactions [Example]

Use your favorite programming language to verify transaction statuses.

- **TRANSACTION VERIFICATION URL**: `https://api.moneyunify.com/moneyunify/verify_transaction` - use **POST** method

### PHP Curl Example - Verify Transaction Status

```php
<?php

$curl = curl_init();

$body = array(
    'muid' => 'YOUR_MONEY_UNIFY_ID_HERE',
    'reference' => 'ayC0aWQiOoI5ODMxNjEsImVudiI6InAifQ',
);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.moneyunify.com/moneyunify/verify_transaction",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($body),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
```

---

## Verification Response Example

Check the status of the transaction:

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

---

## Response Status Description

Here are the response statuses returned when requesting payment or verifying transactions:

| Status               | Description                                           |
|----------------------|-------------------------------------------------------|
| TXN_AUTH_PENDING     | Transaction awaiting authorization.                  |
| TXN_PENDING          | Transaction still processing.                        |
| TXN_AUTH_SUCCESSFUL  | Successfully authorized transaction.                 |
| TXN_AUTH_UNSUCCESSFUL| Transaction authorization failed.                    |
| TXN_SUCCESSFUL       | Transaction successfully processed.                  |
| TXN_FAILED           | Transaction failed.                                  |
| TXN_PROCESSING       | Transaction submitted for processing.                |

---

> Please `NOTE` - Transactions delay to be approved  and return `Pending`. You'll need to always keep your transaction response reference keys and use the verify endpoint to verify the status before moving your customers to the next steps of the purchase journey.

## This Project was Built/Tested with

- PHP 8

## Author

👤 **Blessed Jason Mwanza**

- Portfolio: [https://blessedjasonmwanza.tech](https://blessedjasonmwanza.tech)
- LinkedIn: [Connect on LinkedIn](https://www.linkedin.com/in/blessedjasonmwanza)
- Github: [@blessedjasonmwanza](https://github.com/blessedjasonmwanza)
- Twitter: [Follow @mwanzabj](https://twitter.com/mwanzabj)
- YouTube: [YouTube Channel](https://www.youtube.com/@blessedjasonmwanza)

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/blessedjasonmwanza/MoneyUnify/issues).

## Show Your Support

If you find this project helpful, give it a ⭐️!
