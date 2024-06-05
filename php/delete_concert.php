<?php
session_start();
include 'db_connection.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: ../htmls/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Commencez une transaction
        $pdo->beginTransaction();

        // Récupérer l'image associée au concert
        $stmt = $pdo->prepare("SELECT ImagePath FROM concert WHERE idConcert = ?");
        $stmt->execute([$id]);
        $concert = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($concert) {
            $imagePath = $concert['ImagePath'];

            // Supprimer les enregistrements associés dans la table concert_has_artiste
            $deleteAssocStmt = $pdo->prepare("DELETE FROM concert_has_artiste WHERE idConcert = ?");
            $deleteAssocStmt->execute([$id]);

            // Supprimer les enregistrements associés dans la table billet_achete
            $deleteBilletsStmt = $pdo->prepare("DELETE FROM billet_achete WHERE idConcert = ?");
            $deleteBilletsStmt->execute([$id]);

            // Supprimer le concert de la base de données
            $query = $pdo->prepare("DELETE FROM concert WHERE idConcert = ?");
            $result = $query->execute([$id]);

            if ($result) {
                // Supprimer l'image associée si elle existe et n'est pas l'image par défaut
                if ($imagePath && $imagePath != 'default.jpg' && file_exists($imagePath)) {
                    if (unlink($imagePath)) {
                        echo "Image supprimée avec succès!<br>";
                    } else {
                        echo "Erreur lors de la suppression de l'image.<br>";
                    }
                }
                echo "Concert supprimé avec succès!<br>";
            } else {
                echo "Erreur lors de la suppression du concert.<br>";
            }
        } else {
            echo "Concert non trouvé.<br>";
        }

        // Commit la transaction
        $pdo->commit();
    } catch (PDOException $e) {
        // Rollback la transaction en cas d'erreur
        $pdo->rollBack();
        echo "Erreur: " . $e->getMessage();
    }
    // Rediriger vers la page des concerts après la suppression
    header("Location: ../htmls/event.php");
    exit;
} else {
    echo "Méthode non supportée.";
}
?>
