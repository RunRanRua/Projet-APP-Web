<?php
session_start();
header('Content-Type: application/json');

// Server Access
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// get POST data
$data = json_decode(file_get_contents('php://input'), true);

$eventID = $_SESSION["concert_id"];
$myList = [];

// Event info
$sql_event = "SELECT concert.*, artiste.nom_artiste 
              FROM concert 
              LEFT JOIN concert_has_artiste ON concert.idConcert = concert_has_artiste.idConcert 
              LEFT JOIN artiste ON concert_has_artiste.idArtiste = artiste.idArtiste 
              WHERE concert.idConcert = ?";

$stmt = $conn->prepare($sql_event);
$stmt->bind_param("i", $eventID);
$stmt->execute();
$result = $stmt->get_result();

// Get data from db
$eventInfo = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $eventInfo = $row;
    }
}

// Places info
$sql_places = "SELECT place FROM billet_achete WHERE idConcert = ?";
$stmt = $conn->prepare($sql_places);
$stmt->bind_param("i", $eventID);
$stmt->execute();
$result = $stmt->get_result();

// Get data from db
$places = [];
while ($row = $result->fetch_assoc()) {
    $places[] = $row;
}

// Prepare the final response
$myList[] = $eventInfo;
$myList[] = $places;

echo json_encode($myList);

$stmt->close();
$conn->close();
?>
