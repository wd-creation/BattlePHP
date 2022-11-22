<?php 
 namespace App\Entity;
/**
 * Class Game : génération d'une partie du jeu de la bataille.
 *
 * Cette classe permet la création d'une instance de jeu
 * Le nombre de joueurs est défini à deux. 
 *
 * @package BattlePHP
 * @author  Sébastien Sondej <wd-creation@live.fr>
 *
 */


use App\Io\Io;

class Game {

    /**
     * @var Deck $deck Représentation du jeu de carte
     */
    private $deck;
    /**
     * @var int $partNumber Nombre de manches jouées
     */
    private $partNumber = 0;
    /**
     * @var Array $currentTrick Pli en court
     */
    private $currentTrick;
    /**
     * @var Array $players tableau de joueurs
     */
    public $players;


    public function __construct()
    {
        Io::separator();
        Io::separator(1);
        Io::writeLn("Bienvenue sur la bataille PHP !\n");
        Io::separator(1);
        $this->init();
    }

    /**
     * Initialisation de la partie (jeu de cartes et joueurs)
     * 
     * @return void
     */
    private function init()
    {
        //Création du jeu de cartes
        $this->deck = new Deck();

        // Création du joueur n°1
        $p1 = Io::readLn("Prénom du joueur n°1 : ");
        $name1 =  $p1 ? $p1 : "Player_1";
        $this->players[] = new Player($name1);
        // Création du joueur n°2
        $p2 = Io::readLn("Prénom du joueur n°2 : ");
        $name2 =  $p2 ? $p2 : "Player_2";
        $this->players[] = new Player($name2);
        Io::separator();
    }

    /**
     * Lancement de la partie
     * 
     * @return void
     */
    public function run()
    {
        // Tant qu'il reste des cartes dans le jeu...
        while (!$this->isOver()) {
            
            // Récupération du prochain pli
            $this->currentTrick = $this->getTrick();

            // Début du tour
            Io::separator(2);
            Io::writeLn(">>>>>>>>> Tour n° {$this->getPartNumber()} <<<<<<<<<< \n");
            Io::separator(3);
            
            // Affichage du pli
            Io::writeLn("> {$this->players[0]->getName()} : {$this->currentTrick[0]} \n");
            Io::writeLn("> {$this->players[1]->getName()} : {$this->currentTrick[1]} \n");
            Io::separator(3);
    
            //Détermination et affichage du gagnant
            Io::writeLn(">>> {$this->getWinner()->getName()} gagne \n\n");
            
            if ($this->getPartNumber() < ($this->deck::NUMBEROFCARDS/2)) {
                // Tour suivant?
                $newPart = Io::readLn("Nouvelle partie ? (O/N) ");
                Io::separator();

                // Sortie du jeu (appui sur la touche N, toute autre touche enclenche la manche suivante)
                if ( ($newPart == "n" || $newPart == "N")) {
                    $this->endOfGame();
                }
            }
            else {
                $this->endOfGame();
            }
        }
        // Fin de la partie
        $this->endOfGame();
    }

    /**
     * Récupération des nouvelles cartes à jouer et incrémentation du nombre de manches jouées
     * 
     * @return Array Retourne 2 nouvelles cartes sous forme de tableau
     */
    private function getTrick()
    {
        $this->partNumber ++;
        return $this->deck->getTrick();
    }

    /**
     * Nombre de manches jouées
     * 
     * @return int Retourne le nombre de manches totales jouées
     */
    private function getPartNumber()
    {
        return $this->partNumber;
    }

    /**
     * Vérification de fin de partie
     * Nombre de parties jouées / nombre de plis maximal
     * 
     * @return bool 
     */
    private function isOver()
    {
        return $this->getPartNumber() < ($this->deck::NUMBEROFCARDS/2) ? false : true;
    }

    /**
     * Détermination du gagnant d'une manche
     * 
     * @return Player Retourne le vainqueur d'une manche
     */
    private function getWinner()
    {
        $winner = $this->currentTrick[0] > $this->currentTrick[1] ? $this->players[0] : $this->players[1];
        $winner->setWinTrick();
        return $winner;
    }

    /**
     * Résumé de la partie
     * @return void Affiche le résumé de la partie et le gagnant
     */
    private function getResume()
    {
        Io::writeLn("---- Résumé de la partie ----- \n");
        Io::writeLn("{$this->players[0]->getName()} : {$this->players[0]->getWinTricks()} pli(s) gagné(s)\n");
        Io::writeLn("{$this->players[1]->getName()} : {$this->players[1]->getWinTricks()} pli(s) gagné(s) \n");
        Io::separator(3);
        //Gestion de l'égalité
        if($this->players[0]->getWinTricks() == $this->players[1]->getWinTricks()){
            Io::writeLn("/!\ Égalité /!\ \n\n");
        }
        else {
            $winner = $this->players[0]->getWinTricks() > $this->players[1]->getWinTricks() ? $this->players[0] : $this->players[1]; 
            Io::writeLn("*** {$winner->getName()} gagne la partie avec {$winner->getWinTricks()} pli(s) remporté(s) ***\n\n");
        }
    }

    /**
     * Déclenchement de la fin de la partie
     * 
     * @return void Affiche le résumé de la partie
     */
    private function endOfGame()
    {
        Io::writeLn("---- Partie terminée ----- \n");
        $this->getResume();
        exit;
    }
    
}