<?php

namespace Fla\Dice;

class Dice
{
    /**
     * @var integer $value    The value of the dice.
     * @var integer $sides    number of sides for the dice.
     */
    private $value;
    private $sides;

    /**
     * Constructor to create a Dice.
     *
     * @param int   $value The value of the dice.
     * @param int   $sides The number of sides for the dice.
     */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
        $this->value = rand(1, $this->sides);
    }

    /**
     * Get the value of the dice.
     *
     * @return int as the value of the dice.
     */
    public function getValue()
    {
        return $this->value;
    }

    // /**
    //  * Destroy a Dice.
    //  */
    // public function __destruct()
    // {
    // }
}
