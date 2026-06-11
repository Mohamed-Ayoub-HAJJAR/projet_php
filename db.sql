CREATE DATABASE IF NOT EXISTS magasin;
USE magasin;

CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    cree_le TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO produits (nom, description, prix) VALUES
('Ordinateur Portable', 'PC Portable 15 pouces, 16 Go RAM, 512 Go SSD.', 899.99),
('Souris Sans Fil', 'Souris ergonomique avec récepteur USB et batterie rechargeable.', 25.50),
('Clavier Mécanique', 'Clavier RGB avec switchs rouges pour le développement ou le jeu.', 79.90),
('Écran 27 Pouces', 'Moniteur 4K IPS idéal pour le multicompte et le code.', 249.00),
('Casque Audio Bluetooth', 'Casque avec réduction de bruit active et micro intégré.', 120.00),
('Disque Dur Externe', 'Stockage portable de 2 To en USB 3.0.', 65.00),
('Clé USB 64 Go', 'Clé USB 3.1 ultra rapide pour transférer vos fichiers.', 12.99),
('Tapis de Souris XXL', 'Tapis de souris étendu protégeant tout le bureau.', 19.95),
('Support d''Ordinateur', 'Support en aluminium ventilé et ajustable en hauteur.', 34.99),
('Enceintes PC', 'Système audio 2.1 avec caisson de basses compact.', 45.00);

CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nom VARCHAR(100) NOT NULL
);