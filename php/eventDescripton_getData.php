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

$eventID = $_SESSION["concert_id"];
$myList = [];
// ================= EVENT INFO =======================================
// prepare sql
$sql_event = "SELECT concert.*,artiste.nom_artiste 
            FROM concert,concert_has_artiste,artiste 
            WHERE concert.idConcert = ? 
            AND concert.idConcert = concert_has_artiste.idConcert 
            AND concert_has_artiste.idArtiste = artiste.idArtiste ";


$stmt = $conn->prepare($sql_event);
$stmt->bind_param("s", $eventID);
$stmt->execute();
$result = $stmt->get_result();

// get data from db
while($row = $result->fetch_assoc()){
    $myList[] = $row;
}

// ================= PLACES INFO =======================================
// prepare sql
$sql_places = "SELECT place FROM billet_achete WHERE idConcert = ?";


$stmt = $conn->prepare($sql_places);
$stmt->bind_param("s", $eventID);
$stmt->execute();
$result = $stmt->get_result();

// get data from db
$places = array();
while($row = $result->fetch_assoc()){
    $places[] = $row;
    
}
$myList[] = $places;



echo json_encode($myList);

$stmt->close();
$conn->close();

?>