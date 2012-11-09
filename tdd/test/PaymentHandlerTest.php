<?php
//Testing code is not written

require_once('simpletest/autorun.php');
require_once('../src/SmsHandler.php');

class SmsHandlerTest extends UnitTestCase {
	
function testNumberToTelco() {
	$numbers = array(
		0 => array(
			'number' => 9841374040,
			'expected' => 2,
		),
		1 => array(
			'number' => 9803000000,
			'expected' => 2,
		),
		2 => array(
			'number' => 985100000,
			'expected' => 1,
		),
		3 => array(
			'number' => 98012345,
			'expected' => 2,
		),
	);
	//$to = 9841374040;
	
	$smsHandler = new Acetravel_SmsHandler();
	
	//$smsHandler->getServiceProviderByNumber($to);
	
	foreach ($numbers as $mobile) {
		$output = $smsHandler->getServiceProviderByNumber($mobile['number']);
		
		$this->assertEqual($output, $mobile['expected']);
	}
	
}

}
?>