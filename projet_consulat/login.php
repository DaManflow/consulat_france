<?php
// Démarrage de la session
session_start();

// Inclusion du fichier de configuration de la base de données
require_once 'config.php';

// Déclaration des variables pour stocker l'e-mail et les erreurs
$email = '';
$password = '';
$errors = [];

// Traitement du formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validation de l'email
    if (empty($email)) {
        $errors[] = "L'adresse email est requise.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'adresse email n'est pas valide.";
    }

    // Validation du mot de passe
    if (empty($password)) {
        $errors[] = "Le mot de passe est requis.";
    }

    // Si aucune erreur, on procède à la vérification de l'email et du mot de passe
    if (empty($errors)) {
        try {
            // Connexion à la base de données
            $pdo = new PDO("pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête pour récupérer l'utilisateur par son email
            $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Si l'utilisateur existe et que le mot de passe est valide
            if ($user && password_verify($password, $user['mot_de_passe'])) {
                // Connexion réussie, on démarre la session et on redirige
                $_SESSION['user_id'] = $user['id'];  // On stocke l'ID de l'utilisateur en session
                $_SESSION['email'] = $user['email']; // On stocke l'email de l'utilisateur
                header("Location: profile.php");      // Redirection vers la page du profil
                exit();
            } else {
                // Si l'utilisateur n'existe pas ou le mot de passe est incorrect
                $errors[] = "Email ou mot de passe incorrect.";
            }
        } catch (PDOException $e) {
            $errors[] = "Erreur de connexion à la base de données : " . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css"> <!-- Votre fichier CSS -->
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>

        <!-- Affichage des erreurs -->
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Formulaire de connexion -->
        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Adresse email :</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>

            <p>Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a>.</p>
        </form>
    </div>
</body>
</html>
