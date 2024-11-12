<?php
// Fonction pour valider le nom
function validerNom($nom) {
    if (preg_match("/^([A-Za-z]+(-[A-Za-z]+)*){2,}$/", $nom)) {
        return true;
    }
    return "Nom incorrect, veuillez saisir un nom valide";
}

// Fonction pour valider le prénom
function validerPrenom($prenom) {
    if (preg_match("/^([A-Za-z]+(-[A-Za-z]+)*){3,}$/", $prenom)) {
        return true;
    }
    return "Prénom incorrect, veuillez saisir un prénom valide";
}

// Fonction pour valider l'adresse email
function validerEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }
    return "L'adresse électronique n'est pas valide.";
}

// Fonction pour vérifier si l'email existe déjà (simulé ici)
function emailExiste($email) {
    // Ceci serait remplacé par une requête SQL pour vérifier si l'email est déjà dans la base de données
    $emailsExistants = ['exemple@domaine.com', 'user@domaine.fr'];  // Exemple d'email déjà pris
    if (in_array($email, $emailsExistants)) {
        return "L'adresse électronique est déjà associée à un compte existant. Veuillez saisir une autre adresse électronique.";
    }
    return true;
}

// Fonction pour valider le mot de passe
function validerMotDePasse($motdepasse) {
    if (strlen($motdepasse) < 8 || strlen($motdepasse) > 12) {
        return "Ce mot de passe ne comporte pas suffisamment de caractères.";
    }
    if (!preg_match("/[A-Z]/", $motdepasse)) {
        return "Le mot de passe doit contenir au moins une majuscule.";
    }
    if (!preg_match("/[a-z]/", $motdepasse)) {
        return "Le mot de passe doit contenir au moins une minuscule.";
    }
    if (!preg_match("/[\W_]/", $motdepasse)) {
        return "Le mot de passe doit contenir au moins un caractère spécial.";
    }
    if (!preg_match("/\d/", $motdepasse)) {
        return "Le mot de passe doit contenir au moins un chiffre.";
    }
    return true;
}

// Fonction pour vérifier que le mot de passe de confirmation est correct
function validerConfirmationMotDePasse($motdepasse, $confirmation) {
    if ($motdepasse !== $confirmation) {
        return "Les mots de passe ne correspondent pas.";
    }
    return true;
}

$erreurs = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des champs du formulaire
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $email = $_POST['email'] ?? '';
    $email2 = $_POST['email2'] ?? '';
    $motdepasse = $_POST['motdepasse'] ?? '';
    $motdepasse2 = $_POST['motdepasse2'] ?? '';

    // Validation
    if ($validationNom = validerNom($nom) !== true) {
        $erreurs['nom'] = $validationNom;
    }

    if ($validationPrenom = validerPrenom($prenom) !== true) {
        $erreurs['prenom'] = $validationPrenom;
    }

    if ($validationEmail = validerEmail($email) !== true) {
        $erreurs['email'] = $validationEmail;
    } else {
        if ($validationEmailExist = emailExiste($email) !== true) {
            $erreurs['email'] = $validationEmailExist;
        }
    }

    if ($validationEmail2 = ($email !== $email2) ? "Les adresses email ne correspondent pas." : true) {
        $erreurs['email2'] = $validationEmail2;
    }

    if ($validationMotdepasse = validerMotDePasse($motdepasse) !== true) {
        $erreurs['motdepasse'] = $validationMotdepasse;
    }

    if ($validationMotdepasse2 = validerConfirmationMotDePasse($motdepasse, $motdepasse2) !== true) {
        $erreurs['motdepasse2'] = $validationMotdepasse2;
    }

    // Si aucune erreur, vous pouvez enregistrer l'utilisateur dans la base de données
    if (empty($erreurs)) {
        // Enregistrement de l'utilisateur et redirection
        echo "Compte créé avec succès!";
        // Ici, vous ajouteriez l'utilisateur dans la base de données.
    }
}
?>

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
