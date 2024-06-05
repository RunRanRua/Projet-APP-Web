<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Concerts</title>
    <link rel="stylesheet" href="../css/base.css">
    <link rel="stylesheet" href="../css/test.css">
    <link rel="stylesheet" href="../css/ms_concerts.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>


<body>
    
    <!-- === Header Part === -->
    <div class="header">
        <!-- logo -->
        <div class="logo">
            <a href="#"><img src="..\images\logo100px.png"></a>
        </div>

        <!-- navigation -->
        <div class = "nav">
            <li><a href="#"><b>ACCUEIL</b></a></li>
            <li><a href="#"><b>PLANNING</b></a></li>
            <li class = "DropExp">
                <a href="#"><b>EVENEMENT</b></a>
                <ul class="DropExpContent">
                    <li><a href="#">ANNONCE</a></li>
                    <li><a href="#">ORGANISER UN EVENEMENT</a></li>
                </ul>
            </li>
            <li class = "DropExp">
                <a href="#"><b>ASSISTANCE</b></a>
                <ul class="DropExpContent">
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">FORUM</a></li>
                    <li><a href="#">AVIS</a></li>
                </ul>
            </li>
            <li class = "DropExp">
                <a href="#"><b>A PROPOS</b></a>
                <ul class="DropExpContent">
                    <li><a href="#">NOTRE SALLE</a></li>
                    <li><a href="#">NOUS CONTACTER</a></li>
            </li>
        </div>
    
        
        <!-- langue -->
        <div class = "langue">
            <a href="#"><img src="..\images\royaume-uni.png"></a>
        </div>
    
       
    </div>




    <!-- === Mes Concerts Part === -->
    <div class="concerts">  
        
        <div class = "titre">
            <h1><b>MES CONCERTS</b></h1>
        </div>

        <div class = "section">
            <div>
                <h2>CONCERT EN COURS</h2>
                <?php foreach ($concerts['current'] as $concert): ?>
                    <div class="concert" onclick="showDetails(<?php echo $concert['id']; ?>)">
                        <?php echo htmlspecialchars($concert['nom']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div>
                <h2>CONCERTS À VENIR</h2>
                <?php foreach ($concerts['upcoming'] as $concert): ?>
                    <div class="concert" onclick="showDetails(<?php echo $concert['id']; ?>)">
                        <?php echo htmlspecialchars($concert['nom']); ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div>
                <h2>CONCERTS PASSÉS</h2>
                <?php foreach ($concerts['past'] as $concert): ?>
                    <div class="concert" onclick="showDetails(<?php echo $concert['id']; ?>)">
                        <?php echo htmlspecialchars($concert['nom']); ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <div id="popup" class="popup">
                <div id="popup-content" class="popup-content">
                    <span id="popup-close" class="popup-close">&times;</span>
                    <div id="popup-details"></div>
                </div>
            </div>

            <h2><b>CONCERT EN COURS</b></h2>
            <a href="#"><img src="..\images\loop.png"></a>
            <h2><b>CONCERTS À VENIR</b></h2>
            <a href="#"><img src="..\images\loop.png"></a>
            <h2><b>CONCERTS PASSÉ</b></h2>
            <a href="#"><img src="..\images\loop.png"></a>
        </div>
        
    </div>






    <!-- === Footer Part === -->
    <div class="footer">

        <!-- logo -->
        <div class="logo">
            <h1>
                <a href="#"><img src="..\images\logo.png"></a>
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
                    <a href="#"><img src="..\images/reseausociauxvYT22x22.png" ></a>
                </div>
            </ul4>
 
        </div>
    </div>
</body>
</html>