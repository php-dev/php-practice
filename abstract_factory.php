<?php 
/*
switch ($etfType) {
  case ETF_VIRTUALCHECK :
    $etf = new VirtualCheck();
  $etf->processCheck();
  break;
  case ETF_CREDITCARD :
    $etf = new CreditCard();
  $etf->chargeCard();
  break;
  case ETF_WIRETRANSFER :
    $etf = new WireTransfer();
  $etf->chargeCard();
  break;
}
//Read more at http://www.devshed.com/c/a/PHP/Design-Patterns-in-PHP-Factory-Method-and-Abstract-Factory/1/#sKgeCmLSMzI4B5KQ.99
*/

    class ETF {
      var $data;
      function ETF($data) {
        $this->data = $data;
      }
      function process() {}
      function getResult() {}
    }

    class VirtualCheck extends ETF {}
    class WireTransfer extends ETF {}

    class ETFFactory {
      function createETF($data) {
          switch ($data['etfType']) {
          case ETF_VIRTUALCHECK :
            return new VirtualCheck($data);;
          case ETF_WIRETRANSFER :
            return new WireTransfer($data);
          default :
            return new ETF($data);
          }
      }
    }

    $data = $_POST;
    $etf = ETFFactory::createETF($data);
    $etf->process();

//Read more at http://www.devshed.com/c/a/PHP/Design-Patterns-in-PHP-Factory-Method-and-Abstract-Factory/1/#sKgeCmLSMzI4B5KQ.99
