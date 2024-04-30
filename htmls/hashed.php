<?php
$mdp = 'mdp123'; // Le mot de passe que vous souhaitez hasher
$hashed_password = password_hash($mdp, PASSWORD_DEFAULT);
echo $hashed_password;
?>
