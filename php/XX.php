
<?php
// Configuration de la connexion à la base de données
$host = 'localhost';  // à ajuster selon votre configuration
$dbname = 'mydb';  // à remplacer par le nom de votre base de données
$username = 'root';  // à remplacer par votre nom d'utilisateur pour la base de données
$password = '';  // à remplacer par votre mot de passe pour la base de données

// Tentative de connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Gestion de la soumission du formulaire de recherche
$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE title LIKE :search OR content LIKE :search");
    $stmt->execute(['search' => "%$search%"]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Afficher tous les posts si aucune recherche n'est spécifiée
    $stmt = $pdo->query("SELECT * FROM posts");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Gestion de la soumission du nouveau sujet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (:title, :content)");
    $stmt->execute(['title' => $title, 'content' => $description]);
    header("Location: forum.php");  // Rediriger pour rafraîchir la page et éviter les reposts
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum Cinéma Classique</title>
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
    <div class="header">
        <h1>Forum Cinéma Classique</h1>
    </div>
    <div class="search-bar">
        <form action="forum.php" method="get">
            <input type="text" name="search" placeholder="Rechercher un film, un réalisateur...">
            <input type="submit" value="Rechercher">
        </form>
    </div>
    <div class="main">
        <?php foreach ($posts as $post): ?>
        <div class="post">
            <h3 class="topic"><?= htmlspecialchars($post['title']) ?></h3>
            <p class="content"><?= nl2br(htmlspecialchars($post['content'])) ?></p>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="new-topic-form">
        <form action="forum.php" method="post">
            <input type="text" name="title" placeholder="Titre du sujet" required><br>
            <textarea name="description" placeholder="Décrivez votre sujet" rows="4" required></textarea><br>
            <input type="submit" value="Poster">
        </form>
    </div>
    <div class="footer">
        © 2024 Forum Cinéma Classique
    </div>
</body>
</html>