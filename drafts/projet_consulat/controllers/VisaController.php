<?php
require_once 'models/VisaModel.php';

class VisaController {

    public function submitVisa() {
        // Récupérer les données du formulaire
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $nationalite = $_POST['nationalite'];
        $passeport = $_POST['passeport'];
        $date_creation = $_POST['date_creation'];
        $date_validite = $_POST['date_validite'];
        $date_depart = $_POST['date_depart'];
        $date_retour = $_POST['date_retour'];
        $objet = $_POST['objet'];
        
        // Validation
        $validationErrors = VisaModel::validateVisaForm($nom, $prenom, $email, $nationalite, $passeport, $date_creation, $date_validite, $date_depart, $date_retour);
        if (!empty($validationErrors)) {
            // Afficher les erreurs
            $_SESSION['errors'] = $validationErrors;
            header("Location: demande_visa.php");
            exit();
        }
        
        // Enregistrer la demande dans la base de données
        VisaModel::saveVisaRequest($nom, $prenom, $email, $nationalite, $passeport, $date_creation, $date_validite, $date_depart, $date_retour, $objet);
        
        // Redirection vers une page de confirmation
        header("Location: success.php");
        exit();
    }

    // Traiter la soumission de la demande de visa
    public static function soumettreDemande() {
        // Vérification que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        // Récupération des données soumises via POST (validation déjà effectuée dans le formulaire)
        $userId = $_SESSION['user_id'];

        // Appeler la méthode du modèle pour enregistrer la demande
        VisaModel::saveVisaRequest($userId, $_POST);

        // Rediriger vers une page de confirmation ou afficher un message de succès
        header('Location: index.php?action=telecharger_demande');
    }

    // Télécharger le PDF de la demande de visa
    public static function telechargerPdfVisaDemande() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        $userId = $_SESSION['user_id'];

        // Générer le PDF avec les informations de la demande
        VisaModel::generatePdfVisaRequest($userId);

        // Offrir le téléchargement du fichier
        $filePath = "pdfs/visa_demande_" . $userId . ".pdf";
        if (file_exists($filePath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
        } else {
            echo "Erreur de génération du PDF.";
        }
    }

    // Télécharger le PDF du visa
    public static function telechargerPdfVisa() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        $userId = $_SESSION['user_id'];

        // Générer le PDF du visa
        VisaModel::generatePdfVisa($userId);

        // Offrir le téléchargement du fichier
        $filePath = "pdfs/visa_" . $userId . ".pdf";
        if (file_exists($filePath)) {
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
        } else {
            echo "Erreur de génération du PDF.";
        }
    }

    // Afficher le formulaire de demande de visa
    public static function afficherFormulaireVisa() {
        // Vérification que l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            header('Location: login.php');
            exit();
        }

        // On charge les données utilisateur pour les pré-remplir dans le formulaire
        $userId = $_SESSION['user_id'];
        $userData = VisaModel::getVisaRequestData($userId);

        // Affichage du formulaire
        include 'views/visa_form.php'; // Inclut la vue du formulaire
    }
}
?>
