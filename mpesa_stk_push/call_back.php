<?php
  $stkCallbackResponse = file_get_contents('php://input');
  
  $conn=mysqli_connect("localhost", "brianani_brian", "5131brian07", "brianani_db");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
	
	
	   // $data = json_decode($josndata);
	      $data = json_decode($stkCallbackResponse);
		  $singledata = $data->Body->stkCallback->ResultCode;
		  $resultcode = $data->Body->stkCallback->ResultCode;// result codes
		  $respocemessage = $data->Body->stkCallback->ResultDesc;//responce message
		  $amount=$data->Body->stkCallback->CallbackMetadata->Item[0]->Value;//amount paid by the client
		  $MpesaReceiptNumber=$data->Body->stkCallback->CallbackMetadata->Item[1]->Value;//mpesa no from line 21
		  $TransactionDate=$data->Body->stkCallback->CallbackMetadata->Item[3]->Value;//from line 28
		  $PhoneNumber=$data->Body->stkCallback->CallbackMetadata->Item[4]->Value;// from line 32
			
	//	echo $resultcode.'</br>';
	//	echo $respocemessage.'</br>';
	//	echo $singledata.'</br>';
	 //	echo $amount.'</br>';
	 //	echo $MpesaReceiptNumber.'</br>';
  	//	echo $TransactionDate.'</br>';
  	//	echo $PhoneNumber.'</br>';
	//echo $data.'</br>';


    if ($resultcode== '0') {
		mysqli_query($conn, "INSERT INTO `responce` VALUES('', '$resultcode','$respocemessage', '$amount', '$MpesaReceiptNumber', '$TransactionDate', '$PhoneNumber' )") or die(mysqli_error());


		echo"
				<script>alert('Entry registered successfully')</script>
				
				
				";


		//header('location: bold.php');
		}
		else
		{
			mysqli_query($conn, "INSERT INTO `responce` VALUES('', '$resultcode','$respocemessage', '', '', '', '' )") or die(mysqli_error());

		}
		


  
  
  
  $logFile = "Responce1.json";
  $log = fopen($logFile, "a");
  fwrite($log, $stkCallbackResponse);
  fclose($log);
  
  header("location: formlipa.php");