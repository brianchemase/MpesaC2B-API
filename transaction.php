<?php

        $servername = "localhost";
        $port = 3306;//port number
        $username = "database_username";
        $password = "database_password";
        $dbname = "Mpesa_transactions";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Select the database
$conn->select_db($dbname);

// Retrieve data from the database where status is 0
$sql = "SELECT * FROM Transactions WHERE status = 0 LIMIT 1"; // Assuming the status column is named "status"
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    // Close the database connection
    $conn->close();
    
    // Share data as JSON
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
} else {
    echo "No data found with status 0";
    $conn->close();
}
?>
