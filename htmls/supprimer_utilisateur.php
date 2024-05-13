<?php
session_start();
require 'db_connection.php'; // Assurez-vous que ce fichier initialise correctement `$pdo`

$id = $_GET['id'];

// Vérifier que l'ID est bien un nombre
if (!is_numeric($id)) {
    die("ID invalide.");
}

// Préparer la requête SQL en utilisant PDO
try {
    $stmt = $pdo->prepare("DELETE FROM Utilisateur WHERE idUtilisateur = ?");
    $stmt->bindParam(1, $id, PDO::PARAM_INT);  // Utiliser bindParam pour lier $id à la requête

    if ($stmt->execute()) {
        echo "Utilisateur supprimé avec succès";
    } else {
        echo "Erreur lors de la suppression";
    }
    $stmt->closeCursor(); // Fermeture du curseur d'exécution
    header("Location: gestion_utilisateurs.php");  // Rediriger vers la page principale
    exit;
} catch (PDOException $e) {
    die("Erreur lors de la suppression: " . $e->getMessage());
}
?>
