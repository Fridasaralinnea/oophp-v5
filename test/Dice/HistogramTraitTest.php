<?php

namespace Fla\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HistogramTraitTest extends TestCase
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
     * Test get histogram serie.
     */
    public function testGetHistogramSerie()
    {
        $exp = [];
        $res = $this->game->getHistogramSerie();

        $this->assertEquals($exp, $res);
    }

    /**
     * Test get histogram serie as string.
     */
    public function testGetHistogramSerieAsString()
    {
        $exp = "";
        $res = $this->game->getHistogramSerieAsString();

        $this->assertEquals($exp, $res);
    }

    /**
     * Test get histogram min.
     */
    public function testGetHistogramMin()
    {
        $exp = 1;
        $res = $this->game->getHistogramMin();

        $this->assertEquals($exp, $res);
    }

    /**
     * Test get histogram max.
     */
    public function testGetHistogramMax()
    {
        $exp = 6;
        $res = $this->game->getHistogramMax();

        $this->assertEquals($exp, $res);
    }
}
