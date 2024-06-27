<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="stylesheet" href="../css/connexion.css">
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
                <li><a href="event.php"><b>NOS CONCERTS</b></a></li>
                <li><a href="organiserEVENT.php"><b>ORGANISATION</b></a></li>
                <li><a href="FAQ.php"><b>FAQ</b></a></li>
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

    <!-- === Event Part === -->
    <div class="event">
        <div class="bgEffet">
            <div class="box1">
                <img src="../images/fleche.PNG" alt="picture">
                <div class="txt">Nouvel évènement 7 - 13 juillet</div>
            </div>

            <div class="box2">
                <div class="title">Audio Insights</div>
            </div>

        </div>
    </div>
    
    <!-- === Concert Part === -->
    <div class="concert">
        <div class="upBox">
            <div class="innerbox">
                <div class="txt">Battle beast<br>vendredi 09 juillet 2024</div>
                <div class="location">Alhambra - AudioInsights, Paris, France</div>
                <a href="event.php"><img src="../images/voir plus.png"></a>
            </div>
            <img src="../images/concert4.jpg" alt="concert1">

        </div>

        <div class="downBox">
            <img src="../uploads/concert_1.png" alt="concert1">
            <div class="innerbox">
                <div class="txt">Battle beast<br>Samedi 10 août 2024</div>
                <div class="location">Rihanna - AudioInsights, Paris, France</div>
                <a href="event.php"><img src="../images/voir plus.png"></a>
            </div>
        </div>
    </div>
    
    <!-- === Avis Part === -->
    <div class="avis">
        <img src="../images/avis.png">
        <div class="contents">
            <div class="content">
                <img src="../images/avis-2.png" class="icon">
                <img src="../uploads/stars.png" class="stars">
                <div class="topic">Concert génial</div>
                <div class="txt">L'événement a été tout simplement exceptionnel. L'atmosphère était magique avec des jeux de lumières impressionnants !</div>
                <div class="author">Marcel Sanchez</div>

            </div>
            <div class="content">
                <img src="../images/avis-2(1).png" class="icon">
                <img src="../uploads/stars.png" class="stars">
                <div class="topic">Soirée mémorable</div>
                <div class="txt">La soirée était mémorable, l'ambiance était folle : les effets de lumière,et la performance des artistes étaient au-delà de mes attentes !</div>
                <div class="author">Lucas Dupont</div>

            </div>
            <div class="content">
                <img src="../uploads/avis-icon.png" class="icon">
                <img src="../uploads/stars.png" class="stars">
                <div class="topic">Concert incroyable</div>
                <div class="txt">Le concert était vraiment incroyable, l’ambiance était parfaite : les lumières, le son, les artistes !</div>
                <div class="author">Jenna Johnson</div>

            </div>
        </div>
    </div>

    <!-- === Background part === -->
    <div class="background"></div>

    <!-- Footer Part-->
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
                <li><a href="FAQ.php"><b>FAQ</b></a></li>
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
</body>
</html>