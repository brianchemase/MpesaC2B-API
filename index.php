<?php
//script to register the payments

$servername = "localhost";
$port = 3306;//port number
$username = "database_username";
$password = "database_password";
$dbname = "Mpesa_transactions";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the request method is POST and if there is JSON data in the request body
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($json_data = file_get_contents('php://input'))) {
    // Decode the JSON data into an associative array
    $data_array = json_decode($json_data, true);

    if ($data_array !== null) {
        // Define the expected fields in the JSON data
        $expectedFields = [
            'TransactionType',
            'TransID',
            'TransTime',
            'TransAmount',
            'BusinessShortCode',
            'BillRefNumber',
            'InvoiceNumber',
            'OrgAccountBalance',
            'ThirdPartyTransID',
            'MSISDN',
            'FirstName',
            'MiddleName',
            'LastName',
        ];

        // Validate that all expected fields are present in the JSON data
        $missingFields = [];
        foreach ($expectedFields as $field) {
            if (!array_key_exists($field, $data_array)) {
                $missingFields[] = $field;
            }
        }

        if (!empty($missingFields)) {
            echo "Missing fields in JSON data: " . implode(", ", $missingFields);
        } else {
            // Use prepared statements to prevent SQL injection
            $sql = "INSERT INTO Transactions (TransactionType, TransID, TransTime, TransAmount, BusinessShortCode, BillRefNumber, InvoiceNumber, OrgAccountBalance, ThirdPartyTransID, MSISDN, FirstName, MiddleName, LastName)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param(
                "sssssssssssss",
                $data_array['TransactionType'],
                $data_array['TransID'],
                $data_array['TransTime'],
                $data_array['TransAmount'],
                $data_array['BusinessShortCode'],
                $data_array['BillRefNumber'],
                $data_array['InvoiceNumber'],
                $data_array['OrgAccountBalance'],
                $data_array['ThirdPartyTransID'],
                $data_array['MSISDN'],
                $data_array['FirstName'],
                $data_array['MiddleName'],
                $data_array['LastName']
            );

            if ($stmt->execute()) {
                echo "JSON data has been successfully stored in the database";
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        echo "Invalid JSON data";
    }
} else {
    echo "No JSON data received";
}

$conn->close();
?>
