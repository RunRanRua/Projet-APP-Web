<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Retrieve form data ------------------------------------------------------------------------------------

$nom = $conn->real_escape_string($_POST['nom']);
$prenom = $conn->real_escape_string($_POST['prenom']);
$email = $conn->real_escape_string($_POST['email']);
$numero = $conn->real_escape_string($_POST['numero']);
$mdp = $conn->real_escape_string($_POST['mdp']);
$confirm_mdp = $conn->real_escape_string($_POST['confirm_mdp']);


// Check all condition ------------------------------------------------------------------------------------
    # Condition
if (!isset($_POST['condition'])) {
    echo "Acceptez d'abord les condtions";
    exit;   
}
    # Nom
if (!preg_match('/^[a-zA-Z]+$/', $nom)) {
    echo "Saisissez un vrai nom";
    exit;
}
    # Prenom
if (!preg_match('/^[a-zA-Z]+$/', $prenom)) {
    echo "Saisissez un vrai prénom";
    exit;
}
    # Telephone
if (!preg_match('/^(06|07)\d{8}$/', $numero)) {
    echo "Saisissez un vrai numéro";
    exit;
}
    # Mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Saisissez un vrai mail";
    exit;
}
if (!preg_match('/^[a-zA-Z0-9]{6,22}$/', $mdp)) {
    echo "Vérifiez la taille de ton mot de passe :(6-22)";
    exit;
}
// Check if passwords match
if ($mdp !== $confirm_mdp) {
    echo "Les mots de passe ne correspondent pas.";
    exit;
}

// Verify if mail already existed ------------------------------------------------------------------------------
$verify_sql = "SELECT * FROM utilisateur WHERE Mail = ?";
$verify_stmt = $conn->prepare($verify_sql);
$verify_stmt->bind_param("s",$email);
$verify_stmt->execute();
$verify_result = $verify_stmt->get_result();

if ($verify_result->num_rows > 0) {
    echo "Mail déjà existé";
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
$conn->close();
?>
