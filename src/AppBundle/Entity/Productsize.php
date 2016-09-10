<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Productsize
 *
 * @ORM\Table(name="productsize", indexes={@ORM\Index(name="fk_productsize_size_idx", columns={"size_id"}), @ORM\Index(name="fk_productsize_products1_idx", columns={"product_id"})})
 * @ORM\Entity
 */
class Productsize
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
     * @ORM\Column(name="product_id", type="integer", nullable=true)
     */
    private $productId;

    /**
     * @var integer
     *
     * @ORM\Column(name="size_id", type="integer", nullable=false)
     */
    private $sizeId;



    /**
     * Set productId
     *
     * @param integer $productId
     *
     * @return Productsize
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get productId
     *
     * @return integer
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set sizeId
     *
     * @param integer $sizeId
     *
     * @return Productsize
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
