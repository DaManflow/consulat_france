<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Visa</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js" defer></script>
</head>
<body>

    <!-- Barre de Navigation -->
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="demande_visa.php">Demande de Visa</a></li>
            <li><a href="profil.php">Profil</a></li>
        </ul>
    </nav>

    <!-- Formulaire de Demande de Visa -->
    <h1>Demande de Visa</h1>
    <form action="index.php?action=submitVisa" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
        <!-- Nom de famille -->
        <label for="nom">Nom de famille:</label>
        <input type="text" name="nom" id="nom" value="<?php echo $user['nom']; ?>" required><br>

        <!-- Prénom -->
        <label for="prenom">Prénom(s):</label>
        <input type="text" name="prenom" id="prenom" value="<?php echo $user['prenom']; ?>" required><br>

        <!-- Email -->
        <label for="email">Adresse Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" required><br>

        <!-- Nationalité -->
        <label for="nationalite">Nationalité:</label>
        <select name="nationalite" id="nationalite" required>
            <option value="France">France</option>
            <option value="USA">USA</option>
            <!-- Ajoutez d'autres pays -->
        </select><br>

        <!-- N° de Passeport -->
        <label for="passeport">Numéro de Passeport:</label>
        <input type="text" name="passeport" id="passeport" required><br>

        <!-- Date de Création du Passeport -->
        <label for="date_creation">Date de Création du Passeport:</label>
        <input type="date" name="date_creation" id="date_creation" required><br>

        <!-- Date de Validité du Passeport -->
        <label for="date_validite">Date de Validité du Passeport:</label>
        <input type="date" name="date_validite" id="date_validite" required><br>

        <!-- Dates de Voyage -->
        <label for="date_depart">Date de Départ:</label>
        <input type="date" name="date_depart" id="date_depart" required><br>

        <label for="date_retour">Date de Retour:</label>
        <input type="date" name="date_retour" id="date_retour" required><br>

        <!-- Objet du Voyage -->
        <label for="objet">Objet du Voyage:</label><br>
        <input type="checkbox" name="objet[]" value="tourisme"> Tourisme
        <input type="checkbox" name="objet[]" value="affaires"> Affaires
        <!-- Ajoutez d'autres objets ici -->

        <!-- Photocopie du Passeport -->
        <label for="photo_passeport">Photocopie du Passeport:</label>
        <input type="file" name="photo_passeport" id="photo_passeport" accept="image/*" required><br>

        <!-- Photographie d'identité -->
        <label for="photo_id">Photographie d'identité:</label>
        <input type="file" name="photo_id" id="photo_id" accept="image/*" required><br>

        <button type="submit">Soumettre la Demande</button>
    </form>

</body>
</html>
