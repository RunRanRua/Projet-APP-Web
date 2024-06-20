<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "mydb");

// Vérification de la connexion
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Récupération de la date de la requête
$date = $_GET['date'] ?? date('Y-m-d');

// Préparation de la requête SQL
$stmt = $mysqli->prepare("SELECT Heure, niveauSonore FROM donnees WHERE date = ?");
$stmt->bind_param("s", $date);
$stmt->execute();
$result = $stmt->get_result();

$times = [];
$levels = [];

// Collecte des données
while ($row = $result->fetch_assoc()) {
    $times[] = $row['Heure'];
    $levels[] = intval($row['niveauSonore']);
}

if (count($levels) > 0) {
    $maxNiveauSonore = max($levels);
    $minNiveauSonore = min($levels);
    $moyenneNiveauSonore = array_sum($levels) / count($levels);
} else {
    // Aucune donnée disponible
    $maxNiveauSonore = $minNiveauSonore = $moyenneNiveauSonore = 0;
}

// Retour des données en JSON incluant la moyenne, max et min
echo json_encode([
    'times' => $times,
    'levels' => $levels,
    'average' => $moyenneNiveauSonore,
    'max' => $maxNiveauSonore,
    'min' => $minNiveauSonore
]);

$stmt->close();
$mysqli->close();
?>
