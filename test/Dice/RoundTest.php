<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class RoundTest extends TestCase
{
    /**
     * test set and get current.
     */
    public function testSetGetCurrent()
    {
        $round = new Round();
        $test = "test";
        $round->setCurrent($test);
        $res = $round->getCurrent();

        $this->assertEquals($test, $res);
    }

    /**
     * test set and get sum.
     */
    public function testSetGetSum()
    {
        $round = new Round();
        $test = 10;
        $round->setSum($test);
        $res = $round->getSum();

        $this->assertEquals($test, $res);
    }

    /**
     * test throwing dices.
     */
    public function testThrowDices()
    {
        $round = new Round();
        $sumBefore = $round->getSum();
        $round->throwDices();
        $sumAfter = $round->getSum();

        $this->assertNotEquals($sumBefore, $sumAfter);
    }

    /**
     * test showing dices.
     */
    public function testShowDices()
    {
        $round = new Round();
        $round->throwDices();
        $valuesArray = $round->showThrownDices();

        $this->assertTrue(is_array($valuesArray));
    }
}
