<?php
namespace YadmBenchmark\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable */
class OrmPrice
{
    /** @ORM\Column(type = "string") */
    private $amount;

    /** @ORM\Column(type = "string") */
    private $currency;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
}