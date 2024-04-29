<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum Cinéma Classique</title>
    <link rel="stylesheet" href="styles/forum.css">
    <!-- Styles intégrés pour simplifier l'exemple -->
    <style>
        body { font-family: Arial, sans-serif; background-color: #000; color: #fff; margin: 0; padding: 0; }
        .header, .footer { background-color: #333; color: white; text-align: center; padding: 10px 20px; }
        .main { width: 80%; margin: 20px auto; background-color: #222; padding: 20px; box-shadow: 0 0 10px rgba(0,0,0,0.5); }
        .post, .new-topic { margin-bottom: 20px; border-bottom: 1px solid #444; padding-bottom: 10px; }
        .topic { font-size: 20px; color: #ccc; }
        .content { margin-top: 5px; }
        input[type="text"], textarea { padding: 8px; background-color: #333; color: #fff; border: none; }
        input[type="submit"] { background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease; }
    </style>
</head>
<body>
    <?php include 'dbconfig.php'; ?>

    <div class="header">
        <h1>Forum Cinéma Classique</h1>
    </div>

    <!-- Formulaire de recherche -->
    <div class="search-bar">
        <form method="get" action="rechercher.php">
            <input type="text" name="q" placeholder="Rechercher un film, un réalisateur...">
            <input type="submit" value="Rechercher">
        </form>
    </div>

    <!-- Affichage des posts -->
    <div class="main">
        <?php
        $sql = "SELECT titre, contenu FROM posts ORDER BY date_creation DESC";
        foreach ($pdo->query($sql) as $row) {
            echo '<div class="post">';
            echo '<h3 class="topic">'.htmlspecialchars($row['titre']).'</h3>';
            echo '<p class="content">'.nl2br(htmlspecialchars($row['contenu'])).'</p>';
            echo '</div>';
        }
        ?>
    </div>

    <!-- Formulaire de nouveau sujet -->
    <div class="new-topic-form">
        <form method="post" action="poster.php">
            <input type="text" name="titre" placeholder="Titre du sujet" required><br>
            <textarea name="description" placeholder="Décrivez votre sujet" rows="4" required></textarea><br>
            <input type="submit" value="Poster">
        </form>
    </div>

    <div class="footer">
        © 2024 Forum Cinéma Classique
    </div>
</body>
</html>
