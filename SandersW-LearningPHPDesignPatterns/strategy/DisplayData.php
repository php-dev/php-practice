<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DisplayData implements IStrategy
{
public function algorithm()
{
$hookup=UniversalConnect::doConnect();
$test = "Here's all the data!!";
echo $test . "<br/>";
}
}
?>