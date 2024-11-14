<?php
// Configuration de la base de données
define('DB_HOST', 'localhost'); // Hôte de la base de données (localhost pour les environnements locaux)
define('DB_NAME', 'consulat'); // Nom de la base de données
define('DB_USER', 'manflow'); // Nom d'utilisateur de la base de données
define('DB_PASSWORD', 'manflow'); // Mot de passe de la base de données

// Tentative de connexion à la base de données avec PDO
try {
    // Connexion à la base de données via PDO
    $pdo = new PDO('pgsql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    
    // Définir l'option pour afficher les erreurs sous forme d'exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connexion réussie à PostgreSQL";
    
    
} catch (PDOException $e) {
    // Si la connexion échoue, afficher l'erreur
    die("Erreur de connexion à PostgreSQL : " . $e->getMessage());
}
?>
