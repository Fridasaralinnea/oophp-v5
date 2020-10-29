<?php

namespace Fla\Dice;

class DiceHand
{
    /**
     * @var integer $one    The value of dice one.
     * @var integer $two    The value of dice two.
     * @var integer $three    The value of dice three.
     */
    private $one;
    private $two;
    private $three;

    /**
     * Roll DiceHand.
     */
    public function roll()
    {
        $this->one = new Dice();
        $this->two = new Dice();
        $this->three = new Dice();
    }

    /**
     * Get the values of the hand .
     *
     * @return int as the values of the hand .
     */
    public function values()
    {
        $values = array($this->one->getValue(), $this->two->getValue(), $this->three->getValue());
        return $values;
    }

    /**
     * Get the sum of the hand .
     *
     * @return int as the sum of the hand .
     */
    public function sum()
    {
        $sum = array_sum($this->values());
        return $sum;
    }

    /**
     * Destroy a DiceHand.
     */
    public function __destruct()
    {
    }
}
