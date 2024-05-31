<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Events-IT</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/FAQ.css">
</head>
<body>
<!-- === Header Part === -->
<div class="header">
    <!-- logo -->
    <div class="logo">
        <a href="#"><img src="..\images\logo100px.png"></a>
    </div>
=======
<?php
$servername = "localhost"; // L'adresse du serveur de base de données
$username = "root"; // Le nom d'utilisateur pour se connecter à la base de données
$password = "root"; // Le mot de passe pour se connecter à la base de données
$dbname = "mydb4"; // Le nom de la base de données

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $question = $_POST["Question"];
    $answer = $_POST["Réponse"];

    // Préparer la requête SQL
    $sql = "INSERT INTO  faq ( titre, contenu) VALUES ('$question', '$answer')";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        echo "Question ajoutée avec succès.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}


?>