<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Context
{
private $strategy;
public function __construct(IStrategy $strategy)
{
$this->strategy = $strategy;
}
public function algorithm()
{
$this->strategy->algorithm();
}
}
?>