<?php
// connexion.php
session_start();

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'yoasobi';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['mdp'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];

        // Vérification des informations de connexion
        $stmt = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mdp, $user['mdp'])) {
            $_SESSION['utilisateur'] = $user['email'];
            header('Location: yoasobi.html'); // Redirection vers la page principale
            exit;
        } else {
            $error = "Identifiants incorrects";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] === 'deconnexion') {
    session_destroy();
    header('Location: yoasobi.html');
    exit;
}
?>

<!-- HTML pour le formulaire de connexion -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php if (isset($_SESSION['utilisateur'])): ?>
        <p>Bienvenue, <?= htmlspecialchars($_SESSION['utilisateur']); ?> !</p>
        <a href="?action=deconnexion">Se déconnecter</a>
    <?php else: ?>
        <form method="post" action="">
            <input type="email" name="email" placeholder="Votre Email" required>
            <input type="password" name="mdp" placeholder="Votre Mot de Passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
    <?php endif; ?>
</body>
</html>
