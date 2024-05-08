<?php
session_start();
include 'db_connection.php'; // Assurez-vous que ce fichier contient la connexion à votre base de données

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les valeurs du formulaire
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $description = $_POST['description'] ?? '';

    // Vérifier si un fichier image est téléchargé
    $imagePath = '';
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $imagePath = $target_file;
        }
    }

    // Insérer les données dans la base de données
    try {
        // Notez que nous avons enlevé idConcert_donnees de la requête
        $query = $pdo->prepare("INSERT INTO Concert (Titre, Date_concert, Description, ImagePath) VALUES (?, ?, ?, ?)");
        $result = $query->execute([$title, $date, $description, $imagePath]);

        if ($result) {
            echo "Concert ajouté avec succès!";
        } else {
            echo "Erreur lors de l'ajout du concert.";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
} else {
    echo "Méthode non supportée.";
}
?>
