<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    protected $dice;

    /**
     * Set up.
     */
    protected function setUp()
    {
        $this->dice = new Dice();
    }

    /**
     * Test create new Dice.
     */
    public function testCreateDice()
    {
        $this->assertInstanceOf("\Fla\Dice\Dice", $this->dice);
    }

    /**
     * Test value is number between 1 and 6.
     */
    public function testGetValue()
    {
        $values = [1, 2, 3, 4, 5, 6];
        $value = $this->dice->getValue();
        $myBool = false;
        if (in_array($value, $values)) {
            $myBool = true;
        }
        $this->assertTrue($myBool);
    }
}
