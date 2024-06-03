<?php


// Server Access  ------------------------------------------------------------------------------------
session_start();
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


// Retrievf rm data ------------------------------------------------------------------------------------

# Associer les variables avec ton form
$userId = $_SESSION['user_id'];
$email = $conn->real_escape_string($_POST['mail']);
$mdp = $conn->real_escape_string($_POST['mdp']);


// Check user in our base ---------------------------------------------------------------------------------
# CODE POUR INSREREE 
$sql = "SELECT * FROM Utilisateur WHERE Mail = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows <= 0) {
    // if none
    echo "Contenu n'existe pas";
    exit;
}

// Store in session ---------------------------------------------------------------------------------------------------

$user = $result->fetch_assoc();

if(!password_verify($mdp, $user["Mdp"])){
    echo "mot de passe incorrect.";
    exit;
}

// Redirect to home page
# CHANGER L'EMPLACE header("Location: ../htmls/index.php");
// ------------------------------------------------------------------------------------------------------------

$stmt->close();
$conn->close();




?>