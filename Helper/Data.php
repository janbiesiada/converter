<?php


namespace Jbdev\CurrencyConverter\Helper;


use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{

    public function getConvertUrl()
    {
        return "/converter";
    }
}