<?php

// Check if the request method is POST and if there is JSON data in the request body
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($json_data = file_get_contents('php://input'))) {
    // Decode the JSON data into an associative array
    $data_array = json_decode($json_data, true);

    if ($data_array !== null) {
        $id = $data_array['id'];
        $date = $data_array['date'];
		$status = $data_array['status'];

        // Your database connection parameters
		
		$servername = "localhost";
        $port = 3306;//port number
        $username = "database_username";
        $password = "database_password";
        $dbname = "Mpesa_transactions";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Update the Transaction table
        $sql = "UPDATE Transactions SET posting_date = '$date', status = '$status' WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close the connection
        $conn->close();
    } else {
        echo "Invalid JSON data";
    }
} else {
    echo "No JSON data received";
}

?>
