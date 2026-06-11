<?php
require_once 'db.php';

// Récupération des produits
$stmt = $pdo->query("SELECT * FROM produits ORDER BY id DESC");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gestion du Stock</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Liste des Produits</h1>
        <a href="ajouter.php" class="btn btn-success">➕ Ajouter un produit</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($produits)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Aucun produit trouvé.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($produits as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p['id']) ?></td>
                            <td><strong><?= htmlspecialchars($p['nom']) ?></strong></td>
                            <td><?= htmlspecialchars($p['description']) ?></td>
                            <td><?= number_format($p['prix'], 2, ',', ' ') ?> €</td>
                            <td>
                                <a href="modifier.php?id=<?= $p['id'] ?>" class="btn btn-warning">Modifier</a>
                                <a href="supprimer.php?id=<?= $p['id'] ?>" class="btn btn-danger" onclick="return confirm('Supprimer ce produit ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>