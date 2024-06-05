<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum Events-IT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <a href="#">Accueil</a>
            <a href="#">Événements</a>
            <a href="#">FAQ</a>
            <a href="#">Forum</a>
            <a href="#">À propos</a>
            <a href="#">Connexion</a>
        </nav>
    </header>
    </main>


    <form action="nouveauSujet.php" method="post">
        Mail : <input type="text" name="mail">
        <button type="submit"></button>
    </form>
    <form method="post" action="commenter.php">
    <textarea name="commentaire" placeholder="Écrivez votre commentaire ici" rows="4" required></textarea><br>
    <input type="submit" value="Commenter">
</form>
    <footer>
        <nav>
            <a href="#">FAQ</a>
            <a href="#">CGU - CGV</a>
            <a href="#">Contact</a>
            <a href="#">Mentions légales</a>
            <a href="#">Confidentialité</a>
        </nav>
        <p>© 2024 Events-IT</p>
    </footer>
</body>
</html>
<?php
include 'Config/dbconfig.php';

try {
    $sql = "SELECT * FROM mydb";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($results as $row) {
        // Traitez chaque ligne de résultats ici
    }
} catch (PDOException $e) {
    die("Erreur lors de l'exécution de la requête SQL : " . $e->getMessage());
}
?>