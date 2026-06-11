<?php
$host = 'localhost';
$dbname = 'magasin';
$username = 'root';
$password = 'password'; // À adapter selon leur configuration (ex: 'root' sur Mac)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Activation des erreurs PDO pour faciliter le débogage des élèves
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
