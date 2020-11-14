<?php

namespace Fla\Dice;

/**
 * Game 100, a class supporting the game through GET, POST and SESSION.
 */
class Game extends Round
{
    /**
     * @var int $pointsPlayer   Points for player.
     * @var int $pointsComputer   Points for computer.
     * @var string $winner   Game winner.
     */
    protected $pointsPlayer;
    protected $pointsComputer;
    protected $winner;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $pointsPlayer  Points for player.
     * @param int $pointsComputer  Points for computer.
     * @param string $current  Current player.
     * @param int $sum  Set starting sum 0.
     * @param string $winner  Set starting winner null.
     */

    public function __construct(int $pointsPlayer = 0, int $pointsComputer = 0, string $current = "player", int $sum = 0, $winner = null, $serie = array())
    {
        $this->pointsPlayer = $pointsPlayer;
        $this->pointsComputer = $pointsComputer;
        $this->setSum($sum);
        $this->setCurrent($current);
        $this->winner = $winner;
        $this->serie = $serie;
    }

    /**
     * Get points for player.
     *
     * @return int
     */
    public function getPoints($player)
    {
        if ($player == "computer") {
            return $this->pointsComputer;
        } elseif ($player == "player") {
            return $this->pointsPlayer;
        } else {
            return null;
        }
    }

    /**
     * Set points for player.
     *
     * @return int
     */
    public function setPoints($player, $points)
    {
        if ($player == "computer") {
            $this->pointsComputer = $points;
        }
        if ($player == "player") {
            $this->pointsPlayer = $points;
        }
    }

    /**
     * Save points, next player.
     *
     * @return void
     */
    public function savePointsNextPlayer()
    {
        $current = $this->getCurrent();
        if ($current == "player") {
            $this->pointsPlayer += $this->sum;
            $this->sum = 0;
            $this->current = "computer";
            return $this->computerPlay();
        }
        if ($current == "computer") {
            $this->pointsComputer += $this->sum;
            $this->sum = 0;
            $this->current = "player";
        }
    }

    /**
     * Points lost, next player.
     *
     * @return void
     */
    public function nextPlayer()
    {
        $current = $this->getCurrent();
        if ($current == "player") {
            $this->sum = 0;
            $this->current = "computer";
            return $this->computerPlay();
        }
        if ($current == "computer") {
            $this->sum = 0;
            $this->current = "player";
        }
    }

    /**
     * Play for computer.
     *
     * @return void
     */
    public function computerPlay()
    {
        $dicesArray = $this->computerThrow();
        $doNotAllow = $this->computerAllow($dicesArray);
        if ($doNotAllow) {
            return $this->nextPlayer();
        } else {
            if ($this->checkIfWinner()) {
                return;
            }
            $this->computerChoice();
        }
    }

    /**
     * Throw for computer.
     *
     * @return array
     */
    public function computerThrow()
    {
        $this->throwDices();
        $valuesArray = $this->showThrownDices();
        return $valuesArray;
    }

    /**
     * Allow computer to keep playing.
     *
     * @return array
     */
    public function computerAllow($array)
    {
        $myBool = in_array(1, $array);
        return $myBool;
    }

    /**
     * Random choice for computer.
     *
     * @return
     */
    public function computerChoice()
    {
        $pointsComputer = $this->getPoints("computer");
        $pointsPlayer = $this->getPoints("player");
        $sum = $this->getSum();
        $totalComputer = $pointsComputer + $sum;
        // $choice = rand(1, 2);
        if ($totalComputer < $pointsPlayer) {
            return $this->computerPlay();
        } else {
            return $this->savePointsNextPlayer();
        }
    }

    /**
     * get winner.
     *
     * @return string
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * Check current player is winner.
     *
     * @return bool
     */
    public function checkIfWinner()
    {
        $current = $this->getCurrent();
        $points = $this->getPoints($current);
        $sum = $this->getSum();
        $total = $points + $sum;
        if ($total > 99) {
            $this->winner = $current;
            $this->setPoints($current, $total);
            return true;
        }
        return false;
    }
}
