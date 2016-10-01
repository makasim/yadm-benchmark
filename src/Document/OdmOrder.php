<?php
namespace YadmBenchmark\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class OdmOrder
{
    /**
     * @ODM\Id
     */
    private $id;

    /**
     * @ODM\Field(type="string")
     */
    private $number;

    /** @ODM\EmbedOne(targetDocument="OdmPrice") */
    private $price;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return OdmPrice
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param OdmPrice $price
     */
    public function setPrice(OdmPrice $price = null)
    {
        $this->price = $price;
    }
}