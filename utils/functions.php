<?php 

/* Fonction qui utilise la fonction htmlspecialchars pour éviter les attaques XSS
* @parametre : un message de type str
* @return : le message en paramètre sans balise html
*/
function e($message){
    return htmlspecialchars($message, ENT_QUOTES);
    // htmlspecialchars désactive les balises html non prévues
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

// Fonction pour vérifier si l'email existe déjà (simulé ici)
function emailExiste($email) {
    // Ceci serait remplacé par une requête SQL pour vérifier si l'email est déjà dans la base de données
    $emailsExistants = ['exemple@domaine.com', 'user@domaine.fr'];  // Exemple d'email déjà pris
    if (in_array($email, $emailsExistants)) {
        return "L'adresse électronique est déjà associée à un compte existant. Veuillez saisir une autre adresse électronique.";
    }
    return true;
}

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

?>