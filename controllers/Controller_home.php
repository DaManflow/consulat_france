<?php
class Controller_home extends Controller {
    
    // Méthode qui gère l'action accueil
    public function action_accueil(){   
        // Récupération d'une instance du modèle
        $m = Model::getModel();
        // Initialisation d'un tableau vide pour stocker les données à passer à la vue
        $data = [];
        // Vérifie si une session utilisateur est active en vérifiant la présence de l'identifiant dans $_SESSION
        if(isset($_SESSION["id"])){
            // Si une session utilisateur est active, récupère les informations du profil de l'utilisateur
            $data = $m->getInfoProfil($_SESSION["id"]);
        }
        // Rend la vue 'accueil' en passant les données du profil utilisateur ou un tableau vide si non connecté
        $this->render("accueil", $data);


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
    }
    
    // Méthode par défaut qui appelle l'action accueil
    public function action_default(){
        // Appelle la méthode action_accueil pour afficher la page d'accueil
        $this->action_home();
    }
}
?>