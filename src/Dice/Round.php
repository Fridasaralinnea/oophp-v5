<?php

namespace Fla\Dice;

/**
 * Game my number, a class supporting the game through GET, POST and SESSION.
 */
class Round implements HistogramInterface
{
    use HistogramTrait;

    /**
     * @var string $current   The current player.
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    protected $current;
    protected $sum;
    protected $diceHand;


    // /**
    //  * Constructor to initiate the object with current game settings,
    //  * if available. Randomize the current number if no value is sent in.
    //  *
    //  * @param int $sum  Points for the player currently playing.
    //  */
    //
    // public function __construct(int $sum = 0)
    // {
    //     $this->sum = $sum;
    // }

    /**
     * Set current player.
     *
     * @return void
     */
    public function setCurrent($currentPlayer)
    {
        $this->current = $currentPlayer;
    }

    /**
     * Get current player.
     *
     * @return string
     */
    public function getCurrent()
    {
        return $this->current;
    }

    /**
     * Throw dices.
     *
     * @return void
     */
    public function throwDices()
    {
        $this->diceHand = new DiceHand();
        $this->diceHand->roll();
        $this->addToSerie($this->diceHand->values());
        $this->sum += $this->diceHand->sum();
    }

    /**
     * Show thrown dices.
     *
     * @return array
     */
    public function showThrownDices()
    {
        $valuesArray = $this->diceHand->values();
        return $valuesArray;
    }

    /**
     * Set sum.
     *
     * @return void
     */
    public function setSum($sum)
    {
        $this->sum = $sum;
    }

    /**
     * Get current sum.
     *
     * @return int
     */
    public function getSum()
    {
        return $this->sum;
    }
}
