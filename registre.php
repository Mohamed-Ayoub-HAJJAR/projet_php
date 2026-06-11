<?php
require_once 'db.php';

$message = "";
$type_message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = $_POST['password']; // Stockage brut
    $nom = trim($_POST['nom']);

    if (!empty($login) && !empty($password) && !empty($nom)) {
        try {
            // 1. On hache le mot de passe de manière sécurisée
            $passwordHache = password_hash($password, PASSWORD_DEFAULT);

            // 2. On prépare la requête
            $stmt = $pdo->prepare("INSERT INTO user (login, password, nom) VALUES (:login, :password, :nom)");

            // 3. On insère le mot de passe HACHÉ en base de données
            $stmt->execute([
                'login'    => $login,
                'password' => $passwordHache, // <--- Sécurisé !
                'nom'      => $nom
            ]);

            $message = "Utilisateur créé avec succès !";
            $type_message = "success";
        } catch (PDOException $e) {
            $message = "Ce login est déjà utilisé.";
            $type_message = "danger";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
        $type_message = "danger";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container" style="max-width: 450px; margin-top: 50px;">
        <h2>Inscription Éléve / Prof</h2>
        <a href="login.php" class="btn">⬅️ Connexion</a>
        <br><br>

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?= $type_message ?>"><?= $message ?></div>
        <?php endif; ?>

        <form action="registre.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom Complet :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="login">Login (Identifiant) :</label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success" style="width: 100%;">S'inscrire</button>
        </form>
    </div>
</body>

</html>