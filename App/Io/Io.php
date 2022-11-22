<?php 
 namespace App\Io;
/**
 * Class Io : Classe générique permettant la gestion des flux d'entrée et de sortie.
 *
 * Cette classe permet la gestion des flux d'entrée et de sortie
 *
 * @package BattlePHP
 * @author  Sébastien Sondej <wd-creation@live.fr>
 *
 */

//Définition du stream d'entrée
if(!defined("STDIN")){ define("STDIN", fopen("php://stdin", "r")); }

class Io {

    
    /**
     * Méthode d'affichage d'un texte dans la console
     * 
     * @param String $txt Texte à afficher
     * 
     * @return void
     */
    public static function writeLn(String $txt): void
    {
        echo "$txt";
    }

    /**
     * Méthode permettant de lire le stream d'entrée
     * 
     * @param String $txt Texte saisi par l'utilisateur
     * 
     * @return String Retourne la saisie utilisateur au stream de sortie
     */
    public static function readLn(String $txt): String
    {
        self::writeLn(">>> $txt");
        $txt = trim(fgets(STDIN));
        return $txt;
    }

    /**
     * Génération de séparateurs textuels pour la mise en forme de l'affichage
     * 
     * @param int|null $num Numéro du type de séparateur
     * 
     * @return void Envoi du séparateur dans le stream de sortie
     */
    public static function separator(int $num = null): void
    {
        $sep = "";
        switch ($num) {
            case 1:
                $sep .= "############################## \n";
                break;
            case 2:
                $sep .= "##--------------------------## \n";
                break;
            case 3:
                $sep .= "------------------------------ \n";
                break;
            default:
            $sep .= "\n";
                break;
        }
        
        self::writeLn($sep);
    }

}