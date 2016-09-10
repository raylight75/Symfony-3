<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Products
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
     * 
     * @ORM\ManyToMany(targetEntity="Sizes")
     * @ORM\JoinTable(name="Productsize",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="size_id", referencedColumnName="id", unique=true)}
     *      )
     */
    private $size;
    
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=45, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=16777215, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="a_img", type="string", length=45, nullable=false)
     */
    private $aImg;

    /**
     * @var string
     *
     * @ORM\Column(name="b_img", type="string", length=45, nullable=false)
     */
    private $bImg;

    /**
     * @var string
     *
     * @ORM\Column(name="c_img", type="string", length=45, nullable=false)
     */
    private $cImg;

    /**
     * @ORM\OneToOne(targetEntity="Brands")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     */
    private $brandId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false)
     */
    private $catId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=false)
     */
    private $parentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer", nullable=true)
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;
    
    public function __construct()
    {
        $this->size = new \Doctrine\Common\Collections\ArrayCollection();
    }  

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Products
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Products
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Products
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set aImg
     *
     * @param string $aImg
     *
     * @return Products
     */
    public function setAImg($aImg)
    {
        $this->aImg = $aImg;

        return $this;
    }

    /**
     * Get aImg
     *
     * @return string
     */
    public function getAImg()
    {
        return $this->aImg;
    }

    /**
     * Set bImg
     *
     * @param string $bImg
     *
     * @return Products
     */
    public function setBImg($bImg)
    {
        $this->bImg = $bImg;

        return $this;
    }

    /**
     * Get bImg
     *
     * @return string
     */
    public function getBImg()
    {
        return $this->bImg;
    }

    /**
     * Set cImg
     *
     * @param string $cImg
     *
     * @return Products
     */
    public function setCImg($cImg)
    {
        $this->cImg = $cImg;

        return $this;
    }

    /**
     * Get cImg
     *
     * @return string
     */
    public function getCImg()
    {
        return $this->cImg;
    }

    /**
     * Set brandId
     *
     * @param integer $brandId
     *
     * @return Products
     */
    public function setBrandId($brandId)
    {
        $this->brandId = $brandId;

        return $this;
    }

    /**
     * Get brandId
     *
     * @return integer
     */
    public function getBrandId()
    {
        return $this->brandId;
    }

    /**
     * Set catId
     *
     * @param integer $catId
     *
     * @return Products
     */
    public function setCatId($catId)
    {
        $this->catId = $catId;

        return $this;
    }

    /**
     * Get catId
     *
     * @return integer
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     *
     * @return Products
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Products
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Products
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
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
    
    /**
     * Set size
     *
     * @return float
     */
    public function setSize($size)
    {
         $this->size = $size;

        return $this;
    }

    /**
     * Get Size
     *
     * @return integer
     */
    public function getSize()
    {
        return $this->size;
    }
}
