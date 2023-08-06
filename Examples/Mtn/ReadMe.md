# [MoneyUnify](https://github.com/blessedjasonmwanza/MoneyUnify)

## How to Collect Payments Using MoneyUnify with MTN MoMo Merchant account

How to Collect and Send Money Using MoneyUnify with - Airtel Merchant account
  > *MTN* to *MTN*, Instant mobile Money collections and disbursements **in over 12 African countries** with the flexibility of settling funds to your bank or mobile money account.

 
## SETUP

-  Login to your MTN MoMo account [here](https://momodeveloper.mtn.com/signin?ReturnUrl=%2F).
-  Follow all instructions [here](https://momodeveloper.mtn.com/api-documentation/getting-started/) on how to subscribe to the collection API if you have not yet done so
-  Go to [Profile](https://momodeveloper.mtn.com/developer) tab to order to obtain both your public/Secondary and private/Primary keys


 - Create your account on [MoneyUnify](https://dashboard.moneyunify.com) and use your above obtained keys to create your  muid (MoneyUnify ID) - This applies if you have not yet created your MoneyUnify Account. If you already have one, just login, you will find your MUI ID om your dashboard.

<hr>

## Collecting online Mobile Payments [example]
> Use your favorite stack or programming language to collect money via USSD from customers in Zambia

- **API Collection URL** ***https://api.moneyunify.com/sparco/request_payment*** - *POST*

### PHP Curl Example - Request payment from customer
```PHP

<?php

$curl = curl_init();

//Setup transaction details
$data = [
    'muid' => 'YOUR_MONEY_UNIFY_ID_HERE', //get it from your money unify dashboard https://dashboard.moneyunify.com/
    'mode' => 'sandbox', // live for production and sandbox when testing the API
    'phone_number' => 'customer_phone_number', // Customer mobile money phone number where funds are to be deducted. 
    'transaction_details' => 'Dell Laptop 3400', //Description of transaction / product being purchased
    'amount' => '2500' // valid number amount e.g 2.45 or 2345 or 23213.04. 2500 is just an example
];

curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.moneyunify.com/mtn/request_payment",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
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
 > We have API documentation videos [here](https://www.youtube.com/@blessedjasonmwanza)


<table>
  <thead>
    <tr>
      <th>Python</th>
      <th>Laravel</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <img src="./collect/Python.png"/>
      </td>
      <td>
        <img src="./collect/Laravel.png"/>
      </td>
    </tr>
   </tbody>
</table>


<table>
  <thead>
    <tr>
      <th>JavaScript using (fetch)</th>
      <th>PHP Curl</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <img src="./collect/JavaScript.png"/>
      </td>
      <td>
        <img src="./collect/Curl-php.png"/>
      </td>
    </tr>
  </tbody>
</table>


<hr />



## SUCCESS Message Examples

> If transaction request is successful, you will get a response like this one.
```json
{
  "message": "Request successful!",
  "data": {
    "headers": {
      "Content-Type": "application/json",
      "X-Reference-Id": "ca9cd07d-0f16-4b61-bac7-dc01c09bcba6",
      "Authorization": "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSMjU2In0.eyJjbGllbnRJZCI6IaRkOTEzZDdkLTlmMTYtNGI2MS1iYWM3LWRjMDFjNjliY2JhNiIsImV4cGlyZXMiOiIyMDIzLTA3LTI1VDE5OjU4OjMxLjk2OCIsInNlc3Npb25JZCI6ImIxOGFjMzEzLTQwMGItNDkzZS1iZGRmLWNiOGE0MzFlMzJjZCJ9.Q_L0Y0PstuBbgc2lxefTcRsB9rMywdjMsbKj2y3pfFB7qvUFdaxqsPX6EzV0qXtywHaErSObEd0-TvoLvGehKQbx4kyS-7UfI6AdQm2CRQXVj7ZBFiMXNReQA0uSQeOV-IFGPiS79rqMfKpxuPaJcN7gCxkYJ7nYUlGco-BvJBYeDPRQVpu7feHGMtB4BEh0oPrC4bZf3AN7IGnpehUt38uUoi7YFGsIYrpxZ-T5SJOMQlEklP-tHVWVZyimyon2tK7WFJ6tz_w4HkVnxAvrsjEp307chgDXsdrl7lmr1ElKzOShDG7uPWvzJQf8I7dnKJwgXPt7of07gYfFfvB8fg",
      "X-Target-Environment": "sandbox",
      "Ocp-Apim-Subscription-Key": "ed25112b0b624abdbc5f0063f31c21fe"
    }
  },
  "isError": false
}
```

## Error Message examples

If transaction request has failed, you will get a response like this one. For debugging purposes, kindly refer to the [official MoMo Developer site](https://momodeveloper.mtn.com/api-documentation/common-error/).

```json
{
  "message": "Request payment Failed. Please try again: ",
  "console": {
    "debug": {
      "status_code": 400,
      "headers": [
        "Content-Type: application/json",
        "X-Reference-Id: 0d59da5c-8f7d-4a00-bab0-bae2334c8019",
        "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSMjU2In0.eyJjbGllbnRJZCI6IjBkNTlkYTVjLThmN2QtNGEwMC1iYWIwLWJhZTIzMzRjODAxOSIsImV4cGlyZXMiOiIyMDIzLTA3LTI2VDIxOjM5OjMyLjY4OCIsInNlc3Npb25JZCI6ImI2NWU2ODhiLTQ5NDItNGU5NS1hNGQ1LWFjYzVmOWIxNjg4OCJ9.AZ9pIpkqfmp-1qTcSw6ei_3teixZjHV-eaU9-DQ6vzZnj9rOA75MCqQnOQrvNUESvb3V0k7GOx-NXix6gYzzDdEaetCx42Ix757rqeh71DeVXatkMA8ZXTSSco-7ZRjDUlTC1lFqIccq5_hJzvWzpmzS7suAkX-dxMOvkfycoZ9A9AIvqUHBwzc0xGXmJsWgMxTXjeZy7ZDw_Ryxa9bMS447OwhqmV6xmiNrU5aU1JWWh6xA3hBarY4gHAqpLo8GHP6dcqzTaU373vmVgpCo-5s6bzQgchGW9DziWYuJpppwlwaV2eI21G_jksRjTQ_HZi-ftYzfxmTcFg1B4TkK-g",
        "X-Target-Environment: sandbox",
        "Ocp-Apim-Subscription-Key: 3925012b0b624abdbc5f0063f27c215e"
      ],
      "body": "{\"amount\":\"2500\",\"currency\":\"EUR\",\"externalId\":\"16904039737268\",\"payer\":{\"partyIdType\":\"MSISDN\",\"partyId\":\"\"},\"payerMessage\":\"Payment: Dell Laptop 3400\",\"payeeNote\":\"Dell Laptop 3400\"}",
      "response": ""
    }
  },
  "isError": true
}
```

<hr />


<br />

# This project was built/tested with

- PHP 8

# Author

👤 **Blessed Jason Mwanza** - [Buy me A Coffee](https://www.buymeacoffee.com/mwanzabj) 

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
 
