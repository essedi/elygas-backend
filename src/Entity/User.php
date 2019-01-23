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

    const TYPE_ENTERPRISE = 'ENTERPRISE';
    const TYPE_NOT_ENTERPRISE = 'NOT_ENTERPRISE';

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
     * One User has many childrens
     * @ORM\OneToMany(targetEntity="User", mappedBy="parent")
     * @Groups({"children-read"})
     */
    protected $childrens;

    /**
     * @ORM\OneToMany(targetEntity="Movement", mappedBy="user")
     * @Groups({"user-read", "user-write"})
     */
    protected $wallet;

    /**
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="user")
     * @Groups({"user-read", "user-write"})
     */
    protected $contracts;

    /**
     * @ORM\OneToMany(targetEntity="EmailMessage", mappedBy="author")
     * @Groups({"user-write"})
     */
    protected $mailsReceived;

    /**
     * @ORM\OneToMany(targetEntity="EmailMessage", mappedBy="destination")
     * @Groups({"user-write"})
     */
    protected $mailsSent;

    /**
     * Many User has one parent
     * @ORM\ManyToOne(targetEntity="User", inversedBy="childrens", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @Groups({"user-write"})
     */
    private $parent;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $course;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $ePin;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $country;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $city;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $cp;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $direction;

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
     * @ORM\Column(type="datetime")
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $createdDate;

    public function __construct()
    {
        parent::__construct();
        $this->childrens = new ArrayCollection();
        $this->wallet = new ArrayCollection();
        $this->createdDate = new \DateTime('now');
    }

    function getId()
    {
        return $this->id;
    }

    function getChildrens()
    {
        return $this->childrens;
    }

    function getParent()
    {
        return $this->parent;
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

    function getMailsReceived()
    {
        return $this->mailsReceived;
    }

    function getMailsSent()
    {
        return $this->mailsSent;
    }

    function setMailsReceived($mailsReceived)
    {
        $this->mailsReceived = $mailsReceived;
    }

    function setMailsSent($mailsSent)
    {
        $this->mailsSent = $mailsSent;
    }

    function getContracts()
    {
        return $this->contracts;
    }

    function setContracts($contracts)
    {
        $this->contracts = $contracts;
    }

    function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    function getCreatedDate()
    {
        return $this->createdDate;
    }

    function setCourse($course)
    {
        $this->course = $course;
    }

    function getCourse()
    {
        return $this->course;
    }

    function setEPin($ePin)
    {
        $this->ePin = $ePin;
    }

    function getEPin()
    {
        return $this->ePin;
    }

    function setPhone($phone)
    {
        $this->phone = $phone;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function getMobilePhone()
    {
        return $this->mobilePhone;
    }

    function setMobilePhone($mobilePhone)
    {
        $this->mobilePhone = $mobilePhone;
    }

    function getCountry()
    {
        return $this->country;
    }

    function setCountry($country)
    {
        $this->country = $country;
    }

    function getCp()
    {
        return $this->cp;
    }

    function setCp($cp)
    {
        $this->cp = $cp;
    }

    function getProvince()
    {
        return $this->province;
    }

    function setProvince($province)
    {
        $this->province = $province;
    }

    function getDirection()
    {
        return $this->direction;
    }

    function setDirection($direction)
    {
        $this->direction = $direction;
    }

}

//country city cp direction