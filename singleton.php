<?php
/**
 * @author anitshrestha.com.np
 * @package DatabaseConnection
 * @desc To display use of singleton programming pattern in php
 */

require_once("DB.php");

 class DatabaseConnection {
	
 private $_handle = null;

 //note : constructor is private
 private function __construct() {
    
    //$dsn = 'mysql://root:password@localhost/photos'; die;
    $user = "root";
	$password = "";
	$database= "db_pyrocms";
	$server = "localhost";
    $this->_handle =& DB::Connect($server,$user,$password, $database);
  }
  public static function get() {
    static $db = null;
    if ( $db == null )
      $db = new DatabaseConnection();
    return $db;
  }
  public function handle() {
    return $this->_handle;
  }
  
 
}//class close

print( "Handle = ".DatabaseConnection::get()->handle()."\n" );
//print( "Handle = ".DatabaseConnection::get()->handle()."\n" );
$db = DatabaseConnection::get()->handle();
//var_dump($db);
//echo $db->display_crud(); 
?>