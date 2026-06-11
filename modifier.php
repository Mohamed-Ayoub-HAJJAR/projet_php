<?php
require_once 'db.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// On vérifie d'abord si le produit existe
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    die("Produit introuvable.");
}

$erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $prix = floatval($_POST['prix']);

    if (!empty($nom) && $prix > 0) {
        $stmt = $pdo->prepare("UPDATE produits SET nom = :nom, description = :description, prix = :prix WHERE id = :id");
        $stmt->execute([
            'nom' => $nom,
            'description' => $description,
            'prix' => $prix,
            'id' => $id
        ]);
        header('Location: index.php');
        exit;
    } else {
        $erreur = "Veuillez remplir correctement les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier le Produit</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Modifier le produit : <?= htmlspecialchars($produit['nom']) ?></h1>
        <a href="index.php" class="btn">⬅️ Retour</a>

        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger"><?= $erreur ?></div>
        <?php endif; ?>

        <form action="modifier.php?id=<?= $id ?>" method="POST">
            <div class="form-group">
                <label for="nom">Nom du produit :</label>
                <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($produit['nom']) ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" rows="4"><?= htmlspecialchars($produit['description']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="prix">Prix (€) :</label>
                <input type="number" id="prix" name="prix" step="0.01" min="0" value="<?= htmlspecialchars($produit['prix']) ?>" required>
            </div>
            <button type="submit" class="btn btn-warning">Mettre à jour</button>
        </form>
    </div>
</body>

</html>