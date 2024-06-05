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
$sql = "SELECT Date_achat_billet, place, Titre, Date_concert, Debut_heure, Fin_heure, Duree, Etat, ImagePath, nom_artiste 
        FROM `billet_achete`, concert,artiste,concert_has_artiste
        WHERE concert.idConcert = billet_achete.idConcert 
        and idUtilisateur = ? 
        and artiste.idArtiste = concert_has_artiste.idArtiste 
        and concert.idConcert = concert_has_artiste.idConcert";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userId);
$stmt->execute();
$result = $stmt->get_result();

$currentConcerts = [];
$upcomingConcerts = [];
$pastConcerts = [];

while ($row = $result->fetch_assoc()) {
    if ($row['Date_concert'] > $currentDate) {
        $upcomingConcerts[] = $row;
    } elseif ($row['Date_concert'] < $currentDate) {
        $pastConcerts[] = $row;
    } else {
        $currentConcerts[] = $row;
    }
}



/*
// get data from db
while($row = $result->fetch_assoc()){
    $myList[] = $row;
}
*/

echo json_encode([
    'current' => $currentConcerts,
    'upcoming' => $upcomingConcerts,
    'past' => $pastConcerts
]);
$stmt->close();
$conn->close();

?>