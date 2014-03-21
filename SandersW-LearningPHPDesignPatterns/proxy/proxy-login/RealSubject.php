<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('ISubject.php');
class RealSubject implements ISubject
{
public function request()
{
$practice=<<<REQUEST
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel='stylesheet' type='text/css' href='proxy.css' />
</head>
<body>
<header>PHP Tip Sheet:<br>
<span class='subhead'>For OOP Developers</span></header>
<ol>
<li>Program to the interface and not the implementation.</li>
<li>Encapsulate your objects.</li>
        <li>Favor composition over class inheritance.</li>
<li>A class should only have a single responsibility.</li>
</ol>
</body>
</html>
REQUEST;
echo $practice;
}
}
?>