<?php
include 'dpconfig.php';

$mail = 'exemple@mail.com';
$mdp = 'motdepasse';

$sql = "INSERT INTO Utilisateur (Mail, Mdp) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$mail, $mdp]);
?>