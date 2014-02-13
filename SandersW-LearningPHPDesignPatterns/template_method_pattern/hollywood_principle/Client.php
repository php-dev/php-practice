<?php
//Client.php
function __autoload($class_name) {
	include $class_name . '.php';
}

class Client {

	function __construct() {
		$mo=new TmFac();
		$mo->templateMethod();
	}
}

$worker=new Client();
?>