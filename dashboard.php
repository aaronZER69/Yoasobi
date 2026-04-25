<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: connexion.php');  // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    exit();
}

echo "Bienvenue, " . $_SESSION['username'];
?>

<a href="déconnexion.php">Déconnexion</a>
