<?php
/**
 * How do you declare a function or method that you want to be accessed without instantiate the class?
 * - By defining function static 
 */


Class AccessSpecifiers {

	public static function testStatic() {
			return false;
	}
}

/**
 * How do you create a child class of BaseClass ?
 * - Through inheritence using keyword extends
 */
Class MyParent {}

Class Son extends MyParent {}

/**
 * Please write a conditional block of code that
 * check if the variable $var exists, is not null
 * and it's a number.
 */
Class TestVar {

	public static $var;

	public static function checkVar($var) {
		self::$var = $var;
		if (property_exists(__CLASS__,'var') &&
						!is_null(self::$var) &&
						is_int(self::$var)) {
			echo self::$var;
		} else {
			echo 'undefined var';
		}
	}
}
//TestVar::checkVar(10);

/**
 * Write a function that adds a line to a log file
 * the current date and time with this format:
 * "[2013-09-23 00:30:15] - Status OK"
 */
Class LogString {
	
	private $__var;

	public function __construct() {
		error_log("[".date("Y-m-d H:i:s")."] - Status OK", 3, "error.log");
	}
}

$obj = new LogString();

/**
 * Which is the default path where you set up the 
 * configuration for the database?
 * /project/app/Config/database.php
 */

/**
 * How you can get the value of a session variable
 * with key "foo" using CakePHP ?
 * $this->Session->read('foo');
 */

