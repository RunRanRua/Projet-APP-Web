<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// Préparer et lier
$stmt = $conn->prepare("INSERT INTO utilisateur (Nom, Prenom, Mail, Mdp) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $nom, $prenom, $email, $mdp);

if ($stmt->execute()) {
    echo "Nouvel utilisateur ajouté avec succès";
} else {
    echo "Erreur lors de l'ajout: " . $stmt->error;
}

$stmt->close();
$conn->close();
header("Location: gestion_utilisateurs.php"); // Rediriger vers la page principale
exit();
?>