<?php 

class DB {

	/**
	 * private variables
	 */
	private $user;
	private $password;
	private $database;
	private $server;
	
	private $_handle = NULL;
	
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
	/*
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
	*/
	
	function Connect($server, $user, $password, $database) {
		
		$this->server 	= $server;
		$this->user 	= $user;
		$this->password = $password;
		$this->database = $database;
		
		
		if(!$this->connection = mysql_connect($this->server,$this->user,$this->password,$this->database)) {
			throw new Exception('<font color="red">ERROR :: COULD NOT ESTABLISH A CONNECTION: '.mysql_error().'</font>', self::CONNECTION_ERROR);
		}else {	
			if(!mysql_select_db($this->database)) {
				throw new Exception('<font color="red">ERROR :: COULD NOT FIND A DATABASE : '.mysql_error().'</font>', self::CONNECTION_ERROR);
			}else return mysql_select_db($this->database);
		}
	}
	
	  private function __construct($server,$user,$password, $database) {
	    
	    //$dsn = 'mysql://root:password@localhost/photos'; die;	    
	    $this->_handle =& DB::Connect($server,$user,$password, $database);
	  }
	  
	  public static function get() {
	  	$user = "root";
		$password = "";
		$database= "db_pyrocms";
		$server = "localhost";
		
	    static $db = null;
	    if ( $db == null )
	      $db = new DB($server,$user,$password, $database);
	    return $db;
	  }
	  
	  public function handle() {
	    echo $this->_handle;
	  }
	  function __destruct(){}
}

?>