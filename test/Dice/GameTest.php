<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GameTest extends TestCase
{
    /**
     * Test create new Game.
     */
    public function testCreateGame()
    {
        $game = new Game();
        $this->assertInstanceOf("\Fla\Dice\Game", $game);
    }

    /**
     * Test get points for players.
     */
    public function testGetPoints()
    {
        $game = new Game();
        $exp = 0;
        $res1 = $game->getPoints("player");
        $res2 = $game->getPoints("computer");

        $this->assertEquals($exp, $res1);
        $this->assertEquals($exp, $res2);
    }

    /**
     * Test get points for players.
     */
    public function testSetPoints()
    {
        $game = new Game();
        $exp = 10;
        $player = "player";
        $computer = "computer";

        $game->setPoints($player, $exp);
        $game->setPoints($computer, $exp);

        $res1 = $game->getPoints($player);
        $res2 = $game->getPoints($computer);

        $this->assertEquals($exp, $res1);
        $this->assertEquals($exp, $res2);
    }

    /**
     * Test sum 0 and change player after save for player.
     */
    public function testSavePointsNextPlayerForPlayer()
    {
        $game = new Game();
        $player = "player";
        // $computer = "computer";
        $sum = 10;
        $exp0 = 0;

        $game->setCurrent($player);
        $game->setSum($sum);

        $game->savePointsNextPlayer();

        $sumAfter = $game->getSum();
        $pointsAfter = $game->getPoints($player);
        // $playerAfter = $game->getCurrent();

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($sum, $pointsAfter);
        // $this->assertEquals($computer, $playerAfter);
    }

    /**
     * Test sum 0 and change player after save for computer.
     */
    public function testSavePointsNextPlayerForComputer()
    {
        $game = new Game();
        $player = "player";
        $computer = "computer";
        $sum = 10;
        $exp0 = 0;

        $game->setCurrent($computer);
        $game->setSum($sum);

        $game->savePointsNextPlayer();

        $sumAfter = $game->getSum();
        $pointsAfter = $game->getPoints($computer);
        $playerAfter = $game->getCurrent();

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($sum, $pointsAfter);
        $this->assertEquals($player, $playerAfter);
    }

    /**
     * Test next player without saving points for computer.
     */
    public function testNextPlayerForComputer()
    {
        $game = new Game();
        $player = "player";
        $computer = "computer";
        $sum = 10;
        $exp0 = 0;

        $game->setCurrent($computer);
        $game->setSum($sum);
        $pointsBefore = $game->getPoints($computer);

        $game->NextPlayer();

        $sumAfter = $game->getSum();
        $pointsAfter = $game->getPoints($computer);
        $playerAfter = $game->getCurrent();

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($pointsBefore, $pointsAfter);
        $this->assertEquals($player, $playerAfter);
    }

    /**
     * Test next player without saving points for player.
     */
    public function testNextPlayerForPlayer()
    {
        $game = new Game();
        $player = "player";
        // $computer = "computer";
        $sum = 10;
        $exp0 = 0;

        $game->setCurrent($player);
        $game->setSum($sum);
        $pointsBefore = $game->getPoints($player);

        $game->NextPlayer();

        $sumAfter = $game->getSum();
        $pointsAfter = $game->getPoints($player);
        // $playerAfter = $game->getCurrent();

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($pointsBefore, $pointsAfter);
        // $this->assertEquals($player, $playerAfter);
    }

    /**
     * Test get winner null.
     */
    public function testGetWinner()
    {
        $game = new Game();
        $res = $game->getWinner();
        $exp = null;

        $this->assertEquals($exp, $res);
    }

    /**
     * Test if winner.
     */
    public function testWinner()
    {
        $game = new Game();
        $player = "player";
        $points = 90;
        $sum = 10;
        $exp = $points + $sum;

        $game->setCurrent($player);
        $game->setSum($sum);
        $game->setPoints($player, $points);

        $winnerBool = $game->checkIfWinner();
        $pointsAfter = $game->getPoints($player);

        $this->assertEquals($exp, $pointsAfter);
        $this->assertTrue($winnerBool);
    }
}
