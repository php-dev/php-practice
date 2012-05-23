<?php 

class Connect_Database {

	/**
	 * private variables
	 */
	private $user;
	private $password;
	private $database;
	private $server;

	
	/**
	 * public variables
	 */
	public $error;
	public $sql;
	public $result;
	
	
	/*
	 * this is a constructor, a function
	 * that loads when an object of a class is created
	 * here constructor initializes the database connectivity variables
	 */
	function __construct($server, $user, $password, $database) {
		
		$this->server 	= $server;
		$this->user 	= $user;
		$this->password = $password;
		$this->database = $database;
		
		
		if(!$this->connection = mysql_connect($this->server,$this->user,$this->password)) {
			throw new Exception('<font color="red">ERROR :: COULD NOT ESTABLISH A CONNECTION: '.mysql_error().'</font>', self::CONNECTION_ERROR);
		}else {	
			if(!mysql_select_db($this->database)) {
				throw new Exception('<font color="red">ERROR :: COULD NOT FIND A DATABASE : '.mysql_error().'</font>', self::CONNECTION_ERROR);
			}
		}
	}

}

?>