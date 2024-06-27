<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon profil</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/profil.css">
    <link rel="stylesheet" href="../css/modifyMDP.css">
    <link rel="stylesheet" href="../css/modifyTEL.css">
    <link rel="stylesheet" href="../css/profil_deleteUser.css">
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
                <li><a href="index.php"><b>ACCUEIL</b></a></li>
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
                   <a href="gestion_utilisateurs.php" > <img src="..\images\admin_icon.png" alt="Profil"> </a>
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


    <div class="profil">
        <div class="title">Bienvenue, <?php echo $_SESSION["prenom"] ?></div>
        <div class="user">
            <div class="left">
            <?php if ( $_SESSION["is_admin"] ) { ?>
                <img src="../images/admin_icon.png" alt="Icon">
            <?php } else{ ?>
                <img src="../images/user.png" alt="Icon">
            <?php } ?>
                <p>
                    <b>ID : <?php echo $_SESSION["user_id"] ?></b> 
                </p>
                <p>
                    <b>Date d'inscription: <?php echo $_SESSION["date"] ?></b>
                </p>
                <form id="form-tester-trame" onsubmit="return false;">

<input type="hidden" name="send_trame" value="1">

<input type="hidden" name="idCapteurSonore" value="<?php echo $capteur['idCapteurSonore']; ?>">

<input type="button" id="tester-trame-btn" class="sanjai" value="Tester la trame">

</form>                <button><a href='./dashboard2.html'>Graphique niveau sonore</a></button>
                <button><a href='./dashboard.html'>Graphique températures</a></button>

            </div>

            <div class="right">
                <li><b>Nom :</b>  <?php echo $_SESSION["nom"] ?></li>
                <li><b>Prénom :</b>  <?php echo $_SESSION["prenom"] ?></li>
                <li><b>Mail :</b>  <?php echo $_SESSION["email"] ?></li>
                <li>
                    <b>N° de Tel :</b>  <?php echo $_SESSION["numero"] ?>
                    <button id="modifyTEL" onclick="TELonClick(event)"> Modifier </button>
                </li>
                <li>
                    <b>Mot de passe :</b>  <i>***********</i>
                    <button id="modifyMDP" onclick="MDPonClick(event)"> Modifier </button>
                </li>
            </div>    
        </div>
    </div>


    <div class="bg"></div>
    <!-- modify MDP box -->
    <div class="modifyMDP">
        <form action="..\php\modifyMDP.php" method="post">
            <div class="title2">Changer le mot de passe</div>
            <div class="content" >
                <p class="title">Ancien Mot de passe</p>
                <p class="input"><input type="password" name="mdp" value=""/></p>

                <p class="title">Nouveau Mot de passe</p>
                <p class="input"><input type="password" name="new_mdp" value=""/></p>

                <p class="title">Confirmerle mot de passe</p>
                <p class="input"><input type="password" name="confirm_mdp" value=""/></p>

                <div><Button >Modifier</Button></div>
            </div>
        </form>
    </div>

    <!-- modify phone number box -->
    <div class="modifyTEL">
        <form action="..\php\modifyTEL.php" method="post">
            <div class="title2">Changer le numéro de téléphone</div>
            <div class="content" >
                <p class="title">Nouveau numéro de téléphone</p>
                <p class="input"><input type="text" name="numero" value=""/></p>
                <div><Button >Modifier</Button></div>
            </div>
        </form>
    </div>

    <div class="deleteUser">
        <form action="..\php\profil_deleteUser.php" method="post">
            <div class="title2">Vous êtes sûr de supprimer votre compte ?</div>
            <div class="content" >
                <div><Button >Supprimer</Button></div>
            </div>
        </form>
    </div>
    

    <script src="../JS/profil.js"></script>




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