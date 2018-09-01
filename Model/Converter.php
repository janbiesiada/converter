<?php
/**
 * Created by PhpStorm.
 * User: jan
 * Date: 01.09.18
 * Time: 15:57
 */

namespace Jbdev\CurrencyConverter\Model;


use Jbdev\CurrencyConverter\Api\ConverterInterface;
use Jbdev\CurrencyConverter\Api\Data\RateInterface;
use Jbdev\CurrencyConverter\Model\RateFactory;
use Magento\Framework\HTTP\Client\Curl;
use Zend\Json\Json;

class Converter implements ConverterInterface
{

    /**
     * @var RateFactory
     */
    private $rateFactory;
    /**
     * @var Curl
     */
    private $curl;

    public function __construct(
        RateFactory $rateFactory,
        Curl $curl
    )
    {
        $this->rateFactory = $rateFactory;
        $this->curl = $curl;
    }

    /**
     * {@inheritdoc}
     */
    public function getRate()
    {
        try {
            $this->curl->get($this->getApiUrl());
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong during api call');
        }
        /** @var RateInterface $rate */
        $rate = $this->rateFactory->create();
        $curlResponse = Json::decode($this->curl->getBody());
        $rate->setRate($curlResponse->rates[0]->mid);
        return $rate;
    }

    public function getApiUrl()
    {
        return "http://api.nbp.pl/api/exchangerates/rates/A/rub?format=json";
    }
}