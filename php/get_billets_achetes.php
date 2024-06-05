<?php
/*
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
*/
?>