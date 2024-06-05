<?php
include 'Config/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentaire = $_POST['commentaire'];
    
    try {
        $sql = "INSERT INTO commentaire (Date_commentaire, texte) VALUES (NOW(), :commentaire)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['commentaire' => $commentaire]);
        echo "Commentaire enregistré avec succès.";
    } catch (PDOException $e) {
        die("Erreur lors de l'enregistrement du commentaire : " . $e->getMessage());
    }
}
?>