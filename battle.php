<?php
require 'autoload.php';
use App\Io\Io;
use App\Entity\Game;
use App\Entity\Player;

// Instanciation et lancement de la partie 
$game = new Game();
$game->run();