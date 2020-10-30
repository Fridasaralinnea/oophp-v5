<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class RoundTest extends TestCase
{
    protected $round;

    /**
     * Set up.
     */
     protected function setUp()
     {
         $this->round = new Round();
     }

    /**
     * test set and get current.
     */
    public function testSetGetCurrent()
    {
        $test = "test";
        $this->round->setCurrent($test);
        $res = $this->round->getCurrent();

        $this->assertEquals($test, $res);
    }

    /**
     * test set and get sum.
     */
    public function testSetGetSum()
    {
        $test = 10;
        $this->round->setSum($test);
        $res = $this->round->getSum();

        $this->assertEquals($test, $res);
    }

    /**
     * test throwing dices.
     */
    public function testThrowDices()
    {
        $sumBefore = $this->round->getSum();
        $this->round->throwDices();
        $sumAfter = $this->round->getSum();

        $this->assertNotEquals($sumBefore, $sumAfter);
    }

    /**
     * test showing dices.
     */
    public function testShowDices()
    {
        $this->round->throwDices();
        $valuesArray = $this->round->showThrownDices();

        $this->assertTrue(is_array($valuesArray));
    }
}
