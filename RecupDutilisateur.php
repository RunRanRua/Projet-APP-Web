<?php
include 'dpconfig.php';

$sql = "SELECT * FROM Utilisateur1";
$stmt = $pdo->prepare($sql);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Utilisez les données de l'utilisateur ici.
    // Par exemple, pour afficher le mail de l'utilisateur :
    echo $row['Mail'];
}
?>