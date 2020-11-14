<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GameTest extends TestCase
{
    protected $game;

    /**
     * Set up.
     */
    protected function setUp()
    {
        $this->game = new Game();
    }

    /**
     * Test create new Game.
     */
    public function testCreateGame()
    {
        $this->assertInstanceOf("\Fla\Dice\Game", $this->game);
    }

    /**
     * Test get points for players.
     */
    public function testGetPoints()
    {
        $exp = 0;
        $res1 = $this->game->getPoints("player");
        $res2 = $this->game->getPoints("computer");
        $res3 = $this->game->getPoints("bla");

        $this->assertEquals($exp, $res1);
        $this->assertEquals($exp, $res2);
        $this->assertEquals(null, $res3);
    }

    /**
     * Test get points for players.
     */
    public function testSetPoints()
    {
        $exp = 10;
        $player = "player";
        $computer = "computer";

        $this->game->setPoints($player, $exp);
        $this->game->setPoints($computer, $exp);

        $res1 = $this->game->getPoints($player);
        $res2 = $this->game->getPoints($computer);

        $this->assertEquals($exp, $res1);
        $this->assertEquals($exp, $res2);
    }

    /**
     * Test sum 0 and change player after save for player.
     */
    public function testSavePointsNextPlayerForPlayer()
    {
        $player = "player";
        $sum = 10;
        $exp0 = 0;

        $this->game->setCurrent($player);
        $this->game->setSum($sum);

        $this->game->savePointsNextPlayer();

        $sumAfter = $this->game->getSum();
        $pointsAfter = $this->game->getPoints($player);

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($sum, $pointsAfter);
    }

    /**
     * Test sum 0 and change player after save for computer.
     */
    public function testSavePointsNextPlayerForComputer()
    {
        $player = "player";
        $computer = "computer";
        $sum = 10;
        $exp0 = 0;

        $this->game->setCurrent($computer);
        $this->game->setSum($sum);

        $this->game->savePointsNextPlayer();

        $sumAfter = $this->game->getSum();
        $pointsAfter = $this->game->getPoints($computer);
        $playerAfter = $this->game->getCurrent();

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($sum, $pointsAfter);
        $this->assertEquals($player, $playerAfter);
    }

    /**
     * Test next player without saving points for computer.
     */
    public function testNextPlayerForComputer()
    {
        $player = "player";
        $computer = "computer";
        $sum = 10;
        $exp0 = 0;

        $this->game->setCurrent($computer);
        $this->game->setSum($sum);
        $pointsBefore = $this->game->getPoints($computer);

        $this->game->NextPlayer();

        $sumAfter = $this->game->getSum();
        $pointsAfter = $this->game->getPoints($computer);
        $playerAfter = $this->game->getCurrent();

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($pointsBefore, $pointsAfter);
        $this->assertEquals($player, $playerAfter);
    }

    /**
     * Test next player without saving points for player.
     */
    public function testNextPlayerForPlayer()
    {
        $player = "player";
        $sum = 10;
        $exp0 = 0;

        $this->game->setCurrent($player);
        $this->game->setSum($sum);
        $pointsBefore = $this->game->getPoints($player);

        $this->game->NextPlayer();

        $sumAfter = $this->game->getSum();
        $pointsAfter = $this->game->getPoints($player);

        $this->assertEquals($exp0, $sumAfter);
        $this->assertEquals($pointsBefore, $pointsAfter);
    }

    /**
     * Test get winner null.
     */
    public function testGetWinner()
    {
        $res = $this->game->getWinner();
        $exp = null;

        $this->assertEquals($exp, $res);
    }

    /**
     * Test if winner.
     */
    public function testWinner()
    {
        $player = "player";
        $points = 90;
        $sum = 10;
        $exp = $points + $sum;

        $this->game->setCurrent($player);
        $this->game->setSum($sum);
        $this->game->setPoints($player, $points);

        $winnerBool = $this->game->checkIfWinner();
        $pointsAfter = $this->game->getPoints($player);

        $this->assertEquals($exp, $pointsAfter);
        $this->assertTrue($winnerBool);
    }
}
