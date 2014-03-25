<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DataEntry implements IStrategy
//DataEntry.php
{
public function algorithm(){
$hookup=UniversalConnect::doConnect();
$test = $hookup->real_escape_string($_POST['data']);
echo "This data has been entered: " . $test . "<br/>";
}
}
?>