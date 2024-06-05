<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the database connection script
include('connect.php');

function getConcerts($userId) {
    global $conn;
    $currentDate = date('Y-m-d H:i:s');

    // Récupération des concerts
    $sql = "
    SELECT c.idConcert AS id, c.Titre AS nom, c.Date_concert AS date, c.Description AS details
    FROM Concert c
    JOIN Billet_achete b ON c.idConcert = b.idPlace
    WHERE b.idUtilisateur = ?";

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

$userId = $_SESSION['user_id'];
$concerts = getConcerts($userId);
?>
