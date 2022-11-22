<?php 
 namespace App\Entity;
/**
 * Class Deck : représentation d'un jeu de carte.
 *
 * Cette classe permet la création et la gestion d'un jeu de carte de [NUMBEROFCARDS] cartes
 * Le nombre de joueurs est défini à deux. 
 *
 * @package BattlePHP
 * @author  Sébastien Sondej <wd-creation@live.fr>
 *
 */

class Deck {
    /**
     * Nombre de cartes du jeu
     */
    public const NUMBEROFCARDS  = 52;

    /**
     * @var array $cards Tableau représentant les cartes 
     */
    private $cards = [];

    public function __construct()
    {
        $this->generate();
        $this->mix();
    }

    /**
     * Gnération du jeu de carte
     * 
     * @return void
     */
    public function generate(): void
    {
        for ($i=1; $i <= Deck::NUMBEROFCARDS; $i++) { 
            $this->cards[] = $i;
        }
    }

    /**
     * Retourne le paquet de cartes
     * 
     * @return Array Paquet de cartes
     */
    public function getCards()
    {
        return $this->cards;
    }

    /**
     * Mélange du jeu de carte aléatoirement entre 1 et 3 fois
     * 
     * @return void
     */
    private function mix(): void
    {
        $nbShuffle = rand(1, 3);
        for ($i=0; $i <= $nbShuffle; $i++) { 
            shuffle($this->cards);
        }
    }

    /**
     * Retourne le prochain pli à être joué
     * 
     * @return Array Pli courant (2 cartes)
     */
    public function getTrick()
    {
        $trick = [];
        //Joueur 1
        $trick[] = array_shift($this->cards);
        //Joueur 2
        $trick[] = array_shift($this->cards);
        
        return $trick;
    }

}