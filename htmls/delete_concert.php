<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    
    try {
        $query = $pdo->prepare("DELETE FROM Concert WHERE idConcert = ?");
        $result = $query->execute([$id]);

        if ($result) {
            echo "Concert supprimé avec succès!";
        } else {
            echo "Erreur lors de la suppression du concert.";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
    // Rediriger vers la page des concerts après la suppression
    header("Location: event.php");
    exit;
} else {
    echo "Méthode non supportée.";
}
?>
