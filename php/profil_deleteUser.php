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

// prepare sql  ------------------------------------------------------------------------------------
$sql = "DELETE FROM Utilisateur WHERE idUtilisateur=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['user_id']);

if ($stmt->execute()) {
    session_unset();
    session_destroy();

    echo "<script>alert('Compte supprimé!'); window.location.href='../htmls/index.php';</script>";
} else {
    echo "<script>alert('Supprimer le compte non réussi !'); window.location.href='../htmls/profil.php';</script>";
}

$stmt->close();
$conn->close();
exit();
?>