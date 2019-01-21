<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
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
     * @Groups("user-read")
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
    private $lastName;

    /**
     * One User has many childrens
     * @ORM\OneToMany(targetEntity="User", mappedBy="parent")
     */
    private $children;

    /**
     * Many User has one parent
     * @ORM\ManyToOne(targetEntity="User", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * @Groups({"user-read", "user-write"})
     */
    private $parent;

    public function __construct()
    {
        parent::__construct();
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

    function getChildren()
    {
        return $this->children;
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
        $this->children = $children;
    }

    function setParent($parent)
    {
        $this->parent = $parent;
    }

}
