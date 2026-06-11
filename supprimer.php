<?php
require_once 'db.php';

// On s'assure d'avoir un ID valide
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");
    $stmt->execute([$id]);
}

// Redirection instantanée vers la liste
header('Location: index.php');
exit;
