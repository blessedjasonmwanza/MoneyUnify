<?php
/**
 * MoneyUnify blue Print
 * @category Payments
 * @package  MoneyUnify
 * @author   Blessed Jason Mwanza <mwanzabj@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @link     https://github.com/blessedjasonmwanza/MoneyUnify
 */
interface MU {
  /**
   * Collection of funds from clients/users
   */
  public function collect(): Array;
  /**
   * Withdrawing of cash from merchant account
   */
  public function disburse(): Array;
  /**
   * Check merchant account balance
   */
  public function balance(): Array;
  /**
   * Set details for making collection request
  */
  public function setCollectionDetails(Array $transaction_details): void;
  /**
   * Set details for making a withdraw transaction 
   * from merchant account
   */
  public function setDisbursementDetails(Array $transaction_details): void;
}

?>