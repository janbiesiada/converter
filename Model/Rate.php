<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 01.09.18
 * Time: 15:58
 */

namespace Jbdev\CurrencyConverter\Model;


use Jbdev\CurrencyConverter\Api\Data\RateInterface;

class Rate implements RateInterface
{
    protected $rate;


    /**
     * @return float|null
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * @param float $rate
     * @return $this
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }
}