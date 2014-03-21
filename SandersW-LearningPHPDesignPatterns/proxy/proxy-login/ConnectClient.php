<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('UniversalConnect.php');
class ConnectClient
{
private $hookup;
public function __construct()
{
//One line for entire connection operation
$this->hookup=UniversalConnect::doConnect();
}
}
$worker=new ConnectClient();