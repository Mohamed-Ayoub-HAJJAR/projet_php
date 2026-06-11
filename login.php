<?php
require_once 'db.php';

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) {

        // 1. Recherche de l'utilisateur par son login (avec paramètre nommé :login)
        $stmt = $pdo->prepare("SELECT * FROM user WHERE login = :login");
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // 2. VÉRIFICATION SÉCURISÉE 
        // password_verify vérifie si le mot de passe saisi correspond au hachage stocké
        if ($user && password_verify($password, $user['password'])) {

            // Authentification réussie
            // (Optionnel : pense à démarrer une session ici si ce n'est pas fait : $_SESSION['user'] = $user;)
            header('Location: index.php');
            exit;
        } else {
            // Sécurité : On garde le même message que le login soit faux ou le mot de passe soit faux
            $erreur = "Login ou mot de passe incorrect.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" style="max-width: 400px; margin-top: 100px;">
        <h2>Connexion</h2>

        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="login">Login :</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success" style="width: 100%;">Se connecter</button>
        </form>
        <br>
        <p style="text-align: center;"><a href="registre.php">Créer un compte</a></p>
    </div>
</body>

</html>