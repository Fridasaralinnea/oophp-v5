<?php

namespace Fla\Dice;

/**
 * A trait implementing histogram for integers.
 */
trait HistogramTrait
{
    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];
    private $max = 6;
    private $min = 1;

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerie()
    {
        return $this->serie;
    }

    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getHistogramSerieAsString()
    {
        $string = implode(", ", $this->serie);
        return $string;
    }

    /**
     * Get min value for the histogram.
     *
     * @return int with the min value.
     */
    public function getHistogramMin()
    {
        return $this->min;
    }

    /**
     * Get max value for the histogram.
     *
     * @return int with the max value.
     */
    public function getHistogramMax()
    {
        return $this->max;
    }

    /**
     * Add values to serie.
     *
     * @return void with the max value.
     */
    public function addToSerie($array)
    {
        $serie = $this->serie;
        $values = $array;
        $this->serie = array_merge($serie, $values);
    }

    /**
     * Print out the histogram, default is to print out only the numbers
     * in the serie, but when $min and $max is set then print also empty
     * values in the serie, within the range $min, $max.
     *
     * @param int $min The lowest possible integer number.
     * @param int $max The highest possible integer number.
     *
     * @return string representing the histogram.
     */
    public function printHistogram()
    {
        $serie = $this->getHistogramSerie();
        $serieCounted = array_count_values($serie);
        ksort($serieCounted);

        $num = $this->min;
        $max = $this->max;
        $arrayMinMax = array();
        $histogramString = "";

        while ($num <= $max) {
            array_push($arrayMinMax, $num);
            $num++;
        }

        foreach ($arrayMinMax as $key => $val) {
            if (!array_key_exists($val, $serieCounted)) {
                $serieCounted[$val] = 0;
            }
        }

        ksort($serieCounted);

        foreach ($serieCounted as $key => $val) {
            $stars = str_repeat("*", $val);
            $histogramString .= "$key: $stars</br>";
        }
        return $histogramString;
    }
}
