<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\User;

/**
 * @ORM\Entity
 */
class Movement
{

    const ADD = '+';
    const REMOVE = '-';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"movement-read", "user-read"})
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="wallet")
     * @Groups({"movement-read", "movement-write"})
     */
    protected $user;

    /**
     * @ORM\Column(type="float")
     * @Groups({"movement-read", "movement-write"})
     */
    protected $amount;

    /**
     * @ORM\Column(type="string",length=1)
     * @Groups({"movement-read", "movement-write"})
     */
    protected $type;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"movement-read", "movement-write"})
     */
    private $createdDate;

    public function __construct()
    {
        $this->createdDate = new \dateTime();
    }

    function getId()
    {
        return $this->id;
    }

    function getUser(): User
    {
        return $this->user;
    }

    function getAmount()
    {
        return $this->amount;
    }

    function getType()
    {
        return $this->type;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setUser(User $user)
    {
        $this->user = $user;
    }

    function setAmount($amount)
    {
        $this->amount = $amount;
    }

    function setType($type)
    {
        $this->type = $type;
    }

    function getCreatedDate()
    {
        return $this->createdDate;
    }

    function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

}
