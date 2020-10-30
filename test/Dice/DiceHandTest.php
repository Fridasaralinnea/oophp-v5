<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    protected $diceHand;

    /**
     * Set up.
     */
    protected function setUp()
    {
        $this->diceHand = new DiceHand();
    }

    /**
     * Roll diceHand and control values
     */
    public function testValuesArray()
    {
        $this->diceHand->roll();
        $valuesArray = $this->diceHand->values();
        $this->assertTrue(is_array($valuesArray));
    }

    /**
     * test sum of values array.
     */
    public function testSum()
    {
        $this->diceHand->roll();
        $valuesArray = $this->diceHand->values();
        $exp = array_sum($valuesArray);
        $res = $this->diceHand->sum();

        $this->assertEquals($exp, $res);
    }
}
