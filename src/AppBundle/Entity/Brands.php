<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brands
 *
 * @ORM\Table(name="brands")
 * @ORM\Entity
 */
class Brands
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * * @var string
     *
     * @ORM\Column(name="brand", type="string", length=45, nullable=false)     
     */
    private $brand;

    public function __toString()
    {
       return $this->getBrand();
    }    
    
    /**
     * Set brand
     *
     * @param string $brand
     *
     * @return Brands
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

}
