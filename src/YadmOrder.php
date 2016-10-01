<?php
namespace YadmBenchmark;

use Makasim\Yadm\ObjectsTrait;
use Makasim\Yadm\ValuesTrait;

class YadmOrder
{
    use ValuesTrait;
    use ObjectsTrait;

    public function getNumber()
    {
        return $this->getValue('number');
    }

    public function setNumber($number)
    {
        $this->setValue('number', $number);
    }

    /**
     * @return YadmPrice
     */
    public function getPrice()
    {
        return $this->getObject('price', YadmPrice::class);
    }

    public function setPrice(YadmPrice $price = null)
    {
        $this->setObject('price', $price);
    }
}