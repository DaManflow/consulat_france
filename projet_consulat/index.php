<?php
// Démarrage de la session pour gérer les utilisateurs
session_start();

// Inclusion des fichiers de configuration, de base de données, etc.
require_once 'config.php'; // Fichier contenant la configuration de la base de données et autres paramètres.
require_once 'controllers/VisaController.php';
require_once 'models/VisaModel.php';

// Vérifier si l'utilisateur est connecté
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php'); // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
//     exit();
// }


// Gérer les différentes actions via les paramètres de l'URL (par exemple, ?action=visa_form)
$action = isset($_GET['action']) ? $_GET['action'] : 'formulaire';

switch ($action) {
    case 'formulaire':
        // Afficher le formulaire de demande de visa
        VisaController::afficherFormulaireVisa();
        break;

    case 'soumettre_demande':
        // Traiter la soumission du formulaire et valider les données
        VisaController::soumettreDemande();
        break;

    case 'telecharger_demande':
        // Gérer le téléchargement du PDF de la demande de visa
        VisaController::telechargerPdfVisaDemande();
        break;

    case 'telecharger_visa':
        // Gérer le téléchargement du PDF du visa
        VisaController::telechargerPdfVisa();
        break;

    default:
        // Afficher la page par défaut (accueil, profil, etc.)
        echo "Page non trouvée.";
        break;
}
?>
