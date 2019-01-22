<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Tariff
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"user-read", "movement-write","movement-read"})
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"tariff-read", "tariff-write"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"tariff-read", "tariff-write"})
     */
    protected $country;

    /**
     * @ORM\Column(type="float", length=255, nullable=true)
     * @Groups({"tariff-read", "tariff-write"})
     */
    protected $price;

    /**
     * @ORM\OneToMany(targetEntity="Tariff", mappedBy="parent")
     * @Groups({"tariff-read", "tariff-write"})
     */
    private $children;

    /**
     * @ORM\ManyToOne(targetEntity="Tariff", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @Groups({"tariff-write"})
     */
    private $parent;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getCountry()
    {
        if ($this->parent)
        {
            $this->parent->getCountry();
        } else
        {
            return $this->country;
        }
    }

    function getPrice()
    {
        return $this->price;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setCountry($country)
    {
        $this->country = $country;
    }

    function setPrice($price)
    {
        $this->price = $price;
    }

    function getChildren()
    {
        return $this->children;
    }

    function getParent()
    {
        return $this->parent;
    }

    function setChildren($children)
    {
        $this->children = $children;
    }

    function setParent($parent)
    {
        $this->parent = $parent;
    }

}
