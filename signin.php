<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the user input
    $id = $_POST["id"];
    $password = $_POST["password"];

    // Database credentials
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "silver";

    // Create a database connection
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to fetch the user with the provided ID and password
    $stmt = $conn->prepare("SELECT id, password FROM login WHERE id = ? AND password = ?");
    $stmt->bind_param("ss", $id, $password);
    $stmt->execute();

    // Bind the result to variables
    $stmt->bind_result($result_id, $result_password);

    // Check if a matching record was found
    if ($stmt->fetch()) {
        // Successful login, do something here (e.g., redirect to a dashboard page)
        header("Location: index.html");
    exit();
    } else {
        // Failed login, show an error message
        echo "Invalid ID or password. Please try again.";
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();
}
?>
