<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "health_report_form";

    // create a new connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $weight = $_POST["weight"];
    $email = $_POST["email"];

    // Insert user details into the database
    $sql = "INSERT INTO users (name, age, weight, email) VALUES ('$name', $age, $weight, '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>