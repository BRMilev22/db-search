<?php
// Retrieve form data
$id = $_POST['id'];
$phone_name = $_POST['phone_name'];
$price = $_POST['price'];
$shape = $_POST['shape'];
$battery = $_POST['battery'];
$notes = $_POST['notes'];

if (empty($id) || empty($phone_name) || empty($price) || empty($shape) || empty($battery) || empty($notes)) {
    die("Error: Трябва да попълните цялата информация за телефона."); // Display error message and stop execution
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

// Prepare and execute SQL INSERT statement
$stmt = $conn->prepare("INSERT INTO phone_info (id, phone_name, price, shape, battery, notes) VALUES (?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    die("Error: " . $conn->error); // Display error message if the statement preparation fails
}

$stmt->bind_param("ssssss", $id, $phone_name, $price, $shape, $battery, $notes);
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
