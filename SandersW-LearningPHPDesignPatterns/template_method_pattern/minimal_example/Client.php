<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function __autoload($class_name) {
	include $class_name . '.php';
}

class Client {

	function __construct() {
		$caption="Modigliani painted elongated faces.";

		$mo=new ConcreteClass();
		$mo->templateMethod("genious.jpg", $caption);
	}
}

$worker=new Client();
?>