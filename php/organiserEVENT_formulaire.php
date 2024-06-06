<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
    // check
    if (!isGoodFormat()){
        exit;
    }
    // retrieve data
    $titre =htmlspecialchars($_POST['titre']);
    $artiste =htmlspecialchars($_POST['artiste']);
    $categorie =htmlspecialchars($_POST['categorie']);
    $date =htmlspecialchars($_POST['date']);
    $start_h =htmlspecialchars($_POST['start_h']);
    $start_m =htmlspecialchars($_POST['start_m']);
    $end_h =htmlspecialchars($_POST['end_h']);
    $end_m =htmlspecialchars($_POST['end_m']);
    $description = htmlspecialchars($_POST['description']);
    //$icon = htmlspecialchars($_POST['icon']); 

    sendMail($titre, $artiste, $categorie, $date, $start_h, $start_m, $end_h, $end_m, $description);
    
}

function getImage(){
}

function isGoodFormat(){
    if( !isset($_POST['titre']) ||
        !isset($_POST['artiste']) ||
        !isset($_POST['categorie']) ||
        !isset($_POST['date']) ||
        !isset($_POST['start_h']) ||
        !isset($_POST['start_m']) ||
        !isset($_POST['end_h']) ||
        !isset($_POST['end_m']) ||
        !isset($_POST['description'])
    ){
        echo "Veuillez remplir le formulaire";
        return false;
    }
    return true;
}
function sendMail($titre, $artiste, $categorie, $date, $start_h, $start_m, $end_h, $end_m, $description){
    $mail = "mati62025@eleve.isep.fr";
    $subject = "[Formulaire]- Demande de l'Organisation d'un événement";
    $message = "Titre : " . $titre . "\n".
                "Artiste : " . $artiste . "\n".
                "Categorie : " . $categorie . "\n".
                "Date : " . $date . "\n".
                "Debut d'heure : " . $start_h . ":". $start_m ."\n".
                "Fin d'heure : " . $end_h . ":". $end_m ."\n".
                "Description : " . $description;
        
    $from = "no-reply@audioInsights.com";
    $headers = "From:" . $from;
    
    // send mail
    if( mail($mail,$subject,$message,$headers)){
        echo "Le formulaire a été envoyé !";
        return true;
    
    }else{
        echo "le formulaire n'a pas été envoyé !";
        return false;
    }
}

/*
// retrieve data
$mail = real_escape_string($_POST['email']);

// check mail format
if (!isset($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    echo "Saisissez un vrai mail";
    $conn->close();
    exit;
}

// prepare mail
$subject = "Demande pour l'organiser un événement";
$message = "Vous êtes en train de vous inscrire sur notre site web.\n\n"
        . "Voici le code de vérification :\n"
        .$code ."\n\n"
        . "Attention: ce code va être expiré dans 5 minutes.";

$from = "no-reply@audioInsights.com";
$headers = "From:" . $from;

// send mail
if( mail($mail,$subject,$message,$headers)){
    $_SESSION["code"] = $code;
    $_SESSION['code_expire_time'] = $expire_time;
    $_SESSION["code_receiver"] = $mail;

    return $code;

}else{
    echo "le mail n'a pas été envoyé";

    $conn->close();
    exit;
}
*/
?>