<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Site consulaire de France</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <div class="header-content">
            <nav>
                <a href="#">La France</a>
                <a href="#">Demande de Visa</a>
                <a href="#">Presse</a>
                <a href="#">Culture</a>
                <a href="#">Contact</a>
            </nav>
            <div class="header-icons">
                <a href="connexion.html"><span class="icon user-icon">👤</span></a>
                <a href="index.html"><span class="icon flag-icon">🇫🇷</span></a>
            </div>
        </div>
    </header>

    <main class="login-section">
        <h2>Création du compte</h2>
        <form class="login-form" method="POST">
            <label for="nom">Nom de famille</label>
            <input type="text" id="nom" name="nom" placeholder="Nom de famille" value="<?= htmlspecialchars($nom) ?>">
            <span class="error"><?= $erreurs['nom'] ?? '' ?></span>

            <label for="prenom">Prénom</label>
            <input type="text" id="prenom" name="prenom" placeholder="Prénom" value="<?= htmlspecialchars($prenom) ?>">
            <span class="error"><?= $erreurs['prenom'] ?? '' ?></span>

            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" placeholder="Adresse email" value="<?= htmlspecialchars($email) ?>">
            <span class="error"><?= $erreurs['email'] ?? '' ?></span>

            <label for="email2">Vérification de l'adresse électronique</label>
            <input type="email" id="email2" name="email2" placeholder="Adresse email" value="<?= htmlspecialchars($email2) ?>">
            <span class="error"><?= $erreurs['email2'] ?? '' ?></span>

            <label for="motdepasse">Mot de passe</label>
            <input type="password" id="motdepasse" name="motdepasse" placeholder="Mot de passe">
            <img id="eye-icon-motdepasse" src="https://img.icons8.com/ios-filled/50/000000/invisible.png" alt="Toggle password visibility" style="cursor: pointer;">
            <span class="error"><?= $erreurs['motdepasse'] ?? '' ?></span>

            <label for="motdepasse2">Confirmation du mot de passe</label>
            <input type="password" id="motdepasse2" name="motdepasse2" placeholder="Mot de passe">
            <img id="eye-icon-motdepasse2" src="https://img.icons8.com/ios-filled/50/000000/invisible.png" alt="Toggle password visibility" style="cursor: pointer;">
            <span class="error"><?= $erreurs['motdepasse2'] ?? '' ?></span>

            <button type="submit">Valider</button>
        </form>
    </main>

    <footer>
        <a href="#">Plan du site</a>
        <a href="#">Mentions légales</a>
        <a href="#">Données Personnelles</a>
        <a href="#">Gestion des cookies</a>
        <a href="#">Contact</a>
    </footer>
</body>
</html>