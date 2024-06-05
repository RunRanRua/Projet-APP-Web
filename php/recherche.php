
<?php
// Connexion à la base de données
$conn = new mysqli('localhost', 'root', '', 'mydb');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialiser la requête de base
$sql = "SELECT * FROM utilisateurs WHERE 1=1";

// Ajouter des conditions en fonction des champs remplis
if (!empty($_POST['nom'])) {
    $nom = $conn->real_escape_string($_POST['nom']);
    $sql .= " AND nom LIKE '%$nom%'";
}

if (!empty($_POST['prenom'])) {
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $sql .= " AND prenom LIKE '%$prenom%'";
}

if (!empty($_POST['age'])) {
    $age = $conn->real_escape_string($_POST['age']);
    $sql .= " AND age = $age";
}

// Exécuter la requête
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Afficher les résultats
    while($row = $result->fetch_assoc()) {
        echo "Nom: " . $row["nom"]. " - Prénom: " . $row["prenom"]. " - Âge: " . $row["age"]. "<br>";
    }
} else {
    echo "0 résultats";
}

$conn->close();
?>
