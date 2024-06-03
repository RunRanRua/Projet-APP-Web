<?php
session_start();
include 'db_connection.php';

if (!isset($_SESSION['user_id']) || !$_SESSION['is_admin']) {
    header('Location: ../htmls/index.php');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Concert non spécifié.");
}

$stmt = $pdo->prepare("SELECT * FROM concert WHERE idConcert = ?");
$stmt->execute([$id]);
$concert = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$concert) {
    die("Aucun concert trouvé.");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'] ?? '';
    $date = $_POST['date'] ?? '';
    $start_time = $_POST['start_time'] ?? '';
    $duration = $_POST['duration'] ?? '';
    $end_time = $_POST['end_time'] ?? '';
    $description = $_POST['description'] ?? '';
    $category = $_POST['category'] ?? '';
    $status = $_POST['status'] ?? '';
    $price = $_POST['price'] ?? '0.00';

    // Vérifier si un nouveau fichier image est téléchargé
    $imagePath = $concert['ImagePath']; // Garder l'image actuelle par défaut
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // Crée le répertoire avec les bonnes permissions
        }
        $target_file = $target_dir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $imagePath = $target_file;
        } else {
            echo "Erreur lors du téléchargement de l'image.";
        }
    }

    // Mise à jour du concert dans la base de données
    $updateStmt = $pdo->prepare("UPDATE concert SET Titre = ?, Date_concert = ?, Debut_heure = ?, Duree = ?, Fin_heure = ?, Description = ?, Categorie = ?, Etat = ?, ImagePath = ?, Prix = ? WHERE idConcert = ?");
    $updateStmt->execute([$title, $date, $start_time, $duration, $end_time, $description, $category, $status, $imagePath, $price, $id]);
    
    header('Location: ../htmls/event.php');
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
    <form action="edit_concert.php?id=<?= htmlspecialchars($id) ?>" method="post" enctype="multipart/form-data">
        <label for="title">Titre du concert:</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($concert['Titre']) ?>" required>

        <label for="price">Prix du concert:</label>
        <input type="number" id="price" name="price" step="0.01" min="0" value="<?= htmlspecialchars($concert['Prix']) ?>" required>

        <label for="date">Date du concert:</label>
        <input type="date" id="date" name="date" value="<?= htmlspecialchars(date('Y-m-d', strtotime($concert['Date_concert']))) ?>" required>

        <label for="start_time">Heure de début:</label>
        <input type="time" id="start_time" name="start_time" value="<?= htmlspecialchars($concert['Debut_heure']) ?>" required>

        <label for="duration">Durée:</label>
        <input type="text" id="duration" name="duration" value="<?= htmlspecialchars($concert['Duree']) ?>" required>

        <label for="end_time">Heure de fin:</label>
        <input type="time" id="end_time" name="end_time" value="<?= htmlspecialchars($concert['Fin_heure']) ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($concert['Description']) ?></textarea>

        <label for="category">Catégorie:</label>
        <input type="text" id="category" name="category" value="<?= htmlspecialchars($concert['Categorie']) ?>" required>

        <label for="status">État:</label>
        <input type="text" id="status" name="status" value="<?= htmlspecialchars($concert['Etat']) ?>" required>

        <label for="image">Image du concert (laisser vide pour conserver l'image actuelle):</label>
        <input type="file" id="image" name="image" accept="image/*">

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
