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

// Retrieve form data ------------------------------------------------------------------------------------

// Associate variables with your form

?>

<!-- Add your form here -->
<form action="poster.php" method="post">
    Titre du sujet : <input type="text" name="titre" required><br>
    Votre commentaire : <textarea name="commentaire" rows="4" required></textarea><br>
    <input type="submit" value="Poster">
</form>