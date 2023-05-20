<?php

/** FEATURE INFO
 * Deduct/accept instant payments from all Zambian Networks (ZAMTEL, AIRTEL, MTN)
 * 
 * MoneyUnify Sparco provider
 * @category Payments
 * @package  MoneyUnify
 * @author   Blessed Jason Mwanza <mwanzabj@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @link     https://github.com/blessedjasonmwanza/MoneyUnify
 *
 */
class Airtel extends Configurations implements MU{
  use Http;
  const MODES_BASE_URL = [
    'sandbox' => 'https://openapiuat.airtel.africa',
    'live' => 'https://openapi.airtel.africa'
  ];
  CONST GRANT_TYPE = 'client_secret_key';

  private String $access_token_url;

  function __construct(Array $config){
    foreach ($config as $key => $value) {
      $this->$key = $value;
    }
    $this->debit_collection_url = self::MODES_BASE_URL[$this->mode]."/merchant/v1/payments/";
    $this->access_token_url = self::MODES_BASE_URL[$this->mode].'/auth/oauth2/token';
    // $this->payment_verification_url = "https://".$this->mode;
    // $this->credit_disbursement_url = "https://".$this->mode;
    $this->setBearerToken();
  }


  public function setCollectionDetails(array $transaction_details): void
  {
    foreach ($transaction_details as $key => $value) {
      $this->collection_details[$key] = $value;
    }
  }

  public function setDisbursementDetails(array $transaction_details): void
  {
    foreach ($transaction_details as $key => $value) {
      $this->disbursement_details[$key] = $value;
    }
  }
  public function collect(): array{
    if($this->errors['isError']){
      return $this->errors;
    }
    $transaction_id = $this->collection_details['customer_mobile_number'].'_'.time();
    $transaction_country = $this->collection_details['transaction_country'] || $this->collection_details['subscriber_country'];
    $transaction_currency  = $this->collection_details['transaction_currency'] || $this->collection_details['subscriber_currency'];
    $headers = [
      "Content-Type" => "application/json",
      "X-Country" => $transaction_country,
      "X-Currency" => $transaction_currency,
      "Authorization" => "Bearer  ".$this->bearer_token,
    ];
    $request = json_decode($this->urlRequest("POST", $this->debit_collection_url, $headers, [
      'reference' => $this->collection_details['purchase_info'],
      "subscriber" => [
        "country" => $this->collection_details['subscriber_country'],
        "currency" => $this->collection_details['subscriber_currency'],
        "msisdn" => $this->collection_details['customer_mobile_number'],
      ],
      "transaction" => [
        "amount"=> floatval($this->collection_details['amount']),
        "country" => $transaction_country,
        "currency" => $transaction_currency,
        "id" => $transaction_id,
      ]
    ]));
    if($request['status']['success']){
      return array_merge([
        "isError" => false,
        "message" => $request['status']['message']
      ], $request);
    }else{
      return array_merge([
        "isError" => true,
        "message" => $request['status']['message']
      ], $request);
    }
    return [];
  }

  public function disburse(): array
  {
    return [];
  }

  public function balance(): array
  {
    return [];
  }

  private function setBearerToken():void{
    $headers = [
      'Content-Type' => 'application/json',
    ];
    $request = json_decode($this->urlRequest("POST", $this->access_token_url, $headers, [
      'client_id' => $this->public_key,
      'client_secret' => $this->private_key,
      'grant_type' => self::GRANT_TYPE,
    ]), true);
    if(!array_key_exists('error', $request)){
      $this->bearer_token = $request['access_token'];
    }else{
      $this->errors = [
        'isError' => true,
        "message" => $request['error'].' - '.$request['error_description']
      ];
    }
  }  
}