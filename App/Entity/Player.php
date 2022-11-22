<?php 
 namespace App\Entity;
/**
 * Class Player : représentation d'un joueur.
 *
 * Cette classe permet la création et la gestion des joueurs
 *
 * @package BattlePHP
 * @author  Sébastien Sondej <wd-creation@live.fr>
 *
 */

class Player {

    /**
     * @var String $name Prénom du joueur
     */
    public $name;
    /**
     * @var int $winTricks Nombre de manches gagnées par le joueur
     */
    public $winTricks = 0;

    /**
     * Création d'un joueur
     * 
     * @param String $name
     */
    public function __construct($name)
    {
        $this->name = trim($name);
    }

    /**
     * Retourne le prénom du joueur
     * 
     * @return String Prénom du joueur
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Méthode permettant de retourner le nombre de manches gagnées par le joueur
     * 
     * @return int Nombre de manches gagnées
     */ 
    public function getWinTricks()
    {
        return (int)$this->winTricks;
    }

    /**
     * Méthode d'incrémentation des plis gagnés
     *
     * @return self Instance de Player
     */ 
    public function setWinTrick()
    {
        $this->winTricks++;

        return $this;
    }
}