<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'acceuil</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="stylesheet" href="../css/connexion.css">
    <link rel="stylesheet" href="../css/a_propos.css">
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
                <li><a href="event.php"><b>NOS CONCERTS</b></a></li>
                <li><a href="organiserEVENT.php"><b>ORGANISATION</b></a></li>
                <li><a href="FAQ.php"><b>FAQ</b></a></li>
                <li><a href="a_propos.php" class = "active"><b>A PROPOS</b></a></li>
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
                   <a href="test.php" > <img src="..\images\admin_icon.png" alt="Profil"> </a>
                <?php } else{ ?>
                    <a href="profil.php" > <img src="..\images\user.png" alt="Profil"> </a>
                <?php } ?>
        
                <a href="..\php\logout.php"> <img src="..\images\Logout.png" alt="Déconnexion"> </a>

            <?php }else{ ?>

            <a href="#"><img src="..\images\INSCRIPTION1.png" id="signBTN" onclick="inscriptionClick(event)"></a>
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

            <a href="#"><img id="loginBTN" onclick="connexionClick(event)" src="..\images/INSCRIPTION(6).png"></a>
            <!-- connexion box -->
            <div class="connexion">
                <form action="../php/login.php" method="post">
                    <div class="title2">Connexion</div>
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

    <!-- Company -->
    <div id="company-intro">
        <div class="left">
            <img src="..\images\logo.png" alt="CompanyLogo" class="companylogo">
        </div>
        <div class="right">
            <h1>Profil de l'entreprise</h1>
            <p>Depuis sa création, il est l'un des principaux promoteurs d'événements culturels à Paris. Nous proposons des services de location de salles de concert de premier ordre, adaptés à tous les types de concerts, de représentations théâtrales et d'autres événements artistiques. Nos salles de concert sont équipées de systèmes de sonorisation de pointe et de sièges confortables afin de garantir à chaque spectateur une expérience visuelle exceptionnelle.

                En plus de nos installations de haute qualité, Audio Insights dispose d'une équipe de gestion expérimentée qui se consacre à fournir à nos clients un service d'organisation d'événements sans faille. De la planification à l'exécution, nous veillons à ce que chaque détail soit minutieusement organisé pour que votre événement soit parfait.

                Qu'il s'agisse d'un grand concert ou d'une fête privée, Audio Insights est le choix idéal. Nous sommes idéalement situés au [17 Rue Washington, 75008 Paris], qui est facilement accessible et proche de l'un des lieux culturels les plus emblématiques de Paris.</p>
        </div>
    <div>


    <!-- Concert -->
    <div id="hall-intro">
        <div class="container">
            <div class="left">
                <img src="..\images\concert-hall.jpg" alt="concert_hall" class="hall-image">
            </div>
            <div class="right">
                        <h1>Notre salle de concert</h1>
                        <p>La salle de concert internationale Audio Insights est située près des Champs Elysées, c'est actuellement l'une des salles de concert les plus célèbres de Paris, la salle est ovale, avec un style architectural unique ; le bâtiment de la salle selon les principes acoustiques modernes de conception et de décoration, et pour atteindre la performance de la nécessité d'aucun système de renforcement du son électronique, pour assurer que la performance du son de l'effet réel, merveilleux, émouvant ; il y a 40 positions d'éclairage, peut jouer un très bon effet de lumière en direct ! La salle de concert peut accueillir des orchestres symphoniques, des orchestres nationaux, des orchestres de musique de chambre, des solistes, des solistes, des défilés de mode et d'autres types de spectacles artistiques élégants. Lorsque vous pénétrez dans cette salle de concert noble et élégante, vous profitez pleinement du charme de l'art élégant ! En pénétrant dans cette salle de concert élégante et noble, vous apprécierez pleinement le charme apporté par l'art élégant.</p>
            </div>
        </div>
    </div>

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
                <li><a href="FAQ.html"><b>FAQ</b></a></li>
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
                    <a href="#"><img src="..\images/reseausociauxvYT22x22.png" ></a>
                </div>
            </ul4>

        </div>
    </div>

<body>
</html>