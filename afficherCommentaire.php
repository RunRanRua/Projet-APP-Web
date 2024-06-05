<?php
include 'dpconfig.php';
$id_sujet = // Obtenez l'ID du sujet ici
$sql = "SELECT commentaire, date_creation FROM commentaires WHERE id_sujet = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_sujet]);
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo 'Commentaire: ' . $row['commentaire'] . '<br>';
    echo 'Date de création: ' . $row['date_creation'] . '<br>';
}
?>