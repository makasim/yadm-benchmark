<?php
namespace YadmBenchmark\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="orders")
 */
class OrmOrder
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     *
     * @var integer $id
     */
    private $id;

    /**
     * @ORM\Column(name="number", type="string")
     */
    private $number;

    /** @ORM\Embedded(class = "OrmPrice") */
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
     * @return OrmPrice
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param OrmPrice $price
     */
    public function setPrice(OrmPrice $price = null)
    {
        $this->price = $price;
    }
}