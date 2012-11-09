<?php 

if((isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    //var_dump($_POST);     
    print json_encode(array("firstName"=>'its-true'));
    
}


?>