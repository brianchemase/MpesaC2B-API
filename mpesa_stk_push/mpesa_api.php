<?php

     header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  date_default_timezone_set('Africa/Nairobi');

/* raw json data for post data
{
	"phone":"0725670606",
	"accref":"anything",
	"transdec":"Nairobi",
	"amount": "1"
}*/




  $json = file_get_contents('php://input');
 
  $data = json_decode($json);
 
   // print_r($data);

  $phone=$data->phone;//phone
  $AccountReference=$data->accref;
  $TransactionDesc=$data->transdec;
   $Amount=$data->amount;
  $combined=$phone.$AccountReference.$TransactionDesc.$Amount;
  
  	$myfile = fopen("logs.txt", "a") or die("Unable to open file!");
	fwrite($myfile, "\n".  $combined);
	fclose($myfile);
   /*
    $phone="0725670606";
   $Amount="1";
   $AccountReference='anything1';
   $TransactionDesc="anything1";
 */


   // $phone=$_POST['phone'];
   // $AccountReference=$_POST['accno'];
  //  $TransactionDesc=$_POST['tdesc'];
  //  $Amount=$_POST['amount'];
    
    $length=strlen($phone);
      if ($length==10)
          {
          $tel= substr($phone, 1);
              $code="254";
              $PartyA = $code.$tel;
          //echo $to;
          }
      elseif($length<=8)
          {
          $to=$phone;
          echo "invalid phone";
          //echo $to;
          }
      elseif($length >=11)
          {
          $PartyA=$phone;
          //echo $to;
          }
    
    
  

  # access token
  $consumerKey = 'WHAmIsf1F4OU7JyOdm2n6GEO9TXSPYI7'; //Fill with your app Consumer Key
  $consumerSecret = 'dWJLt0QF1Wu334Hb'; // Fill with your app Secret

  # define the variales
  # provide the following details, this part is found on your test credentials on the developer account
  $BusinessShortCode = '174379';
  $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';  
  
  /*
    This are your info, for
    $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
    $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
    TransactionDesc can be anything, probably a better description of or the transaction
    $Amount this is the total invoiced amount, Any amount here will be 
    actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
    for developer/test accounts, this money will be reversed automatically by midnight.
  */
  
  // $PartyA = '254704170146'; // This is your phone number, 
  //$AccountReference = 'GURUSNATION';
  //$TransactionDesc = 'STAY SAFE DURING COVID';
  //$Amount = '1';
 
  # Get the timestamp, format YYYYmmddhms -> 20181004151020
  $Timestamp = date('YmdHis');    
  
  # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
  $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);

  # header for access token
  $headers = ['Content-Type:application/json; charset=utf8'];

    # M-PESA endpoint urls
  $access_token_url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

  # callback url
  $CallBackURL = 'https://briananikayi.io.ke/projects/mpesa/call_back.php';  

  $curl = curl_init($access_token_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($curl, CURLOPT_HEADER, FALSE);
  curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
  $result = curl_exec($curl);
  $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
  $result = json_decode($result);
  $access_token = $result->access_token;  
  curl_close($curl);

  # header for stk push
  $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];

  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $initiate_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header

  $curl_post_data = array(
    //Fill in the request parameters with valid values
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'TransactionType' => 'CustomerPayBillOnline',
    'Amount' => $Amount,
    'PartyA' => $PartyA,
    'PartyB' => $BusinessShortCode,
    'PhoneNumber' => $PartyA,
    'CallBackURL' => $CallBackURL,
    'AccountReference' => $AccountReference,
    'TransactionDesc' => $TransactionDesc
  );

  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  print_r($curl_response);

  echo $curl_response;
  
  /*echo"
				<script>alert('Payment prompt Send to ".$phone." Check your phone to confirm')</script>
			    
				<script>window.location = 'index.php'</script>
				";*/
?>