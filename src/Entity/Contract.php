<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 */
class Contract
{

    const STATUS_PENDING = 'PENDING';
    const STATUS_VALIDATED = 'VALIDATED';
    const STATUS_VERIFIED = 'VERIFIED';
    const STATUS_PROCESSED = 'PROCESSED';
    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_CANCELED = 'CANCELED';

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
    protected $ownerName;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"user-read", "user-write"})
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $status;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user-read", "user-write"})
     * @var string
     */
    protected $dniFront;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="image")
     * @var File
     */
    protected $dniFrontFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user-read", "user-write"})
     * @var string
     */
    protected $dniBack;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="image")
     * @var File
     */
    protected $dniBackFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user-read", "user-write"})
     * @var string
     */
    protected $supplyContract;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="image")
     * @var File
     */
    protected $supplyContractFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user-read", "user-write"})
     * @var string
     */
    protected $invoice;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="image")
     * @var File
     */
    protected $invoiceFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user-read", "user-write"})
     * @var string
     */
    protected $invoiceBack;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="image")
     * @var File
     */
    protected $invoiceBackFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user-read", "user-write"})
     * @var string
     */
    protected $cif;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="image")
     * @var File
     */
    protected $cifFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"user-read", "user-write"})
     * @var string
     */
    protected $gasInvoice;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="image")
     * @var File
     */
    protected $gasInvoiceFile;
    
    /**
     * 
     */
    protected $contractCreator;
    protected $contractSigner;

    function getId()
    {
        return $this->id;
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

    function getStatus()
    {
        return $this->status;
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

    function setStatus($status)
    {
        $this->status = $status;
    }

    function getOwnerName()
    {
        return $this->ownerName;
    }

    function getEmail()
    {
        return $this->email;
    }

    function getDniFront()
    {
        return $this->dniFront;
    }

    function getDniFrontFile(): File
    {
        return $this->dniFrontFile;
    }

    function getDniBack()
    {
        return $this->dniBack;
    }

    function getDniBackFile(): File
    {
        return $this->dniBackFile;
    }

    function getSupplyContract()
    {
        return $this->supplyContract;
    }

    function getSupplyContractFile(): File
    {
        return $this->supplyContractFile;
    }

    function getInvoice()
    {
        return $this->invoice;
    }

    function getInvoiceFile(): File
    {
        return $this->invoiceFile;
    }

    function getInvoiceBack()
    {
        return $this->invoiceBack;
    }

    function getInvoiceBackFile(): File
    {
        return $this->invoiceBackFile;
    }

    function getCif()
    {
        return $this->cif;
    }

    function getCifFile(): File
    {
        return $this->cifFile;
    }

    function getGasInvoice()
    {
        return $this->gasInvoice;
    }

    function getGasInvoiceFile(): File
    {
        return $this->gasInvoiceFile;
    }

    function setOwnerName($ownerName)
    {
        $this->ownerName = $ownerName;
    }

    function setEmail($email)
    {
        $this->email = $email;
    }

    function setDniFront($dniFront)
    {
        $this->dniFront = $dniFront;
    }

    function setDniFrontFile(File $dniFrontFile)
    {
        $this->dniFrontFile = $dniFrontFile;
    }

    function setDniBack($dniBack)
    {
        $this->dniBack = $dniBack;
    }

    function setDniBackFile(File $dniBackFile)
    {
        $this->dniBackFile = $dniBackFile;
    }

    function setSupplyContract($supplyContract)
    {
        $this->supplyContract = $supplyContract;
    }

    function setSupplyContractFile(File $supplyContractFile)
    {
        $this->supplyContractFile = $supplyContractFile;
    }

    function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    function setInvoiceFile(File $invoiceFile)
    {
        $this->invoiceFile = $invoiceFile;
    }

    function setInvoiceBack($invoiceBack)
    {
        $this->invoiceBack = $invoiceBack;
    }

    function setInvoiceBackFile(File $invoiceBackFile)
    {
        $this->invoiceBackFile = $invoiceBackFile;
    }

    function setCif($cif)
    {
        $this->cif = $cif;
    }

    function setCifFile(File $cifFile)
    {
        $this->cifFile = $cifFile;
    }

    function setGasInvoice($gasInvoice)
    {
        $this->gasInvoice = $gasInvoice;
    }

    function setGasInvoiceFile(File $gasInvoiceFile)
    {
        $this->gasInvoiceFile = $gasInvoiceFile;
    }

}
