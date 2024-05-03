<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function submitOnclick($conn){
    // Retrieve form data ------------------------------------------------------------------------------------

    $nom = $conn->real_escape_string($_POST['nom']);
    $prenom = $conn->real_escape_string($_POST['prenom']);
    $email = $conn->real_escape_string($_POST['email']);
    $numero = $conn->real_escape_string($_POST['numero']);
    $mdp = $conn->real_escape_string($_POST['mdp']);
    $confirm_mdp = $conn->real_escape_string($_POST['confirm_mdp']);
    $code = $conn->real_escape_string($_POST['code']);

    // Check all condition ------------------------------------------------------------------------------------
        # Condition
    if (!isset($_POST['condition'])) {
        echo "Acceptez d'abord les condtions";
        $conn->close();
        exit;   
    }
        # Nom
    if (!isset($nom) || !preg_match('/^[a-zA-Z]+$/', $nom)) {
        echo "Saisissez un vrai nom";
        $conn->close();
        exit;
    }
        # Prenom
    if (!isset($prenom) || !preg_match('/^[a-zA-Z]+$/', $prenom)) {
        echo "Saisissez un vrai prénom";
        $conn->close();
        exit;
    }
        # Telephone
    if (!isset($numero) || !preg_match('/^(06|07)\d{8}$/', $numero)) {
        echo "Saisissez un vrai numéro";
        $conn->close();
        exit;
    }
        # Mail
    if (!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Saisissez un vrai mail";
        $conn->close();
        exit;
    }
        # code
    if ( !isset($code) || !isset($_SESSION["code"]) ||         
         $code !== (string)$_SESSION["code"] ||
         $email !== $_SESSION["code_receiver"]) {
        echo "Votre code de vérification est fausse";
        $conn->close();
        exit;
    }
        # password
    if (!isset($mdp) || !preg_match('/^[a-zA-Z0-9]{6,22}$/', $mdp)) {
        echo "Vérifiez la taille de votre mot de passe :(6-22)";
        $conn->close();
        exit;
    }
    // Check if passwords match
    if ($mdp !== $confirm_mdp) {
        echo "Les mots de passe ne correspondent pas.";
        $conn->close();
        exit;
    }

    // Verify if mail already existed ------------------------------------------------------------------------------
    $verify_sql = "SELECT * FROM Utilisateur WHERE Mail = ?";
    $verify_stmt = $conn->prepare($verify_sql);
    $verify_stmt->bind_param("s",$email);
    $verify_stmt->execute();
    $verify_result = $verify_stmt->get_result();

    if ($verify_result->num_rows > 0) {
        echo "Mail déjà existé";
        $conn->close();
        exit;
    }

    // Prepare user insertion --------------------------------------------------------------------------------------

    $hashed_password = password_hash($mdp, PASSWORD_DEFAULT);
    $date_inscription = date("Y-m-d");  // Get current date

    $sql = "INSERT INTO Utilisateur (Nom, Prenom, Mail, Numero, Mdp, Date_inscription) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $nom, $prenom, $email, $numero, $hashed_password, $date_inscription);

    // Execute insertion -------------------------------------------------------------------------------------------

    if ($stmt->execute()) {
        echo "<script>alert('Inscription réussie!'); window.location.href='../htmls/index.php';</script>";
    }
    // else
    else {
        echo "Erreur lors de l'inscription : " . $stmt->error;
    }

    // ------------------------------------------------------------------------------------------------------------
    $stmt->close();
}


function check_and_delete_expired_verification_code() {
    if(isset($_SESSION['code_expire_time']) && $_SESSION['code_expire_time'] < time()) {
        
        unset($_SESSION['code']);
        unset($_SESSION['code_expire_time']);
        unset($_SESSION['code_receiver']);
    }
}

function sendOnclick($conn){
    // retrieve data
    $mail = $conn->real_escape_string($_POST['email']);

    // check mail format
    if (!isset($mail) || !filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "Saisissez un vrai mail";
        $conn->close();
        exit;
    }

    // prepare mail
    $code = random_int(100000, 999999);
    $expire_time = time() + (5 * 60);

    $subject = "Code de verification";
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
}


// Server Access  ------------------------------------------------------------------------------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



if (isset($_POST['sendBTN'])){
    sendOnclick($conn);
}elseif (isset($_POST['submitBTN'])){
    check_and_delete_expired_verification_code();
    submitOnclick($conn);
}

// Redirect to home page
header("Location: ../htmls/index.php");
$conn->close();
?>
