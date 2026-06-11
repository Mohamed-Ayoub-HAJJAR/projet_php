<?php
require_once 'db.php';

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $prix = floatval($_POST['prix']);

    // Validation simple
    if (!empty($nom) && $prix > 0) {
        $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix) VALUES (:nom, :description, :prix)");
        $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix
        ]);
        // Redirection vers l'accueil après l'ajout
        header('Location: index.php');
        exit;
    } else {
        $erreur = "Veuillez remplir correctement les champs obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un Produit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Ajouter un nouveau produit</h1>
        <a href="index.php" class="btn">⬅️ Retour à la liste</a>

        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?>

        <form action="ajouter.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom du produit * :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="prix">Prix (€) * :</label>
                <input type="number" id="prix" name="prix" step="0.01" min="0" required>
            </div>
            <button type="submit" class="btn btn-success">Enregistrer le produit</button>
        </form>
    </div>
</body>

</html>