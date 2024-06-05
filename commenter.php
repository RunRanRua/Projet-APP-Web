<?php
include 'dpconfig.php';
$commentaire = filter_input(INPUT_POST, 'commentaire', FILTER_SANITIZE_SPECIAL_CHARS);
// Ici, vous devez également obtenir l'ID du sujet sur lequel l'utilisateur commente.
// Supposons que vous l'obteniez à partir d'un champ caché dans le formulaire.
$id_sujet = filter_input(INPUT_POST, 'id_sujet', FILTER_SANITIZE_NUMBER_INT);
$sql = "INSERT INTO commentaires (id_sujet, commentaire, date_creation) VALUES (?, ?, NOW())";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_sujet, $commentaire]);
header('Location: index.php'); // Redirigez vers la page principale après la publication du commentaire
exit;
?>