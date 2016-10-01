<?php
namespace YadmBenchmark;

use Makasim\Yadm\ObjectsTrait;
use Makasim\Yadm\ValuesTrait;

class YadmPrice
{
    use ValuesTrait;

    public function getAmount()
    {
        return $this->getValue('amount');
    }

    public function setAmount($amount)
    {
        $this->setValue('amount', $amount);
    }

    public function getCurrency()
    {
        return $this->getValue('currency');
    }

    public function setCurrency($currency)
    {
        $this->setValue('currency', $currency);
    }
}