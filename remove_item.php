<?php
// Retrieve form data
$id = $_POST['id'];

if (empty($id)) {
    die("Error: Трябва да попълните служебния номер на телефона."); // Display error message and stop execution
}

// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ir-technics";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Връзката с базата данние не бе осъществена: " . $conn->connect_error);
}

// Check if the item ID exists in the database
$stmt = $conn->prepare("SELECT id FROM phone_info WHERE id = ?");
$stmt->bind_param("s", $id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    die("Error: Телефон с такъв служебен номер не бе намерен в базата с данни."); // Display error message if the item ID does not exist
}

$stmt->close();

// Prepare and execute SQL INSERT statement
$stmt = $conn->prepare("DELETE FROM phone_info WHERE id = ?");

if (!$stmt) {
    die("Error: " . $conn->error); // Display error message if the statement preparation fails
}

$stmt->bind_param("s", $id);
$stmt->execute();

if ($stmt->error) {
    die("Error: " . $stmt->error); // Display error message if the statement execution fails
}

// Close the database connection
$stmt->close();
$conn->close();

header("Location: index.php");
exit();
?>
