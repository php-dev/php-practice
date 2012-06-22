<?php
$headers = array(             
        "Content-type: text/xml;charset=\"utf-8\"", 
        "Accept: text/xml", 
        "Cache-Control: no-cache", 
        "Pragma: no-cache", 
        "SOAPAction: \"run\""
    ); 
$url = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20upcoming.events%20where%20woeid%20in%20(select%20woeid%20from%20geo.places%20where%20text%3D%22North%20Beach%22)%20%7C%20sort(field%3D%22start_date%22)%20%7C%20truncate(count%3D1)&diagnostics=true&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
$soap_do = curl_init(); 
curl_setopt($soap_do, CURLOPT_URL,            $url );   
curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10); 
curl_setopt($soap_do, CURLOPT_TIMEOUT,        10); 
curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);  
curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false); 

//curl_setopt($soap_do, CURLOPT_POSTFIELDS,    $post_string); 
curl_setopt($soap_do, CURLOPT_HTTPHEADER,  $headers);   
curl_setopt($soap_do, CURLOPT_USERPWD, 'pician_friend@yahoo.com' . ":" . "p!(i@n");

$result = curl_exec($soap_do);
$err = curl_error($soap_do);
//var_dump($result);

$dom = new DOMDocument;
$dom->loadXML($result);


?>