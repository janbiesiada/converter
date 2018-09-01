<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 01.09.18
 * Time: 15:52
 */

namespace Jbdev\CurrencyConverter\Api\Data;


interface RateInterface
{
    /**
     * @return float|null
     */
    public function getRate();

    /**
     * @param float $rate
     * @return $this
     */
    public function setRate($rate);
}