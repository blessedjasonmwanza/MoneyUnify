# MoneyUnify

## How to Collect and Send Money Using MoneyUnify with a Sparco Merchant account

  > *AIRTEL*, *MTN*, & *ZAMTEL*  Instant mobile Money collections and disbursements **in Zambia** with the flexibility of settling funds to your bank or mobile money account.

 
 ## SETUP

-  Login to your Sparco your account [here](https://gateway.sparco.io/) then, go to ```Settings``` tab and   order to obtain both your public and private/secret keys


 - Create your account on [MoneyUnify](https://dashboard.moneyunify.com) and use your above obtained keys to create your  muid (MoneyUnify ID)

<hr>

## Collecting online Mobile Payments [example]
> Use your favourite stack to collect money via USSD from customers in Zambia

- **API Collection URL** ***https://api.moneyunify.com/sparco/request_payment*** - *POST*

<table>
  <thead>
    <tr>
      <th>Jquery</th>
      <th>Laravel</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <img src="./collect/JQuery.png"/>
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
      <th>Vanilla JS using (Axios)</th>
      <th>JavaScript using (fetch)</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <img src="./collect/js axios.png"/>
      </td>
      <td>
        <img src="./collect/JS fetch.png"/>
      </td>
    </tr>
  </tbody>
</table>


<hr />



## SUCCESS Message Examples

> If transaction request is successful, you will get a response like this one.
```json
{
    "isError": false,
    "message": "Waiting for wallet holder to authorize debit transaction.",
    "console":{
    "code": 201,
        "reference": "eyJ0aWQiOjM1MTM1NSwiZW52IjoicCJ9",
        "status": "TXN_AUTH_PENDING",
        "transactionReference": "09xxxxxxxx_1640602121"
    }
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


## Sending, Crediting / sending money to mobile networks[example]
> Use your favourite stack to Transfer your collections to Zamtel or MTN Mobile networks in Zambia

> Funds / Money in your merchant account can also be settled directly to your bank account

API works the same as collections above include required parameters. What changes is the endpoint url. use the one below instead, for disbursements;
- **API Disbursement URL** ***https://api.moneyunify.com/sparco/send_money*** - *POST*


<table>
  <thead>
    <tr>
      <th>Jquery</th>
      <th>Laravel</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <img src="./disburse/send_money_jquery.png"/>
      </td>
      <td>
        <img src="./disburse/send_money_laravel.png"/>
      </td>
    </tr>
   </tbody>
</table>


<br />

# This project was built/tested with

- PHP 8

# Author

👤 **Blessed Jason Mwanza** - [Buy me A Coffee](https://www.buymeacoffee.com/mwanzabj) 

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
 
