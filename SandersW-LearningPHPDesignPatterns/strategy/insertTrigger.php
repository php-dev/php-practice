<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//insertTrigger.php
function __autoload($class_name)
{
include $class_name . '.php';
}
$trigger=new Client();
$trigger->insertData();
?>