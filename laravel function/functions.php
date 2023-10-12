<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use DateTime; // Don't forget to include this



public function GetPayments()
    {
        $url = 'https://lpf.sisdo.co.ke/mpesa/transaction.php'; // Replace with the actual URL of your PHP script
        
        try {
            $response = Http::get($url);
            $data = $response->json();
            
            // Access and store specific fields in variables
            $transactionType = $data[0]['TransactionType'];
            $transID = $data[0]['TransID'];
            $transTime = $data[0]['TransTime'];
            $payment_received = $data[0]['TransAmount'];// client payment amount
            $client_id = $data[0]['BillRefNumber'];// client id or the account number
            $transTime = $data[0]['TransTime'];

            $id= $data[0]['id'];
            // ... continue for other fields

            $dateTime = DateTime::createFromFormat('YmdHis', $transTime);
            $payment_date = $dateTime->format('Y-m-d');// client payment date


            if(condition 1)
            {
                //successful registration
                $status=1;
                $response = $this->sendPostRequest($id, $status);

            }
            elseif(condition 2)
            {
                //incase of an error
                $status=2;
                $response = $this->sendPostRequest($id, $status);
            }else
            {
                //incase it needs to be reviewed
                $status=2;
                $response = $this->sendPostRequest($id, $status);
            }


   
           
            
           // return view('your_view', compact('transactionType', 'transID', 'transTime'));
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }
    }




    public function sendPostRequest($id, $status)
    {
        // Data to be sent in the POST request
        $data = array(
            "id" => $id,
            "status" => $status,
            "date" => now()
        );

        $data_string = json_encode($data);

        // URL for the POST request
        $url = 'http://urlto/update_posting.php';

        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_string)
        ));

        // Execute the cURL session
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return 'cURL Error: ' . curl_error($ch);
        }

        // Close the cURL session
        curl_close($ch);

        // Return the response from the server
        return $response;
    }