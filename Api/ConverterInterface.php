<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 01.09.18
 * Time: 08:51
 */

namespace Jbdev\CurrencyConverter\Api;



interface ConverterInterface
{
    /**
     * @return \Jbdev\CurrencyConverter\Api\Data\RateInterface
     */
    public function getRate();
}