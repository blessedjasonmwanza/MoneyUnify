# MoneyUnify Payments API Library Documentation

The [MoneyUnify](http://moneyunify.one) is a developer-friendly API Library plugin to accept payments, instant transfers, split payments, send payouts, and manage your startup business easily. **MoneyUnify** allows you to easily Validate your ideas with confidence and supports mobile money payments for all network operators 🚀

---

## 💸 Example: Request a Payment

```js
fetch("https://api.moneyunify.one/request_payment", {
  method: "POST",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
    "Accept": "application/json"
  },
  body: new URLSearchParams({
    from_payer: "09xxxxxxxx",
    amount: "1",
    auth_id: "pub_69b9y3n0h0ydbq"
  })
})
  .then(res => res.json())
  .then(data => console.log(data))
  .catch(err => console.error(err));
````

### Example Response

```json
{
  "is_error": false,
  "message": "Payment request initiated",
  "data": {
    "status": "success",
    "message": "Transaction sent to payer",
    "reference_id": "rp_vd89gdn10d1",
    "amount": 10.00,
    "cost": 0.3,
    "transaction_type": "request_to_pay"
  }
}
```

---

## 🔍 Example: Verify a Payment

```js
fetch("https://api.moneyunify.one/verify_payment", {
  method: "POST",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
    "Accept": "application/json"
  },
  body: new URLSearchParams({
    reference_id: "rp_vd89gdn10d1",
    auth_id: "pub_69b9y3n0h0ydbq"
  })
})
  .then(res => res.json())
  .then(data => console.log(data))
  .catch(err => console.error(err));
```

### Example Response

```json
{
  "is_error": false,
  "message": "Transaction verified successfully",
  "data": {
    "status": "successful",
    "reference_id": "rp_vd89gdn10d1",
    "amount": 10.00,
    "transaction_type": "request_to_pay",
    "payer": "09xxxxxxxx",
    "processed_at": "2025-10-16T14:25:33Z"
  }
}
```

---

**📘 Tip:**
Use your `auth_id` from your [MoneyUnify Businesses Dashboard](http://moneyunify.one/businesses) to authenticate all API calls.


---

## Conclusion

The MoneyUnify library simplifies the process of integrating with the Money Unify API. By following the steps outlined in this documentation, you can easily set up and make payment requests, verify transactions, and settle funds. For further assistance, feel free to reach out or check the official documentation for more advanced features.

---

# Author

👤 **Blessed Jason Mwanza** - show support 💖🙌 [Buy him a Coffee](https://www.buymeacoffee.com/mwanzabj)

- LinkedIn: [Connect with Blessed on LinkedIn](https://www.linkedin.com/in/blessedjasonmwanza)
- Github: [@blessedjasonmwanza](https://github.com/blessedjasonmwanza)
- Twitter: [Follow Blessed Jason @mwanzabj](https://twitter.com/mwanzabj)
- Youtube: [Youtube](https://www.youtube.com/@blessedjasonmwanza)

## 🤝 Contributing

Feel free to contribute to this project by submitting a pull request. Your contributions help improve the library and enhance the experience for all users!

Feature requests are welcome! Check the [issues page](https://github.com/blessedjasonmwanza/MoneyUnify/issues) or request a feature by creating a new issue.

## Show your Support

If you find this library helpful, consider supporting it by sharing it with others or [donating](https://www.buymeacoffee.com/mwanzabj). Your support is greatly appreciated!