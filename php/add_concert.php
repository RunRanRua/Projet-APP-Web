<?php
session_start();
include 'db_connection.php';

// Activer l'affichage des erreurs pour le débogage
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'utilisateur est admin
if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: ../php/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les valeurs du formulaire
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $start_time = $_POST['start_time'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $end_time = $_POST['end_time'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $status = $_POST['status'] ?? '';
    $price = $_POST['price'] ?? '0.00';

    // Vérifier si un fichier image est téléchargé
    $imagePath = '';
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../images/";
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
        $query = $pdo->prepare("INSERT INTO concert (Titre, Date_concert, Debut_heure, Duree, Fin_heure, Description, Categorie, Etat, ImagePath, Prix) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $result = $query->execute([$title, $date, $start_time, $duration, $end_time, $description, $category, $status, $imagePath, $price]);

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
