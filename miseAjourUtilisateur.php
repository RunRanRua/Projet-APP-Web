<?php
include 'dpconfig.php';

$mail = 'nouvel_exemple@mail.com';
$mdp = 'nouveau_motdepasse';
$ancien_mail = 'exemple@mail.com';

$sql = "UPDATE Utilisateur SET Mail = ?, Mdp = ? WHERE Mail = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$mail, $mdp, $ancien_mail]);
?>