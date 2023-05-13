<?php
/**
 * MoneyUnify Configurations
 * @category Payments
 * @package  MoneyUnify
 * @author   Blessed Jason Mwanza <mwanzabj@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @link     https://github.com/blessedjasonmwanza/MoneyUnify
 */

class Configurations {
  /**
   * Indicate wether API is running in Sandbox, live, test mode, e.t.c (based on provider documentation)
   *  */ 
  protected String $mode;
  /**
   * API private key
   */
  protected String $private_key;
  /**
   * API public key
   */
  protected String $public_key;
  /** 
   * link to verify payment -  used by: [sparco]
   * */ 
   protected String $payment_verification_url;
  /** 
   * Link to make collection request - currently used by: [sparco]
   * */ 
  protected String $debit_collection_url;
  /**
   * Link to send/disburse money to - currently used by: [Sparco]
   */
  protected String $credit_disbursement_url;
   /**
    * International accepted Currency UNIT to use during transaction - defaults to Zambian Kwacha (ZMW)
    */
  protected String $currency = 'ZMW';

  /**
   * http request header parameters
   */
   protected Array $request_headers;
  /**
   * debit/collection details
   */
  protected Array $collection_details;

  /**
   * credit/disbusements/sending details
   */
  protected Array $disbursement_details;

}
