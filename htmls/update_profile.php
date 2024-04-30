<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'db.php'; // Assurez-vous d'inclure votre connexion à la base de données

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$mail = $_POST['email']; // Utiliser la variable $mail pour être cohérent avec le nom de la colonne
$numero = $_POST['numero'];

// Vérifier le mot de passe actuel
$sql = "SELECT Mdp FROM Utilisateur WHERE idUtilisateur = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashed_password);
$stmt->fetch();

if (password_verify($current_password, $hashed_password)) {
    // Mettre à jour le mail et le numéro
    $sql = "UPDATE Utilisateur SET Mail = ?, Numero = ? WHERE idUtilisateur = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $mail, $numero, $user_id);
    $stmt->execute();

    // Mettre à jour le mot de passe si nécessaire
    if (!empty($new_password)) {
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE Utilisateur SET Mdp = ? WHERE idUtilisateur = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_hashed_password, $user_id);
        $stmt->execute();
    }

    $_SESSION['update_status'] = "Informations mises à jour avec succès!";
    $_SESSION['email'] = $mail; // Mettre à jour l'email dans la session si nécessaire
} else {
    $_SESSION['update_status'] = "Mot de passe actuel incorrect.";
}

header("Location: profil.php");
exit;
?>
