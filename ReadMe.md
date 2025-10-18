# MoneyUnify Payments API Library - [Documentation](https://owk7kqf8sn.apidog.io/)

The [MoneyUnify](http://moneyunify.one) is a developer-friendly API Library plugin to accept payments, instant transfers, split payments, send payouts, and manage your startup business easily. [**MoneyUnify**](http://moneyunify.one) allows you to easily Validate your ideas with confidence and supports mobile money payments for all network operators 🚀

- [Documentation for all programming languages](https://owk7kqf8sn.apidog.io/) can be accessed [HERE](https://owk7kqf8sn.apidog.io/)

---

## 💸 Example: Request a Payment

```js
fetch("http://api.moneyunify.one/payments/request", {
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
    "message": "Transaction Initiated Successfully",
    "data": {
        "status": "initiated",
        "amount": 1,
        "transaction_id": "sPX215101815432505",
        "charges": 0.035,
        "from_payer": "260971xxxxxxx"
    },
    "isError": false
}
```

---

## 🔍 Example: Verify a Payment

```js
fetch("http://api.moneyunify.one/payments/verify", {
  method: "POST",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded",
    "Accept": "application/json"
  },
  body: new URLSearchParams({
    transaction_id: "rp_vd89gdn10d1",
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
    "message": "Transaction processed Successfully",
    "data": {
        "status": "successful",
        "amount": "1.00",
        "transaction_id": "LP101815411535505",
        "charges": "0.04",
        "from_payer": "26097xxxxxxx"
    },
    "isError": false
}
```

### Other examples
Find more examples for different programming languages [here](https://owk7kqf8sn.apidog.io/)

---

**📘 Tip:**
Use your `auth_id` from your [MoneyUnify Businesses Dashboard](http://moneyunify.one/businesses) to authenticate all API calls.


---

## Conclusion

The MoneyUnify library simplifies the process of integrating with the Money Unify API. By following the steps outlined in this documentation, you can easily set up and make payment requests, verify transactions, and settle funds. For further assistance, feel free to reach out or check the official documentation for more advanced features.

---

# Built with a lot of ❤ by;

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