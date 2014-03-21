<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once('UniversalConnect.php');
class HashRegister
{
public function __construct()
{
$this->tableMaster="proxy_log";
$this->hookup=UniversalConnect::doConnect();
$username=$this->hookup->real_escape_string(trim($_POST['uname']));
$pwNow=$this->hookup->real_escape_string(trim($_POST['pw']));
$sql = "INSERT INTO $this->tableMaster (uname,pw) VALUES ('$username',
md5('$pwNow'))";
if($this->hookup->query($sql))
{
echo "Registration completed:";
}
elseif ( ($result = $this->hookup->query($sql))===false )
{
printf("Invalid query: %s <br/> Whole query: %s <br/>",
        $this->hookup->error, $sql);
exit();
}
$this->hookup->close();
}
}
$worker=new HashRegister();
?>