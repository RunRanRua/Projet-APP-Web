<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion utilisateur</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/FAQ.css">
    <link rel="stylesheet" href="../css/gestion_utilisateurs.css"> <!-- Add this line -->

</head>

<body>
    <!-- === Header Part === -->
    <div class="header">
        <!-- logo -->
        <div class="logo">
            <a href="#"><img src="..\images\logo100px.png"></a>
        </div>

        <!-- navigation -->
        <div class="nav">
            <ul>
                <li><a href="index.php" class = "active"><b>ACCUEIL</b></a></li>
                <li><a href="event.php"><b>EVENEMENT</b></a></li>
                <li><a href="FAQ.php"><b>FAQ</b></a></li>
                <li><a href="#"><b>FORUM</b></a></li>
                <li><a href="a_propos.php"><b>A PROPOS</b></a></li>
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
        
                <a href="..\php\logout.php"> <img src="..\images\Logout.png" alt="Déconnexion"> </a>

            <?php }else{ ?>

            <a href="#"><img src="..\images\signup.png" id="signBTN" onclick="inscriptionClick(event)"></a>
            <!-- inscription box -->
            <div class="inscription" id ="inscription">
                <form action="../php/inscription.php" method="post">
                    <div class="title2">Inscription</div>
                    <div class="content" >
                        <p class="title">Nom</p>
                        <p class="input"><input type="text" name="nom" placeholder="Nom"/></p>
                        <p class="title">Prénom</p>
                        <p class="input"><input type="text" name="prenom" placeholder="Prénom"/></p>
                        <p class="title">Numéro de téléphone</p>
                        <p class="input"><input type="text" name="numero" placeholder="Numéro de téléphone"/></p>
                        <p class="title">Email</p>
                        <p class="input"><input type="text" name="email" placeholder="Email"/></p>
                        <p class = title>Vérification</p>
                        <p class="inputVerif"><input class="verifMail" type="text" name="code" placeholder="Code de vérification"/>  <button class="btnMail" name="sendBTN">Envoyer</button></p>
                        <p class="title">Mot de passe</p>
                        <p class="input"><input type="password" name="mdp" placeholder="Mot de passe"/></p>
                        <p class="title">Confirmation de mot de passe</p>
                        <p class="input"><input type="password" name="confirm_mdp" placeholder="Confirmation de mot de passe"/></p>
                        <p class="condition"><input type="checkbox" name="condition"> <u>J'ai lu et j'accepte toutes les conditions.</u></p>
                        <div><Button name="submitBTN">S'inscrire</Button></div>
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
                        <p class="input"><input type="text" name="email" placeholder="Email" value=""/></p>
                        <p class="title">Mot de passe</p>
                        <p class="input"><input type="password" name="mdp" placeholder="Mot de passe" value=""/></p>
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
        <label>Nom: <input type="text" name="search_nom" placeholder="Nom"></label>
        <label>Prénom: <input type="text" name="search_prenom" placeholder="Prénom"></label>
        <label>Email: <input type="email" name="search_email" placeholder="Email"></label>
        <input type="submit" value="Rechercher">
    </form>

    <h2>Ajouter un Utilisateur</h2>
    <form method="post" action="../php/ajouter_utilisateurs.php">
        <label>Nom: <input type="text" name="nom" placeholder="Nom" required></label><br>
        <label>Prénom: <input type="text" name="prenom" placeholder="Prénom" required></label><br>
        <label>Email: <input type="email" name="email" placeholder="Email" required></label><br>
        <label>Mot de passe: <input type="password" name="mdp" placeholder="Mot de passe" required></label><br>
        <input type="submit" value="Ajouter Utilisateur">
    </form>

    <h2>Liste des Utilisateurs</h2>
<?php
$sql = "SELECT idUtilisateur, Nom, Prenom, Mail FROM utilisateur WHERE 1=1";

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
    echo "<table><thead><tr><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Actions</th></tr></thead><tbody>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["idUtilisateur"]."</td><td>".$row["Nom"]."</td><td>".$row["Prenom"]."</td><td>".$row["Mail"]."</td>";
        // Ajoutez ici le lien de suppression
        echo "<td><button onclick='confirmDelete(".$row["idUtilisateur"].")'>Supprimer</button></td></tr>";    
    }
    echo "</tbody></table>";
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

<script src="../js/gestion_utilisateurs.js"></script> <!-- Add this line -->

</body>
</html>
