<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Client
{
public function insertData()
{
$context=new Context(new DataEntry());
$context->algorithm();
}
public function findData()
{
$context=new Context(new SearchData());
$context->algorithm();
}
public function showAll()
{
$context=new Context(new DisplayData());
$context->algorithm();
}
public function changeData()
{
$context=new Context(new UpdateData());
$context->algorithm();
}
public function killer()
{
$context=new Context(new DeleteRecord());
$context->algorithm();
}
}
?>