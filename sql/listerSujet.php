<?php
session_start();
header('Content-Type: aplication/json');

// Server Access  ------------------------------------------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error ]));
}

// get POST data
$data = json_decode(file_get_contents('php://input'),true);



$userId = $_SESSION['user_id'];
$myList = [];

// prepare sql
$sql = "SELECT * FROM commentaire";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

// get data from db
while($row = $result->fetch_assoc()){
    $myList[] = $row;
}
echo json_encode($myList);

$stmt->close();
$conn->close();

?>