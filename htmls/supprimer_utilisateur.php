<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$id = $_GET['id'];

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$sql = "DELETE FROM Utilisateur WHERE idUtilisateur=$id";

if ($conn->query($sql) === TRUE) {
    echo "Utilisateur supprimé avec succès";
} else {
    echo "Erreur lors de la suppression: " . $conn->error;
}

$conn->close();
header("Location: gestion_utilisateurs.php"); // Rediriger vers la page principale
exit();
?>