<?php
/**
 * MoneyUnify Core
 * @category Payments
 * @package  MoneyUnify
 * @author   Blessed Jason Mwanza <mwanzabj@gmail.com>
 * @license  http://opensource.org/licenses/MIT
 * @link     https://github.com/blessedjasonmwanza/MoneyUnify
 */

include __DIR__.'/Configurations.php';
include __DIR__.'/MU.php';
include __DIR__.'/../helpers/Http.php';
include __DIR__.'/../third-parties/php-jwt-6.5.0/src/JWT.php';
Class MoneyUnify{
  const PROVIDERS = [
    'sparco' => __DIR__.'/../providers/Sparco.php',
    'airtel' => __DIR__.'/../providers/Airtel.php',
  ];

  function __construct(private String $provider){
  }
  function config(Array $configurations): Object {
    include self::PROVIDERS[strtolower($this->provider)];
    return new $this->provider($configurations);
  }
}
?>