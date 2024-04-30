<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion_utilisateurs</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/FAQ.css">
    <link rel="stylesheet" href="../css/index.css">

</head>

<body>
<div class="header">
    <!-- logo -->
    <div class="logo">
        <a href="#"><img src="..\images\logo100px.png"></a>
    </div>

    <!-- navigation -->
    <div class="nav">
        <ul>
            <li><a href="index.php"><b>ACCUEIL</b></a></li>
            <li><a href="#"><b>EVENEMENT</b></a></li>
            <li><a href="#"class = "active"><b>FAQ</b></a></li>
            <li><a href="#"><b>FORUM</b></a></li>
            <li><a href="#"><b>A PROPOS</b></a></li>
        </ul>
    </div>

    <!-- search barre -->
    <div class="search">
        <a href="#"><img src="..\images\loop.png"></a>
        <input type="text" placeholder="RECHERCHE">
    </div>

    <!-- user -->
    <div class="user">
        <a href="#"><img src="..\images\signup.png"></a>
        <a href="#"><img src="..\images\login2.png"></a>
    </div>
</div>
    <h1>Gestion des Utilisateurs</h1>
    <?php
    $servername = "localhost";
    $username = "root";
    $password = ""; // Vide pour aucun mot de passe
    $dbname = "mydb";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connexion échouée: " . $conn->connect_error);
    }
    echo "Connexion réussie";
    ?>

    <h2>Ajouter un Utilisateur</h2>
    <form method="post" action="ajouter_utilisateurs.php">
        Nom: <input type="text" name="nom" required><br>
        Prénom: <input type="text" name="prenom" required><br>
        Email: <input type="email" name="email" required><br>
        Mot de passe: <input type="password" name="mdp" required><br>
        <input type="submit" value="Ajouter Utilisateur">
    </form>

    <h2>Liste des Utilisateurs</h2>
    <?php
    $sql = "SELECT idUtilisateur, Nom, Prenom, Mail FROM Utilisateur";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Actions</th></tr>";
        // Afficher les données de chaque ligne
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>".$row["idUtilisateur"]."</td><td>".$row["Nom"]."</td><td>".$row["Prenom"]."</td><td>".$row["Mail"]."</td>";
            echo "<td><a href='supprimer_utilisateur.php?id=".$row["idUtilisateur"]."'>Supprimer</a></td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats";
    }
    $conn->close();
    ?>
</body>
</html>
