<?php
class Acetravel_SmsHandler{

	function sendSms($to,$text,$date){
	  
	  //generates random num
	
	$to = 9841374040;
	$test =  uniqid();
	$date = date('Y-m-d H:i:s');
//	$service_provider = round(rand(0,1));
	$service_provider = $this->getServiceProviderByNumber($to);
	
	//extract data from the post
	extract($_POST);
	
	$url = 'http://saptakoshi.f1soft.com.np/handlesms.php';
	$fields = array(
			'mobile_no' => urlencode($to),
			'text' => urlencode($test),
			'date' => urlencode($date),
			'service_provider' => urlencode($service_provider),
			'password' => "f9e13b617ffd8095c3d5b651f62bb3f8"
			);
	
	//url-ify the data for the POST 
	foreach($fields as $key=>$value) {
		$fields[$key] = $key.'='.$value;
	}
	$fields_string = implode('&', $fields);
	rtrim($fields_string,'&');
	print_r($fields_string);
	print "\n";
	//open connection 
	$ch = curl_init();
	//set the url, number of POST vars, POST data 
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_POST,count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	//execute post 
	$result = curl_exec($ch);
	print $result;
	//close connection 
	curl_close($ch);
	
	//call sleep for 10 seconds
	/* sleep(2);
	
	for validation
	
	$tbl='';
	$server		=	"localhost";
	$username	=	"root";
	$password	=	"";
	$table_name	=	"tbl_sms_out";
	$dbname		=	"acetravel";
	mysql_connect($server, $username, $password) or die("Error in connection") or die('Cannot make connection');
	mysql_select_db($dbname);
	$query = "select * from $table_name where sms = '$test'";
	$exec = mysql_query($query);
	$op = mysql_fetch_array($exec);
	print_r($fields);
	print_r($op);
	
	if($op['mobile_no'] == $to){
		echo "test successful for to\n";
	}
	else{
		echo "test faliure for to\n";
	}
	if($op['sms'] == $test){
		echo "test successful for sms data\n";
	}
	else{
		echo "test faliure for sms data\n";
	}
	if($op['sent_date'] == $date){
		echo "test successful for sent date\n";
	}
	else{
		echo "test faliure for sent date\n";
	}
	if($op['service_provider'] == $service_provider){
		echo "test successful for service_provider\n";
	}
	else{
		echo "test faliure for service_provider\n";
	}*/
	
  }
	function getServiceProviderByNumber($to){
		
	 if(preg_match('/^984/' , $to) || preg_match('/^985/' , $to)){
        $service_provider    =    '1';
      }        
      else if(preg_match('/^980/' , $to) || preg_match('/^981/' , $to)){
        $service_provider    =    '2';
      }    
	  return  $service_provider;
  }
	
  function receiveSms($to, $text, $received_date){
		$query_sms_in	=	mysql_query("INSERT INTO `tbl_sms_in`(`mobile_no`, `sms`, `status`, `received_date`, `service_provider`) 
										 VALUES ($to, $text, 0, $received_date, $service_provider)");
		$this->process();
  }
	
  function process(){
	$query	=	mysql_query("SELECT * FROM `tbl_sms_in` 
					 WHERE `status` = '0'");
	while($row_sms	=	mysql_fetch_array($query)){
		if(strtolower(trim($row_sms['sms'])) == 'support'){
			$sms_out	=	"Currently we have launched online payment system throught esewa. Please, register in our website http://acetravels.com to get full access of payment features.";
			}
		$this->sendSms($row_sms['mobile_no'], $sms_out, $today);
			/*$insert_out		=	mysql_query("INSERT INTO `tbl_sms_out` SET `sms` = '".$sms_out."', `mobile_no` = '".$row_sms['mobile_no']."', `status` = '1', `sent_date` = '".$today."', `service_provider` = '".$row_sms['service_provider']."', `receive_id` = '".$row_sms['id']."'");	*/
		if($insert_out){
			$update	=	mysql_query("UPDATE `tbl_sms_in` SET `status` = '1' 
										 WHERE `id` = '".$row_sms['id']."'");
		}
	  }
  }
	
}



?>