<?php

namespace Jbdev\CurrencyConverter\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\HTTP\Client\Curl;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\Webapi\Rest\Response
     */
    private $result;
    /**
     * @var Curl
     */
    private $curl;


    public function __construct(
        Context $context,
        Json $result,
        Curl $curl
    )
    {
        parent::__construct($context);
        $this->result = $result;
        $this->curl = $curl;
    }

    /**
     *
     * @param string|null $coreRoute
     * @return \Magento\Framework\Controller\Result\Forward
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($coreRoute = null)
    {
        try{
            $data = [
                'code' => 200,
                'rate' => $this->getRate(),
                'message' => 'ok',
                'error' => ''
            ];
        } catch (\Exception $exception) {
            $data = [
                'code' => $exception->getCode(),
                'rate' => '',
                'message' => 'something went wrong',
                'error' => $exception->getMessage()
            ];
        }
        return $this->result->setData($data);
    }

    public function getApiUrl()
    {
        return "http://api.nbp.pl/api/exchangerates/rates/A/rub?format=json";
    }

    protected function getRate()
    {
        $this->curl->get($this->getApiUrl());
        $curlResponse = \Zend\Json\Json::decode($this->curl->getBody());
        return $curlResponse->rates[0]->mid;
    }
}
