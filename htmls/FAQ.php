<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="stylesheet" href="../css/connexion.css">
    <link rel="stylesheet" href="../css/FAQ.css">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="stylesheet" href="../css/connexion.css">
</head>
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
                <li><a href="index.php" ><b>ACCUEIL</b></a></li>
                <li><a href="event.php"><b>EVENEMENT</b></a></li>
                <li><a href="FAQ.php" class = "active"><b>FAQ</b></a></li>
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
        
                <a href="..\php\logout.php"> <img src="..\images\Logout.png" alt="Déconnexion"> </a>

            <?php }else{ ?>

            <a href="#"><img src="..\images\signup.png" id="signBTN" onclick="inscriptionClick(event)"></a>
            <!-- inscription box -->
            <div class="inscription" id ="inscription">
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
                        <p class="inputVerif"><input class="verifMail" type="text" name="code"/>  <button class="btnMail" name="sendBTN">Envoyer</button></p>
                        <p class="title">Mot de passe</p>
                        <p class="input"><input type="password" name="mdp"/></p>
                        <p class="title">Confirmation de mot de passe</p>
                        <p class="input"><input type="password" name="confirm_mdp"/></p>
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

<section class="faq-section">
    <h1>DES QUESTIONS ?</h1>
    <div class="search-container">
        <input type="search" id="search-input" placeholder="Rechercher un concert">
        <a href="#" id="search-icon-link">
            <img src="..\images\loop_gray.png" alt="Rechercher" id="search-icon">
        </a>
    </div>



    <div class="faq-container">
        <h2 class="faq-title">Question recurrentes</h2>
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer1')">Question I <span class="arrow">&#9660;</span></button>
                <div id="answer1" class="faq-answer">Réponse à la question I.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer2')">Question II <span class="arrow">&#9660;</span></button>
                <div id="answer2" class="faq-answer">Réponse à la question II.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer3')">Question III <span class="arrow">&#9660;</span></button>
                <div id="answer3" class="faq-answer">Réponse à la question III.</div>
            </div>
            <div class="faq-item">
                <button class="faq-question" onclick="toggleAnswer('answer4')">Question IV <span class="arrow">&#9660;</span></button>
                <div id="answer4" class="faq-answer">Réponse à la question IV.</div>
            </div>
            <!-- Repeat this block for other questions -->
        </div>
    </div>


</section>

<!-- === Footer Part === -->
<div class="footer">

    <!-- logo -->
    <div class="logo">
        <h1>
            <a href="#">logo</a>
        </h1>
    </div>

    <div class="annotation">
        <li><a href="#"><b>© 2024 Events-IT. Tous droits réservés.</b></a></li>
    </div>

    <!-- navigation -->
    <div class="nav">

        <ul1>
            <li><a href="#"><b>FAQ</b></a></li>
            <li><a href="#"><b>FORUM</b></a></li>
            <li><a href="#"><b>CONTACT</b></a></li>
        </ul1>

        <ul2>
            <li><a href="#"><b>CGU - CGV</b></a></li>
            <li><a href="#"><b>MENTIONS LÉGALES</b></a></li>
            <li><a href="#"><b>POLITIQUE DE CONFIDENTIALITÉ</b></a></li>
        </ul2>

        <ul3>
            <li><a href="#" class="title"><b>ADRESSE</b></a></li>
            <li class="li2"><a href="#" class="supp">28 Rue Notre Dame des Champs, 75006 Paris, France</a></li>
            <li class="li2"><a href="#" class="supp">events-it@events-it.com </a></li>
            <li class="li2"><a href="#" class="supp">01 23 45 67 89 </a></li>
        </ul3>

        <ul4>
            <li><a href="#" class="title"><b>NEWSLETTER</b></a></li>
            <div class="search">
                <a href="#"><img src="..\images\sendv6.png" ></a>
                <input type="text" placeholder="EMAIL">
            </div>
            <div class="sociaux">
                <a href="#"><img src="..\images\reseausociauxv2Insta22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxv2FB22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxv2Tik22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxv2Twitt22x22.png" ></a>
                <a href="#"><img src="..\images\reseausociauxvYT22x22.png" ></a>
            </div>
        </ul4>

    </div>
</div>
</body>
<script src="../JS/script.js"></script>
</html>
