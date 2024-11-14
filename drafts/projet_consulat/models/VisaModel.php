<?php
require('fpdf186/fpdf.php');

require_once 'config.php'; // Fichier de configuration pour la connexion à la base de données
class VisaModel {

    public static function validateVisaForm($nom, $prenom, $email, $nationalite, $passeport, $date_creation, $date_validite, $date_depart, $date_retour) {
        $errors = [];
        
        // Validation du Nom
        if (!preg_match("/^[a-zA-Z-]{2,}$/", $nom)) {
            $errors[] = "Nom incorrect, veuillez saisir un nom valide.";
        }

        // Validation du Prénom
        if (!preg_match("/^[a-zA-Z-]{3,}$/", $prenom)) {
            $errors[] = "Prénom incorrect, veuillez saisir un prénom valide.";
        }

        // Validation de l'Email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "L'adresse électronique n'est pas valide.";
        }

        // Validation du Passeport
        if (!preg_match("/^(\d{2}[A-Za-z]{2}\d{5})$/", $passeport)) {
            $errors[] = "Ce numéro est invalide. Veuillez renseigner un numéro valide.";
        }

        // Validation des Dates
        if (strtotime($date_creation) > time() || strtotime($date_creation) < strtotime("-20 years")) {
            $errors[] = "La date de création du passeport est invalide.";
        }

        if (strtotime($date_validite) <= time()) {
            $errors[] = "La date de validité du passeport doit être supérieure à la date actuelle.";
        }

        if (strtotime($date_depart) >= strtotime($date_retour)) {
            $errors[] = "La date de départ doit être avant la date de retour.";
        }

        return $errors;
    }

    // Fonction de sauvegarde de la demande de visa
    public static function saveVisaRequest($userId, $nom, $prenom, $email, $nationalite, $passeport, $date_creation, $date_validite, $date_depart, $date_retour, $objet, $photo_passport, $photo_identite) {
        // Connexion à la base de données
        global $pdo; // Utilisation de la variable globale pour la connexion PDO
        
        try {
            // Préparation de la requête SQL d'insertion
            $sql = "INSERT INTO demandes_visa (user_id, nom, prenom, email, nationalite, passeport, date_creation, date_validite, date_depart, date_retour, objet, photo_passport, photo_identite, date_demande) 
                    VALUES (:user_id, :nom, :prenom, :email, :nationalite, :passeport, :date_creation, :date_validite, :date_depart, :date_retour, :objet, :photo_passport, :photo_identite, NOW())";

            // Préparation de la requête
            $stmt = $pdo->prepare($sql);

            // Lier les valeurs
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':nationalite', $nationalite);
            $stmt->bindParam(':passeport', $passeport);
            $stmt->bindParam(':date_creation', $date_creation);
            $stmt->bindParam(':date_validite', $date_validite);
            $stmt->bindParam(':date_depart', $date_depart);
            $stmt->bindParam(':date_retour', $date_retour);
            $stmt->bindParam(':objet', $objet);

            // Gestion des fichiers photo
            $photo_passport_path = 'uploads/' . basename($photo_passport['name']);
            move_uploaded_file($photo_passport['tmp_name'], $photo_passport_path);

            $photo_identite_path = 'uploads/' . basename($photo_identite['name']);
            move_uploaded_file($photo_identite['tmp_name'], $photo_identite_path);

            // Lier les fichiers
            $stmt->bindParam(':photo_passport', $photo_passport_path);
            $stmt->bindParam(':photo_identite', $photo_identite_path);

            // Exécution de la requête
            $stmt->execute();

            return true; // La demande a été sauvegardée avec succès
        } catch (PDOException $e) {
            // Gestion des erreurs de base de données
            echo "Erreur lors de l'enregistrement de la demande de visa : " . $e->getMessage();
            return false;
        }
    }

    public static function generatePdfVisaRequest($userId) {
        // Récupération des données de la demande depuis la base de données (exemple)
        $userData = self::getVisaRequestData($userId);
        
        // Création du PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Ajout d'un titre
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(200, 10, 'Récapitulatif de la Demande de Visa', 0, 1, 'C');
        
        // Récapitulatif des informations
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Nom: " . $userData['nom']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Prénom: " . $userData['prenom']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Email: " . $userData['email']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Nationalité: " . $userData['nationalite']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Numéro de Passeport: " . $userData['passeport']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Date de Création: " . $userData['date_creation']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Date de Validité: " . $userData['date_validite']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Date de Départ: " . $userData['date_depart']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Date de Retour: " . $userData['date_retour']);
        $pdf->Ln(10);
        
        // Objet du voyage
        $pdf->Cell(50, 10, "Objet(s) du Voyage: " . implode(", ", $userData['objet']));
        $pdf->Ln(10);
        
        // Sauvegarde du PDF
        $pdf->Output('F', 'pdfs/visa_demande_' . $userId . '.pdf');
    }


    public static function generatePdfVisa($userId) {
        // Générer le PDF du Visa (si validé)
        $userData = self::getVisaRequestData($userId);

        // Création du PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        
        // Ajout d'un titre
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(200, 10, 'Visa Accordé', 0, 1, 'C');
        
        // Détails du visa
        $pdf->SetFont('Arial', '', 12);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Nom: " . $userData['nom']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Prénom: " . $userData['prenom']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Numéro de Passeport: " . $userData['passeport']);
        $pdf->Ln(10);
        $pdf->Cell(50, 10, "Visa Valide Jusqu'au: " . $userData['date_validite']);
        $pdf->Ln(10);
        
        // Sauvegarde du PDF
        $pdf->Output('F', 'pdfs/visa_' . $userId . '.pdf');
    }

    // Méthode pour récupérer les données de la demande de visa
    private static function getVisaRequestData($userId) {
        // Simulation d'une récupération de données
        // En réalité, vous interrogeriez la base de données pour obtenir ces informations
        return [
            'nom' => 'Dupont',
            'prenom' => 'Jean',
            'email' => 'jean.dupont@example.com',
            'nationalite' => 'France',
            'passeport' => '12AB34567',
            'date_creation' => '15-01-2015',
            'date_validite' => '15-01-2025',
            'date_depart' => '01-06-2024',
            'date_retour' => '30-06-2024',
            'objet' => ['tourisme', 'affaires'],
        ];
    }
}
?>
