<?php
use \Firebase\JWT\JWT;

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
class Sparco extends Configurations implements MU{
  use Http;

  function __construct(Array $config){
    foreach ($config as $key => $value) {
      $this->$key = $value;
    }
    $this->debit_collection_url = "https://".$this->mode.".sparco.io/gateway/api/v1/momo/debit";
    $this->payment_verification_url = "https://".$this->mode.".sparco.io/gateway/api/v1/transaction/query?reference=";
    $this->credit_disbursement_url = "https://".$this->mode.".sparco.io/gateway/api/v1/momo/credit";
  }
  

  public function setCollectionDetails(Array $transaction_details): void{
    foreach ($transaction_details as $key => $value) {
      $this->collection_details[$key] = $value;
    }
    
  }

  public function setDisbursementDetails(Array $transaction_details): void{
    foreach ($transaction_details as $key => $value) {
      $this->disbursement_details[$key] = $value;
    }
  }

  public function collect(): Array {
    $transaction_reference = $this->collection_details['customer_mobile_number'].'_'.time();
    $payload_fields = array(
      "amount"=> $this->collection_details['amount'],
      "currency"=> "$this->currency",
      "customerFirstName"=> $this->collection_details['customer_first_name'],
      "customerLastName"=> $this->collection_details['customer_last_name'],
      "customerEmail"=> $this->collection_details['customer_email'],
      "merchantPublicKey"=> $this->public_key,
      "transactionName"=> $this->collection_details['purchase_info'],
      "transactionReference"=> $transaction_reference,
      "wallet"=> $this->collection_details['customer_mobile_number'],
    );
    
    $payload = JWT::encode($payload_fields, $this->private_key, 'HS256');
    $request_body_fields = '{
        "payload":"'.$payload.'"
    }';
    $request_headers = array(
        'X-PUB-KEY: '.$this->public_key,
        'Content-Type: application/json'
    );
    return json_decode($this->urlRequest("POST", $this->debit_collection_url, $request_headers, $request_body_fields), true);
  }
  
  public function disburse(): Array {
    $transaction_reference = $this->disbursement_details['destination_mobile_number'].'_'.time();
    $payload_fields = array(
      "amount"=> $this->disbursement_details['amount'],
      "currency"=> "$this->currency",
      "customerFirstName"=> $this->disbursement_details['destination_first_name'],
      "customerLastName"=> $this->disbursement_details['destination_last_name'],
      "customerEmail"=> $this->disbursement_details['destination_email'],
      "merchantPublicKey"=> $this->public_key,
      "transactionName"=> $this->disbursement_details['transfer_description'],
      "transactionReference"=> $transaction_reference,
      "wallet"=> $this->disbursement_details['destination_mobile_number'],
    );
    
    $payload = JWT::encode($payload_fields, $this->private_key, 'HS256');
    $request_body_fields = '{
        "payload":"'.$payload.'"
    }';
    $request_headers = array(
        'X-PUB-KEY: '.$this->public_key,
        'Content-Type: application/json'
    );
    return json_decode($this->urlRequest("POST", $this->debit_collection_url, $request_headers, $request_body_fields), true);
  }
  public function balance(): Array{
    return []; //coming soon
  }
  public function verify_payment($reference){
    $request_headers = array(
        'token: '.$this->getToken()
    );
    return json_decode($this->urlRequest("GET", $this->payment_verification_url.$reference, $request_headers), true);
  }

  private function getToken(){
    $payload = array(
      "pubKey"=> "$this->public_key"
    );
    return JWT::encode($payload, $this->private_key, 'HS256');
  }
}
?>