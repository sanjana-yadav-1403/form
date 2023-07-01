<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "health_report_form";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Fetch user's health report from the database
    $sql = "SELECT health_report FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $healthReport = $row["health_report"];

        // Send the health report file to the user for download
        if (file_exists($healthReport)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($healthReport) . '"');
            readfile($healthReport);
            exit;
        } else {
            echo "Health report file not found.";
        }
    } else {
        echo "No health report found for the given email ID.";
    }
}

// Close the database connection
$conn->close();
?>