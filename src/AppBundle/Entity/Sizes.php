<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sizes
 *
 * @ORM\Table(name="sizes")
 * @ORM\Entity
 */
class Sizes
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
     * @var integer
     *
     * @ORM\Column(name="size_id", type="integer", nullable=false)
     */
    private $sizeId;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=32, nullable=false)
     */
    private $size;

    public function __toString()
    {
        return $this->getSize();
    }

    /**
     * Set sizeId
     *
     * @param integer $sizeId
     *
     * @return Sizes
     */
    public function setSizeId($sizeId)
    {
        $this->sizeId = $sizeId;

        return $this;
    }

    /**
     * Get sizeId
     *
     * @return integer
     */
    public function getSizeId()
    {
        return $this->sizeId;
    }

    /**
     * Set size
     *
     * @param string $size
     *
     * @return Sizes
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
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
