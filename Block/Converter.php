<?php

namespace Jbdev\CurrencyConverter\Block;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Converter implements ArgumentInterface
{
    public function getConvertUrl()
    {
        return "/rest/V1/converter/rate";
    }
}