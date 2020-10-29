<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    /**
     * Test create new Dice.
     */
    public function testCreateDice()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Fla\Dice\Dice", $dice);
    }

    /**
     * Test value is number between 1 and 6.
     */
    public function testGetValue()
    {
        $dice = new Dice();
        $values = [1, 2, 3, 4, 5, 6];
        $value = $dice->getValue();
        $myBool = false;
        if (in_array($value, $values)) {
            $myBool = true;
        }
        $this->assertTrue($myBool);
    }
}
