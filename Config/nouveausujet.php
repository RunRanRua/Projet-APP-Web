<?php
include 'Config/dbconfig.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = $_POST['mail'];
    
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        try {
            $sql = "INSERT INTO utilisateur (Mail) VALUES (:mail)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['mail' => $mail]);
            echo "Email enregistré avec succès.";
        } catch (PDOException $e) {
            die("Erreur lors de l'enregistrement de l'email : " . $e->getMessage());
        }
    } else {
        echo "Email invalide.";
    }
}
?>