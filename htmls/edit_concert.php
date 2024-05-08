<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Concert non spécifié.");
}

$stmt = $pdo->prepare("SELECT * FROM Concert WHERE idConcert = ?");
$stmt->execute([$id]);
$concert = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$concert) {
    die("Aucun concert trouvé.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $description = $_POST['description'] ?? '';

    $updateStmt = $pdo->prepare("UPDATE Concert SET Titre = ?, Date_concert = ?, Description = ? WHERE idConcert = ?");
    $updateStmt->execute([$title, $date, $description, $id]);

    header('Location: event.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le concert</title>
</head>
<body>
    <h1>Modifier le concert</h1>
    <form action="edit_concert.php?id=<?= htmlspecialchars($id) ?>" method="post">
        <label for="title">Titre du concert:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($concert['Titre']) ?>" required>

        <label for="date">Date du concert:</label>
        <input type="date" id="date" name="date" value="<?= htmlspecialchars($concert['Date_concert']) ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($concert['Description']) ?></textarea>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
