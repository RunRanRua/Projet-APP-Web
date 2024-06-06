<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma liste de concerts</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/headerv2.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="stylesheet" href="../css/connexion.css"> 
    <link rel="stylesheet" href="../css/myEvenList.css">
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
            <?php if ( $_SESSION["is_admin"] ) { ?>
                <a href="#" > <img src="..\images\admin_icon.png" alt="Profil"> </a>
            <?php } else{ ?>
                <a href="profil.php" > <img src="..\images\user.png" alt="Profil"> </a>
            <?php } ?>

            <a href="..\php\logout.php"> <img src="..\images\Logout.png" alt="Déconnexion"> </a>
            
        </div>
    </div>
    
    <!-- My List -->
    <div class="myList">
            <h1>MES CONCERTS</h1>

            <dl>
                <!-- Ongoing concert -->
                <dt class="ongoingDT" onclick="toggleList(this)">
                    <b>CONCERTS EN COURS</b>
                    <div class="arrow">&#9660;</div>
                </dt>


                <!-- upcoming concert -->
                <dt class="upcomingDT" onclick="toggleList(this)">
                    <b>CONCERT A VENIR</b>
                    <div class="arrow">&#9660;</div>
                </dt>

                <!-- past concert-->
                <dt class="pastDT" onclick="toggleList(this)">
                    <b>CONCERTS PASSES</b>
                    <div class="arrow">&#9660;</div>
                </dt>
            </dl>
          <script src="../js/myEventList.js"></script> 
    </div>

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