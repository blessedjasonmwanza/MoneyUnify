# MoneyUnify Library PHP Documentation

The **MoneyUnify** library provides an easy interface for integrating with the [MoneyUnify API](http://MoneyUnify.com) to process mobile money payments. This documentation will guide you through the installation process and demonstrate how to use the library effectively. support for multiple programming languages is available [here](https://www.apidog.com/apidoc/shared-c8a1fbbb-8410-4978-8a64-937fc55186da)

- ### MoneyUnify - Payments in Zambia _(Recommended for businesses/individuals in Zambia)_
  > Instant settlements and repayments

![image](https://github.com/blessedjasonmwanza/MoneyUnify/assets/35315311/3b2db60b-cb0f-422f-af6f-04e9141a8f66)

> Ideal for money collections in Zambia - Coming soon to **Tanzania**, **Nigeria**, **Kenya** 👀

- [x] **Make Collections** - Request mobile Money payments from _AIRTEL_, _MTN_, & _ZAMTEL_ (All Network operators in Zambia)
- [x] **Settle Funds** - Disburse and Settle funds from your MoneyUnify Account to _MTN_, _Zamtel_, _MTN_ All Mobile Networks Instantly
- [x] **🤙 Instant Customer support** available via - 📞 [WhatsApp](https://wa.me/+260971943638)
- #### SETUP
  - [x] It's easy and instant! 😃 Just [Create your account on MoneyUnify](https://dashboard.moneyunify.com/) to get your API key (MUID)
  - [x] 📂 Check documentation below or [ here for more languages](https://www.apidog.com/apidoc/shared-c8a1fbbb-8410-4978-8a64-937fc55186da) - Comes with some examples 😃 />
  - [x] 🤙 Customer support available via - 📞 [WhatsApp](https://wa.me/+260971943638)
- #### Supported Countries on the Moneyunify endpoint
  | Country  | Country Code | Currency           | Currency Code | Status         |
  | -------- | ------------ | ------------------ | ------------- | -------------- |
  | ZAMBIA   | ZM           | Zambian kwacha     | ZMW           | Active ✔️      |
  | TANZANIA | TZ           | Tanzanian shilling | TZS           | Coming Soon ⏰ |
  | KENYA    | KE           | Kenyan shilling    | KES           | Coming Soon ⏰ |

### Charges and FEES

---

#### Collections (Receiving payments)

> 2.5% + 1 ZMW per transaction (reduced from the initial ~3.5%~)

##### Settlements / Transferring to mobile money

| Settlement Account balance           | What you you'll receive | Charges/ Transaction Fees |
| ------------------------------------ | ----------------------- | ------------------------- |
| balance \[20 ZMW \~ 1,000 ZMW \]     | balance - 12            | 12 ZMW                    |
| balance \[1,000 ZMW \~ 50,000 ZMW \] | balance - 20            | 20 ZMW                    |
| balance \[ 50,000 \~ 100,000 ZMW \]  | balance - 30            | 30 ZMW                    |

## Installation

Documentation Usage for languages other than PHP is {available here]()

1. **Install Composer** (if you haven’t already). Follow the [Composer installation guide](https://getcomposer.org/download/).

2. **Install the MoneyUnify Library** by adding it to your `composer.json`:

   ```bash
   composer require blessedjasonmwanza/moneyunify
   ```

## Usage

### Basic Usage

1. **Include the Autoload File**:

   ```php
   require 'vendor/autoload.php'; // Include Composer autoload
   ```

2. **Create an Instance of the `MoneyUnify` Class**:

   ```php
   use Blessedjasonmwanza\MoneyUnify\MoneyUnify;

   $muid = 'your_unique_muid'; // Replace with your actual MUID  - obtain it at https:/MoneyUnify.com
   $moneyUnify = new MoneyUnify($muid);
   ```

3. **Call the `requestPayment` Method**:

   ```php
   $payerPhoneNumber = '0xxxxxxxx'; // Replace with payer's phone number
   $amountToPay = '10'; // Amount to be paid

   $response = $moneyUnify->requestPayment($payerPhoneNumber, $amountToPay);
   ```

4. **Check the Response**:

   ```php
   if ($response->isError) {
       echo "Error: " . $response->message . "\n";
       echo "Console: " . ($response->console ?? 'No console message to debug') . "\n";
   } else {
       echo "Success: " . $response->message . "\n";
       echo "Data: " . json_encode($response->data) . "\n";
   }
   ```

### Example Successful Response

```json
{
  "message": "Transaction successful",
  "data": {
    "amount": "5.00",
    "customer_name": "Blessed Mwanza",
    "customerMobileWallet": "0769641179",
    "reference": "0762611179_1713450343",
    "status": "successful"
  },
  "isError": false
}
```

### Verifying a Payment

To verify a payment, use the `verifyPayment` method:

1. **Verify the Payment**:

   ```php
   $transactionReference = 'your_transaction_reference'; // Replace with transaction reference
   $verificationResponse = $moneyUnify->verifyPayment($transactionReference);
   ```

2. **Check the Verification Response**:

   ```php
   if ($verificationResponse->isError) {
       echo "Error: " . $verificationResponse->message . "\n";
       echo "Console: " . ($verificationResponse->console ?? 'No console message to debug') . "\n";
   } else {
       echo "Verification Success: " . $verificationResponse->message . "\n";
       echo "Data: " . json_encode($verificationResponse->data) . "\n";
   }
   ```

### Example Verification Response

```json
{
  "message": "Transaction pending OTP confirmation",
  "data": {
    "amount": "1.00",
    "customer_name": "Dilip Okafor",
    "customerMobileWallet": "260975555555",
    "reference": "0975555555_1713447717",
    "status": "otp-required"
  },
  "isError": false
}
```

### Settling Funds

To settle the current virtual account balance, use the `settleFunds` method:

1. **Settle Funds**:

   ```php
   $settleParams = [
       'moneyunify_email' => 'your_email@example.com', // Replace with your MoneyUnify email
       'receiver_first_name' => 'Blessed',
       'receiver_last_name' => 'Mwanza',
       'receiver_phone_number' => '0971943638', // Replace with receiver's phone number
       'transaction_details' => 'Settling funds to the specified account.'
   ];

   $settlementResponse = $moneyUnify->settleFunds($settleParams);
   ```

2. **Check the Settlement Response**:

   ```php
   if ($settlementResponse->isError) {
       echo "Error: " . $settlementResponse->message . "\n";
       echo "Console: " . ($settlementResponse->console ?? 'No console message to debug') . "\n";
   } else {
       echo "Settlement Success: " . $settlementResponse->message . "\n";
       echo "Data: " . json_encode($settlementResponse->data) . "\n";
   }
   ```

### Example Successful Settlement Response

```json
{
  "message": "Transaction successful",
  "data": {
    "amount": "9.29",
    "customer_name": "BLESSED MWANZA",
    "customerMobileWallet": "0971943638",
    "reference": "Settlement_0971943638_1713460876",
    "status": "successful"
  },
  "isError": false
}
```

## Conclusion

The MoneyUnify library simplifies the process of integrating with the Money Unify API. By following the steps outlined in this documentation, you can easily set up and make payment requests, verify transactions, and settle funds. For further assistance, feel free to reach out or check the official documentation for more advanced features.

# Author

👤 **Blessed Jason Mwanza** - show support 💖🙌 [Buy him a Coffee](https://www.buymeacoffee.com/mwanzabj)

- LinkedIn: [Connect with Blessed on LinkedIn](https://www.linkedin.com/in/blessedjasonmwanza)
- Github: [@blessedjasonmwanza](https://github.com/blessedjasonmwanza)
- Twitter: [Follow Blessed Jason @mwanzabj](https://twitter.com/mwanzabj)
- Youtube: [Youtube](https://www.youtube.com/@blessedjasonmwanza)

# 🤝 Contributing

Contributions, issues, and feature requests are welcome!

Feel free to check the [issues page](https://github.com/blessedjasonmwanza/MoneyUnify/issues).

# Show your support

Give a ⭐️ if you like this project! or [Donate](https://www.buymeacoffee.com/mwanzabj)
