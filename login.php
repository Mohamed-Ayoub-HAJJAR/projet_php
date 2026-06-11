<?php
require_once 'db.php';

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password'];

    if (!empty($login) && !empty($password)) {

        // Recherche de l'utilisateur par son login
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE login = ?");
        $stmt->execute([$login]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // VÉRIFICATION DIRECTE (Sans password_verify)
        if ($user && $user['password'] === $password) {
            // Authentification réussie
            header('Location: index.php');
            exit;
        } else {
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