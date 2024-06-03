<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Server Access  ------------------------------------------------------------------------------------

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


// Retrieve form data ------------------------------------------------------------------------------------
$today = date("Y-m-d");
$concertID = $_SESSION['concert_id'];
$userID = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $places = $_POST['checkedPlace'];

    if(!isset($_POST['checkedPlace'])){
        echo "Veuillez choisir au moins 1 place.";
        exit;
    }
}


// SQL --------------------------------------------------------------------------------------
foreach ($places as $place) {
    // prepare SQL
    $sql = "INSERT INTO billet_achete (idUtilisateur, idConcert, Date_achat_billet, place) VALUES (?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $userID, $concertID, $today, $place);
    
    // execute
    if (!($stmt->execute())) {
        echo "Erreur lors de la réservation : " . $stmt->error;
        $stmt->close();
        $conn->close();
        exit;
    }
}
echo "<script>alert('Réservation réussie!'); window.location.href='../htmls/index.php';</script>";  

$stmt->close();
$conn->close();
?>