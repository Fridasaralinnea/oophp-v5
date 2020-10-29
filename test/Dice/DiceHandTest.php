<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    /**
     * Roll diceHand and control values
     */
    public function testValuesArray()
    {
        $diceHand = new DiceHand();
        $diceHand->roll();
        $valuesArray = $diceHand->values();
        $this->assertTrue(is_array($valuesArray));
    }

    /**
     * test sum of values array.
     */
    public function testSum()
    {
        $diceHand = new DiceHand();
        $diceHand->roll();
        $valuesArray = $diceHand->values();
        $exp = array_sum($valuesArray);
        $res = $diceHand->sum();

        $this->assertEquals($exp, $res);
    }
}
