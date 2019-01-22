<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class EmailMessage
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Groups({"emailMessage-read", "emailMessage-write", "user-read"})
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="mailsReceived")
     * @Groups({"emailMessage-read", "emailMessage-write", "user-read"})
     */
    protected $author;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="mailsSent")
     * @Groups({"emailMessage-read", "emailMessage-write", "user-read"})
     */
    protected $destination;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"emailMessage-read", "emailMessage-write", "user-read"})
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"emailMessage-read", "emailMessage-write", "user-read"})
     */
    protected $message;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"emailMessage-read", "emailMessage-write", "user-read"})
     */
    protected $createdDate;

    function getId()
    {
        return $this->id;
    }

    function getAuthor()
    {
        return $this->author;
    }

    function getDestination()
    {
        return $this->destination;
    }

    function getTitle()
    {
        return $this->title;
    }

    function getMessage()
    {
        return $this->message;
    }

    function getCreatedDate()
    {
        return $this->createdDate;
    }

    function setAuthor($author)
    {
        $this->author = $author;
    }

    function setDestination($destination)
    {
        $this->destination = $destination;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function setMessage($message)
    {
        $this->message = $message;
    }

    function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

}
