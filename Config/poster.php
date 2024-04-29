<?php
include 'dbconfig.php';

$titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_SPECIAL_CHARS);
$description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);

$sql = "INSERT INTO posts (titre, contenu, date_creation) VALUES (?, ?, NOW())";
$stmt = $pdo->prepare($sql);
$stmt->execute([$titre, $description]);

header('Location: index.php'); // Rediriger vers la page principale après la publication
exit;
?>
