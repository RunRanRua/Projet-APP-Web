<?php
session_start();
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

// Requête pour récupérer les billets achetés par l'utilisateur
$sqlBillets = "SELECT * FROM billet_achete WHERE idUtilisateur = $userId";
$resultBillets = $conn->query($sqlBillets);

// Vérifier s'il y a des billets achetés
if ($resultBillets->num_rows > 0) {
    echo "<h3>Billets achetés :</h3>";
    while ($rowBillet = $resultBillets->fetch_assoc()) {
        echo "Billet ID: " . $rowBillet["idBillet"] . " - Concert ID: " . $rowBillet["idConcert"] . "<br>";
    }
} else {
    echo "<p>Aucun billet acheté trouvé.</p>";
}


function getConcerts($userId) {
    global $conn;
    $currentDate = date('Y-m-d H:i:s');

    // Récupération des concerts
    $sql = "
    SELECT c.idConcert AS id, c.Titre AS nom, c.Date_concert AS date, c.Description AS details
    FROM Concert c
    JOIN Billet_achete b ON c.idConcert = b.idPlace
    WHERE b.idUtilisateur = $userId";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    $currentConcerts = [];
    $upcomingConcerts = [];
    $pastConcerts = [];

    while ($row = $result->fetch_assoc()) {
        if ($row['date'] > $currentDate) {
            $upcomingConcerts[] = $row;
        } elseif ($row['date'] < $currentDate) {
            $pastConcerts[] = $row;
        } else {
            $currentConcerts[] = $row;
        }
    }

    $stmt->close();

    return [
        'current' => $currentConcerts,
        'upcoming' => $upcomingConcerts,
        'past' => $pastConcerts
    ];
}

if (!isset($_SESSION['user_id'])) {
    die("User not logged in");
}


$concerts = getConcerts($userId);
?>
