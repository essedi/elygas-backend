<?php

namespace App\Entity;

use App\Entity\Movement;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class User extends BaseUser
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
     * @Groups({"user-read", "user-write"})
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $lastName;

    /**
     * One User has many childrens
     * @ORM\OneToMany(targetEntity="User", mappedBy="parent")
     */
    protected $childrens;

    /**
     * @ORM\OneToMany(targetEntity="Movement", mappedBy="user")
     * @Groups({"user-read", "user-write"})
     */
    protected $wallet;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $mobilePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $iban;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $direction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $directionNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $extension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $cp;

    /**
     * Many User has one parent
     * @ORM\ManyToOne(targetEntity="User", inversedBy="childrens", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @Groups({"user-write"})
     */
    private $parent;

    public function __construct()
    {
        parent::__construct();
        $this->childrens = new ArrayCollection();
        $this->wallet = new ArrayCollection();
    }

    function getId()
    {
        return $this->id;
    }

    function getName()
    {
        return $this->name;
    }

    function getLastName()
    {
        return $this->lastName;
    }

    function getChildrens()
    {
        return $this->childrens;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    function getIban()
    {
        return $this->iban;
    }

    function getDirection()
    {
        return $this->direction;
    }

    function getDirectionNumber()
    {
        return $this->directionNumber;
    }

    function getExtension()
    {
        return $this->extension;
    }

    function getCp()
    {
        return $this->cp;
    }

    function getParent()
    {
        return $this->parent;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setName($name)
    {
        $this->name = $name;
    }

    function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    function setChildren($children)
    {
        $this->childrens = $children;
    }

    function addChildren($children)
    {
        $this->childrens[] = $children;
        $children->setParent($this);
    }

    function removeChildren($children)
    {
        if ($this->childrens->contains($children))
        {
            $this->childrens->removeElement($children);

            if ($children->getParent() === $this)
            {
                $children->setParent(null);
            }
        }
    }

    function setPhone($phone)
    {
        $this->phone = $phone;
    }

    function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    }

    function setIban($iban)
    {
        $this->iban = $iban;
    }

    function setDirection($direction)
    {
        $this->direction = $direction;
    }

    function setDirectionNumber($directionNumber)
    {
        $this->directionNumber = $directionNumber;
    }

    function setExtension($extension)
    {
        $this->extension = $extension;
    }

    function setCp($cp)
    {
        $this->cp = $cp;
    }

    function setParent($parent)
    {
        $this->parent = $parent;
    }

    function getWallet()
    {
        $total = 0;
        foreach ($this->wallet as $movement)
        {
            if ($movement->getType() === Movement::ADD)
            {
                $total += $movement->getAmount();
            } else
            {
                $total -= $movement->getAmount();
            }
        }
        return $total;
    }

    function setWallet($movements)
    {
        $this->wallet = $movements;
    }

    function getMovements()
    {
        return $this->wallet;
    }

    function addWallet($movement)
    {
        $this->wallet[] = $movement;
        $movement->setUser($this);
    }

    function removeWallet($movement)
    {
        if ($this->wallet->contains($movement))
        {
            $this->wallet->removeElement($movement);

            if ($movement->getUser() === $this)
            {
                $movement->setUser(null);
            }
        }
    }

}
