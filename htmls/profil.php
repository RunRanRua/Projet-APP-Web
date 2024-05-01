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
                <li><a href="#" class = "active"><b>ACCUEIL</b></a></li>
                <li><a href="#"><b>EVENEMENT</b></a></li>
                <li><a href="FAQ.html"><b>FAQ</b></a></li>
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
            <?php if ( $_SESSION["is_admin"] ) { ?>
                <a href="#" > <img src="..\images\admin_icon.png" alt="Profil"> </a>
            <?php } else{ ?>
                <a href="profil.html" > <img src="..\images\user.png" alt="Profil"> </a>
            <?php } ?>

            <a href="..\php\logout.php"> <img src="..\images\LogOut.png" alt="Déconnexion"> </a>
            
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
                <button>Supprimer le compte</button>
            </div>

            <div class="right">
                <li><b>Nom :</b>  <?php echo $_SESSION["nom"] ?></li>
                <li><b>Prénom :</b>  <?php echo $_SESSION["prenom"] ?></li>
                <li><b>Mail :</b>  <?php echo $_SESSION["email"] ?></li>
                <li>
                    <b>N° de Tel :</b>  <?php echo $_SESSION["numero"] ?>
                    <button> Modifier </button>
                </li>
                <li>
                    <b>Mot de passe :</b>  <i>***********</i>
                    <button id="modifyMDP"> Modifier </button>
                </li>
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

</body>
</html>