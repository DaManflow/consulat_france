<?php

abstract class Controller {
    
    /**
     * Constructeur. Lance l'action correspondante
     */
    public function __construct(){
        //On teste si un paramètre action existe et
        //s'il correspond à une action du contrôleur
        if(isset($_GET['action']) and method_exists($this, "action_" . $_GET["action"]) ){
            $action = "action_" . $_GET["action"];
            $this->$action(); //On appelle cette action
        }
        else {
            $this->action_default(); //On appelle sinon l'action par défaut
        }
    }

    /*
    * Méthode abstraite qui permet de choisir l'action par défaut d'un controlleur
    * à définir dans les classes filles
    */
    abstract public function action_default();

    /**
     * Affiche la vue
     * @param string $vue nom de la vue
     * @param array $data tableau contenant les données à passer à la vue
     * @return null
     */
    protected function render($vue, $data = []){
        //On extrait les données à afficher
        extract($data);
        //On teste si la vue existe
        $file_name = "Views/view_" . $vue . '.php';
        if(file_exists($file_name)){
            //Si oui, on l'affiche
            require $file_name;
        }
        else{
            //Sinon, on affiche la page d'erreur
            $this->action_error("La vue n'existe pas !");
        }
        die(); // On termine l'exécution du script une fois la vue affichée
    }


    /**
     * Méthode affichant une page d'erreur
     * @param string $message Message d'erreur à afficher
     * @return null
     */
    protected function action_error($message = ''){
        $data = [
            'title' => "Error",
            'message' => $message,
        ];
        $this->render("message", $data);
    }
}
?>