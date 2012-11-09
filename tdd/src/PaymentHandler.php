<?php
/*
Backend ePayment System

a. PaymentGateway (base class) //this iwill be done in the Tasks
Contains following functions
- createPayment()
- cancelPayment()
- confirmPayment()-> will insert the booking data in table; will send the Emails
- 


b. Payment Handler
- Initiates the payment status as on process
- Checks what user has selected as preferred payment procedure
- Calls the payment gateway to initiate its process for payment
In case its eSewa, the EsewaPaymentGateway object is instantiated and payment is forwarded to it.
In case its OfflinePayment, the OfflinePaymentGateway object is instantiated and payment is forwarded to it.
...

Test Cases
Both Payment Handler and PaymentGateways should come with their test cases. Preferrably in SimpleTest.
*/

/*
	Tasks that are being done in the old payment system:
	1. checks the session.
	2. checks what type of user it is.
	3. insert bookign enquery into tbl_trip_booking.
	4. sending emails (1. to the customer 2. to the administrator)
	
	
*/	

interface  IDoc{
  function createPayment();
  //function cancelPayment();
  //function confirmPayment();
}


class PaymentGateway implements IDoc {
  
  function createPayment() {
  		@session_start();
		$user_type	=	$_SESSION['ses_user_type'];
		$user_id	=	$_SESSION['ses_user_id'];
		$pickup_date	=	date('Y-m-d',strtotime($_POST['pickup-date-res']));
		$dropoff_date	=	date('Y-m-d',strtotime($_POST['dropoff-date-res']));
		$today =	getCurrentDate();
		$date_flight	=	date('Y-m-d',strtotime($_POST['day_flight']));
		
		//Get the registered users detail 
		if($user_type == '1'){
			$result_users	=	mysql_query("SELECT * FROM `tbl_agents` 
										 WHERE `agent_id` = '".$user_id."'");
		}
		else if($user_type == '2'){
			$result_users	=	mysql_query("SELECT * FROM `tbl_users` 
										 WHERE `user_id` = '".$user_id."'");
		}
		$row_users			=	mysql_fetch_array($result_users);
		//End
		
		
		if(is_array($_POST['extend_trip']))
			$extend_trip	=	implode(',',$_POST['extend_trip']);
		
		$to_check = trim($_REQUEST['trip_security_code_package']);
		
		$previous_page	=	$_SERVER['HTTP_REFERER'];
		
			$result_pack	=	mysql_query("SELECT * FROM `tbl_package_price` WHERE `package_id` = '".$_POST['package_id']."'");
			$row_pack		=	mysql_fetch_array($result_pack);
			
			if($_POST['price_type'] == 'budget')
				$single_price	=	$row_pack['budget'];
			else if($_POST['price_type'] == 'standard')
				$single_price	=	$row_pack['standard'];
			else if($_POST['price_type'] == 'deluxe')
				$single_price	=	$row_pack['deluxe'];
			else 
				$single_price	=	'0';
				
			if($_POST['no_travellers']=='1'){
				$query_add_cost	=	mysql_query("SELECT `charge_in_per`, `charge_type` FROM `tbl_additonal_cost`
												 WHERE `range_from` = '1'");			
			}
			else{
				$query_add_cost	=	mysql_query("SELECT `charge_in_per`, `charge_type` FROM `tbl_additonal_cost`
												 WHERE `range_from` <= '".$_POST['no_travellers']."' && `range_to`>= '".$_POST['no_travellers']."'");	
			}
			$row_add_cost	=	mysql_fetch_array($query_add_cost);
			if($row_add_cost['charge_type'] =='0'){
				$final_price	=	$single_price - ($single_price)*($row_add_cost['charge_in_per']/100);	
			}
			else if($row_add_cost['charge_type'] =='1'){
				$final_price	=	$single_price + ($single_price)*($row_add_cost['charge_in_per']/100);
			}
			else{
				$final_price	=	$single_price;
			}
			
			$total_price	=	$final_price*$_POST['no_travellers'];
			$advance		=	$total_price*ADVANCE_PERCENTAGE;
			
			$booking_query	=	"INSERT INTO `tbl_trip_booking` (
			`trip_id` ,
			`user_id`,
			`user_type`,
			`category` ,
			`cost` ,
			`due_amount`,
			`depart_date` ,
			`return_date` ,
			`no_travellers`,	
			`extend_trip` ,
			`user_name` ,
			`email_address` ,	
			`contact_no` ,	
			`country` ,
			`address`,
			`comment` ,
			`added_date`
			)
			VALUES (
			'".insertFormatter($_POST['package_id'])."', '".$user_id."', '".$user_type."', '".insertFormatter($_POST['category_name'])."', '".$total_price."' , '".$total_price."', '".date('Y-m-d',strtotime($_POST['depart_date']))."', '".date('Y-m-d',strtotime($_POST['return_date']))."', '".insertFormatter($_POST['no_travellers'])."', '".$extend_trip."', '".$row_users['first_name']." ".$row_users['last_name']."', '".$row_users['email_address']."', '".$row_users['phone_num']."', '".$row_users['country_id']."', '".$row_users['address']."', '".insertFormatter($_POST['comment'])."', '".$today."'
			)
			";
									
			$row_query		=	mysql_query($booking_query) or die("Error:". mysql_error());
			$order	=	mysql_insert_id();
			
			if(strlen($order) =='1')
				$order_id	=	"0000".$order;
			else if(strlen($order) =='2')
				$order_id	=	"000".$order;
			else if(strlen($order) =='3')
				$order_id	=	"00".$order;
			else if(strlen($order) =='4')
				$order_id	=	"0".$order;
			else
				$order_id	=	$order;
			
			
				if(isset($extend_trip) && $extend_trip!=''){
					$extend	=	"<tr>
									<td>Extend trip :</td>
									<td>  ".$extend_trip."</td>
								</tr>";
				}
				
				$message="
				<table width='100%' cellspacing='2' cellpadding='2'>
					<tr>
						<td colspan='2'>Here are the details of booking of the trip:</td>
					</tr>
					<tr>
						<td width='25%'>Trip Code :</td>
						<td> ".$_POST['trip_code']."</td>
					</tr>
					<tr>
						<td>Trip Name  :</td>
						<td>".$_POST['trip_name']."</td>
					</tr>
					<tr>
						<td>Trip Cateogry  :</td>
						<td>".$_POST['category_name']."</td>
					</tr>
					<tr>
						<td>
							Departure Date :
						</td>
						<td> ".$_POST['depart_date']."</td>
					</tr>
					<tr>
						<td>
							Return Date :
						</td>
						<td> ".$_POST['return_date']."</td>
					</tr>
					
					<tr>
						<td>Full Name :</td>
						<td>".$row_users['first_name']." ".$row_users['last_name']."</td>
					</tr>
					
					<tr>
						<td>Email :</td>
						<td>  ".$row_users['email_address']."</td>
					</tr>
					
					<tr>
						<td>Contact no. :</td>
						<td> ".$row_users['phone_num']."</td>
					</tr>	
					
					<tr>
						<td>Country :</td>
						<td>  ".getCountryName($row_users['country_id'])."</td>
					</tr>
					<tr>
						<td>Address :</td>
						<td>  ".$row_users['address']."</td>
					</tr>		
					".$extend."		
					<tr>
						<td>Additional Info: </td>
						<td>  ".$_POST['comment']."</td>
					</tr>
					<tr>
						<td colspan='2'>
					
						Thank you<br />".SITE_NAME."
						</td>
					</tr>
				</table>";
				
				$message_user="
				<table width='100%' cellspacing='2' cellpadding='2'>
					<tr>
						<td colspan='2'>Your booking details have been posted successfully. Following are the details:</td>
					</tr>
					<tr>
						<td width='25%'>Trip Code :</td>
						<td> ".$_POST['trip_code']."</td>
					</tr>
					<tr>
						<td>Trip Name  :</td>
						<td>".$_POST['trip_name']."</td>
					</tr>
					<tr>
						<td>Trip Cateogry  :</td>
						<td>".$_POST['category_name']."</td>
					</tr>
					<tr>
						<td>
							Departure Date :
						</td>
						<td> ".$_POST['depart_date']."</td>
					</tr>
					<tr>
						<td>
							Return Date :
						</td>
						<td> ".$_POST['return_date']."</td>
					</tr>
					".$extend."		
					<tr>
						<td>Additional Info: </td>
						<td>  ".$_POST['comment']."</td>
					</tr>
					<tr>
						<td colspan='2'>
					
						Thank you<br />".SITE_NAME."
						</td>
					</tr>
				</table>";
				
				
				$fileContents = file_get_contents("email.html");
				$res=str_replace("#PATH#",SITE_PATH,$fileContents);
				$res1=str_replace("#LOGO#","<img src='".SITE_PATH."/images/logo.jpg' style='border:none;'>",$res);
				$res1=str_replace("#FOOTER#","",$res1);
				$content=str_replace("#CONTENT#",$message,$res1);	
				$content_user=str_replace("#CONTENT#",$message_user,$res1);	
				$to_admin	=	SendMail($row_users['first_name']." ".$row_users['last_name'],"New Trip Booking", $content, $row_users['email_address'], ADMIN_EMAIL,"");
				$to_user	=	SendMail(ADMIN_NAME,"New Trip Booking", $content_user, ADMIN_EMAIL , $row_users['email_address'],""); 
?>
				
				<h1>Order Detail - <?php echo $_POST['trip_name']; ?></h1>
				
		<table id="payment-table" width="500" cellpadding="0" cellspacing="0" border="0">
			<tr>
				<td width="200">Package Name</td>
				<td>:</td>
				<td width="290"><?php echo $_POST['trip_name']; ?></td>
			</tr>
			<tr>
				<td>Number of travelers</td>
				<td>:</td>
				<td><?php echo $_POST['no_travellers']; ?></td>
			</tr>
			<tr>
				<td>Package Price</td>
				<td>:</td>
				<td><?php echo $single_price; ?> [ <?php echo strtoupper($_POST['price_type']); ?>]</td>
			</tr>
			<?php
			if($row_add_cost['charge_type'] =='0'){
			?>
			<tr>
				<td>Discount Price</td>
				<td>:</td>
				<td><?php echo $final_price; ?></td>
			</tr>
			<?php
			}
			if($row_add_cost['charge_type'] =='1'){
			?>
			<tr>
				<td>Additional charge Price</td>
				<td>:</td>
				<td><?php echo $final_price; ?></td>
			</tr>
			<?php
			}
			?>
			<tr>
				<td>Total Price</td>
				<td>:</td>
				<td><?php echo $total_price; ?></td>
			</tr>
			<tr>
				<td>Advance Price(<?php echo ADVANCE_PERCENTAGE*100;?>%)</td>
				<td>:</td>
				<td><?php echo $advance; ?>
				</td>
			</tr>		
		</table>
		   
<?php
  }
   
   //function cancelPayment(){ }
   //function confirmPayment(){}	
}

class Esewa extends PaymentGateway 
{
  function toPaymentGateway(){
?>	
		<p>Now you are forwarding for the payment of your order. ...........<br><br><br>
	 You should pay 20% in advance. There is also an option of <b>full payment</b>.<br><br>Terms and Conditions ....................<br><br> Please choose payment option: <input type="radio" name="payment" value="advance" checked="checked" onClick="changePrice('advance')">Advance Payment&nbsp;&nbsp;&nbsp;<input type="radio" name="payment" value="full" onClick="changePrice('full')">Full Payment<br><br>
	<input type="button" name="proceed" value="PROCEED TO PAYMENT" onClick="submitPaymentForm()"><input type="button" name="cancel" value="CANCEL PAYMENT" onClick="confirmation()">
	</p>
	<form name="payment" id="payment" method="post" action="http://esewa.f1dev.com/epay/main">
	<div style="display:none;">
	<input size="40" name="tAmt" id="tAmt" type="text" value="<?php echo $advance ?>">
	<input size="40" name="amt" id="amt" type="text" value="<?php echo $advance ?>">
	<input size="40" name="txAmt" value="0" type="text">
	<input value="0" size="40" name="psc" type="text">
	<input value="0" size="40" name="pdc" type="text">
	<input value="acetravels" size="40" name="scd" type="text">
	<input value="<?php echo $order_id; ?>" size="40" name="pid" type="text">
	<input size="80" value="<?php echo SITE_PATH; ?>/esewa/thanku.php?page=payment_result" name="su" type="text">
	<input size="80" value="<?php echo SITE_PATH; ?>/esewa/thanku.php?page=sorry" name="fu" type="text">
	</div>
	</form>

<?php 
  }
}

class PaymentHandler
{
   function create($paymentType) {
      switch($paymentType) {
         case 'Esewa' :
            $doctype = new Esewa();
            break;
         case 'other' :
            $doctype = new Other();
            break;
         default:
            $doctype = new Esewa();
      }
      return $doctype;
   }
}
//user selects the payment gateway.
//the code below is yet to be implemented.
//$paymentType = $_POST['paymentType'];

$gatemaker = new PaymentHandler();
$gateobj = $gatemaker -> create($paymentType);
$gateobj -> createPayment(); 
$gateobj -> toPaymentGateway();

?>

<script type="text/javascript">
  function changePrice(type){
	if(type == 'full'){	
		$("#tAmt").val('<?php echo $total_price;?>');
		$("#amt").val('<?php echo $total_price;?>');
	}
	if(type == 'advance'){
		$("#tAmt").val('<?php echo $advance;?>');
		$("#amt").val('<?php echo $advance;?>');
	}
  }
	
  function submitPaymentForm(){
	$('#payment').submit();
  }
  
  function confirmation() {
	var answer = confirm("Confirm cancel payment.")
	if (answer){
		alert("Your payment has been cancelled.")
		window.location="<?php echo $_SERVER['HTTP_REFERER'];?>";
	}
  }
</script>




