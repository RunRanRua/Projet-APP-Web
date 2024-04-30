<?php
$servername = "localhost"; // L'adresse du serveur de base de données
$username = "root"; // Le nom d'utilisateur pour se connecter à la base de données
$password = ""; // Le mot de passe pour se connecter à la base de données
$dbname = "mydb"; // Le nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pour utiliser cette connexion dans vos autres fichiers PHP, incluez ce fichier
// Exemple: require 'database.php';
?>
