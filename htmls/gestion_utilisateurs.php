<?php session_start(); ?>
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
    <div class="bg"></div>
        <div class="user">

            <?php if (isset($_SESSION['user_id'])){ ?>
                <?php if ( $_SESSION["is_admin"] ) { ?>
                   <a href="gestion_utilisateurs.php" > <img src="..\images\admin_icon.png" alt="Profil"> </a>
                <?php } else{ ?>
                    <a href="profil.php" > <img src="..\images\user.png" alt="Profil"> </a>
                <?php } ?>
        
                <a href="..\php\logout.php"> <img src="..\images\LogOut.png" alt="Déconnexion"> </a>

            <?php }else{ ?>

            <a href="#"><img src="..\images\signup.png" id="signBTN" onclick="inscriptionClick(event)"></a>
            <!-- inscription box -->
            <div class="inscription">
                <form action="../php/inscription.php" method="post">
                    <div class="title2">Inscription</div>
                    <div class="content" >
                        <p class="title">Nom</p>
                        <p class="input"><input type="text" name="nom"/></p>
                        <p class="title">Prénom</p>
                        <p class="input"><input type="text" name="prenom"/></p>
                        <p class="title">Numéro de téléphone</p>
                        <p class="input"><input type="text" name="numero"/></p>
                        <p class="title">Email</p>
                        <p class="input"><input type="text" name="email"/></p>
                        <p class = title>Vérification</p>
                        <p class="inputVerif"><input class="verifMail" type="text"/>  <button class="btnMail">Envoyer</button></p>
                        <p class="title">Mot de passe</p>
                        <p class="input"><input type="password" name="mdp"/></p>
                        <p class="title">Confirmation de mot de passe</p>
                        <p class="input"><input type="password" name="confirm_mdp"/></p>
                        <p class="condition"><input type="checkbox" name="condition"> <u>J'ai lu et j'accepte toutes les conditions.</u></p>
                        <div><Button>S'inscrire</Button></div>
                    </div>
    
                </form>
            </div>

            <a href="#"><img id="loginBTN" onclick="connexionClick(event)" src="..\images\login2.png"></a>
            <!-- connexion box -->
            <div class="connexion">
                <form action="../php/login.php" method="post">
                    <div class="title2">connexion</div>
                    <div class="content" >
                        <p class="title">Email</p>
                        <p class="input"><input type="text" name="email" value=""/></p>
                        <p class="title">Mot de passe</p>
                        <p class="input"><input type="password" name="mdp" value=""/></p>
                        <div><Button>Se connecter</Button></div>
                    </div>
                </form>
                
            </div>
            
            <script src="../js/inscription-connexion.js"></script>

            <?php }; ?>
            
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
    <form method="GET" action="gestion_utilisateurs.php">
    Nom: <input type="text" name="search_nom">
    Prénom: <input type="text" name="search_prenom">
    Email: <input type="email" name="search_email">
    <input type="submit" value="Rechercher">
</form>


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
$sql = "SELECT idUtilisateur, Nom, Prenom, Mail FROM Utilisateur WHERE 1=1";

// Vérifie si des paramètres de recherche existent et ne sont pas vides
$anySearch = false; // Cette variable détermine si une recherche a été effectuée

if (!empty($_GET['search_nom'])) {
    $searchNom = $conn->real_escape_string($_GET['search_nom']);
    $sql .= " AND Nom LIKE '%$searchNom%'";
    $anySearch = true;
}

if (!empty($_GET['search_prenom'])) {
    $searchPrenom = $conn->real_escape_string($_GET['search_prenom']);
    $sql .= " AND Prenom LIKE '%$searchPrenom%'";
    $anySearch = true;
}

if (!empty($_GET['search_email'])) {
    $searchEmail = $conn->real_escape_string($_GET['search_email']);
    $sql .= " AND Mail LIKE '%$searchEmail%'";
    $anySearch = true;
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["idUtilisateur"]."</td><td>".$row["Nom"]."</td><td>".$row["Prenom"]."</td><td>".$row["Mail"]."</td></tr>";
    }
    echo "</table>";
} else {
    // Si une recherche a été effectuée mais aucun résultat n'est trouvé
    if ($anySearch) {
        echo "Aucun résultat trouvé pour votre recherche.";
    } else {
        // Si aucune recherche n'a été effectuée et la table est vide
        echo "0 résultats";
    }
}
$conn->close();
?>

</body>
</html>