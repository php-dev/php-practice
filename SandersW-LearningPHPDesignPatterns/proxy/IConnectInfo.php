<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

interface IConnectInfo
{
const HOST ="localhost";
const UNAME ="root";
const PW ="anit";
const DBNAME = "proxy_practise";

public function doConnect();
}