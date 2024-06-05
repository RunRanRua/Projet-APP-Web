<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$userId = $_SESSION['user_id'];

$concertId = intval($_GET['concert_id']);

$sql = "SELECT nom, date, details FROM concerts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $concertId);
$stmt->execute();
$result = $stmt->get_result();

$concert = $result->fetch_assoc();

$stmt->close();
$conn->close();

echo json_encode($concert);
?>