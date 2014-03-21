<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('UniversalConnect.php');
class CreateTable
{
    private $tableMaster;
    private $hookup;
    public function __construct()
    {
    $this->tableMaster="proxyLog";
    $this->hookup=UniversalConnect::doConnect();
    $drop = "DROP TABLE IF EXISTS $this->tableMaster";
    if($this->hookup->query($drop) === true)
    {
    printf("Old table %s has been dropped.<br/>",$this->tableMaster);
    }
    echo $sql = "CREATE TABLE $this->tableMaster (uname NVARCHAR(15),
    pw NVARCHAR(120)"; die;
    print_r($this->hookup->query($sql)); die;
    if($this->hookup->query($sql) === true)
    {
    echo "Table $this->tableMaster has been created successfully.<br/>";
    }
    $this->hookup->close();
    }
}
    $worker=new CreateTable();
    
    
    /*
     * use proxy_practise;
CREATE TABLE IF NOT EXISTS `proxy_log` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uname` varchar(11) NOT NULL,
  `pw` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)  
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1;
     */