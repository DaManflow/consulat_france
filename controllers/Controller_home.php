<?php
class Controller_home extends Controller {
    
    // Méthode qui gère l'action accueil
    public function action_home(){   
           
        // Rend la vue 'accueil' en transférant un tableau vide
        $this->render("home");
    }
    
    // Méthode par défaut qui appelle l'action accueil
    public function action_default(){
        // Appelle la méthode action_accueil pour afficher la page d'accueil
        $this->action_home();
    }
}
?>