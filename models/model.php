<?php
class Model{
    private $bd; //Attribut privé contenant l'objet PDO
    //Attribut qui contiendra l'unique instance du modèle
    private static $instance = null;
    
    /**
    * Constructeur créant l'objet PDO et l'affectant à $bd
    */
    private function __construct(){
        require "credentials.php";
        $this->bd = new PDO($dsn, $login, $mdp);

        $this->bd->query("SET NAMES 'utf8'"); 
        // php communique en utf8 avec la bdd
        
        $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        // en cas d'erreur,  on lève une exception, on affiche l'exception, et on arrête le script si besoin
    }
    
    /**
    * Méthode permettant de récupérer l'instance de la classe Model
    */
    public static function getModel()
    {
        //Si la classe n'a pas encore été instanciée
        if (self::$instance === null) {
            self::$instance = new self(); //On l'instancie
        }
        return self::$instance; //On retourne l'instance
    }
}
?>