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

$email = $conn->real_escape_string($_POST['email']);
$mdp = $conn->real_escape_string($_POST['mdp']);


// Check user in our base ---------------------------------------------------------------------------------
$sql = "SELECT * FROM utilisateur WHERE Mail = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows <= 0) {
    // if none
    echo "Mail n'existe pas";
    exit;
}

// Store in session ---------------------------------------------------------------------------------------------------

$user = $result->fetch_assoc();

if(!password_verify($mdp, $user["Mdp"])){
    echo "mot de passe incorrect.";
    exit;
}

$_SESSION['user_id'] = $user['idUtilisateur'];
$_SESSION['nom'] = $user['Nom'];
$_SESSION['prenom'] = $user['Prenom'];
$_SESSION['email'] = $email;
$_SESSION['is_admin'] = $user['isAdmin'];
$_SESSION['date'] = $user['Date_inscription'];
$_SESSION['numero'] = $user['Numero'];

// Redirect to home page
header("Location: ../htmls/index.php");
// ------------------------------------------------------------------------------------------------------------

$stmt->close();
$conn->close();
?>