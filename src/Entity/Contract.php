<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

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
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $userType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $ownerName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $mobilePhone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $iban;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $direction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $directionNumber;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $extension;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $cp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $status;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     * @var string
     */
    protected $dni;

    /**
     * @Vich\UploadableField(mapping="ContractDni", fileNameProperty="dni")
     * @var File
     */
    protected $dniFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     * @var string
     */
    protected $dniBack;

    /**
     * @Vich\UploadableField(mapping="ContractDniBack", fileNameProperty="dniBack")
     * @var File
     */
    protected $dniBackFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     * @var string
     */
    protected $supplyContract;

    /**
     * @Vich\UploadableField(mapping="UserImage", fileNameProperty="supplyContract")
     * @var File
     */
    protected $supplyContractFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     * @var string
     */
    protected $invoice;

    /**
     * @Vich\UploadableField(mapping="ContractInvoice", fileNameProperty="invoice")
     * @var File
     */
    protected $invoiceFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     * @var string
     */
    protected $invoiceBack;

    /**
     * @Vich\UploadableField(mapping="ContractInvoiceBack", fileNameProperty="invoiceBack")
     * @var File
     */
    protected $invoiceBackFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     * @var string
     */
    protected $cif;

    /**
     * @Vich\UploadableField(mapping="ContractCif", fileNameProperty="cif")
     * @var File
     */
    protected $cifFile;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     * @var string
     */
    protected $gasInvoice;

    /**
     * @Vich\UploadableField(mapping="ContractGasInvoice", fileNameProperty="gasInvoice")
     * @var File
     */
    protected $gasInvoiceFile;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="contracts")
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $user;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"contract-read", "contract-write", "user-write"})
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected  $billingUserType;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected  $billingOwnerName;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected  $billingDirection;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected  $billingExtension;
 
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Groups({"contract-read", "contract-write", "user-read", "user-write"})
     */
    protected  $billingCp;

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

    function getDni()
    {
        return $this->dni;
    }

    function getDniFile(): ?File
    {
        return $this->dniFile;
    }

    function getDniBack()
    {
        return $this->dniBack;
    }

    function getDniBackFile(): ?File
    {
        return $this->dniBackFile;
    }

    function getSupplyContract()
    {
        return $this->supplyContract;
    }

    function getSupplyContractFile(): ?File
    {
        return $this->supplyContractFile;
    }

    function getInvoice()
    {
        return $this->invoice;
    }

    function getInvoiceFile(): ?File
    {
        return $this->invoiceFile;
    }

    function getInvoiceBack()
    {
        return $this->invoiceBack;
    }

    function getInvoiceBackFile(): ?File
    {
        return $this->invoiceBackFile;
    }

    function getCif()
    {
        return $this->cif;
    }

    function getCifFile(): ?File
    {
        return $this->cifFile;
    }

    function getGasInvoice()
    {
        return $this->gasInvoice;
    }

    function getGasInvoiceFile(): ?File
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

    function setDni($dni)
    {
        $this->dni = $dni;
    }

    /**
     * @param File|UploadedFile $dniFile
     */
    function setDniFile(File $dniFile)
    {
        $this->dniFile = $dniFile;
        if ($dniFile)
        {
            $this->setUpdatedAt(new \DateTime('now'));
        }
    }

    function setDniBack($dniBack)
    {
        $this->dniBack = $dniBack;
    }

    function setDniBackFile(File $dniBackFile)
    {
        $this->dniBackFile = $dniBackFile;
        if ($dniFile)
        {
            $this->setUpdatedAt(new \DateTime('now'));
        }
    }

    function setSupplyContract($supplyContract)
    {
        $this->supplyContract = $supplyContract;
    }

    function setSupplyContractFile(File $supplyContractFile)
    {
        $this->supplyContractFile = $supplyContractFile;
        if ($dniFile)
        {
            $this->setUpdatedAt(new \DateTime('now'));
        }
    }

    function setInvoice($invoice)
    {
        $this->invoice = $invoice;
    }

    function setInvoiceFile(File $invoiceFile)
    {
        $this->invoiceFile = $invoiceFile;
        if ($dniFile)
        {
            $this->setUpdatedAt(new \DateTime('now'));
        }
    }

    function setInvoiceBack($invoiceBack)
    {
        $this->invoiceBack = $invoiceBack;
    }

    function setInvoiceBackFile(File $invoiceBackFile)
    {
        $this->invoiceBackFile = $invoiceBackFile;
        if ($dniFile)
        {
            $this->setUpdatedAt(new \DateTime('now'));
        }
    }

    function setCif($cif)
    {
        $this->cif = $cif;
    }

    function setCifFile(File $cifFile)
    {
        $this->cifFile = $cifFile;
        if ($dniFile)
        {
            $this->setUpdatedAt(new \DateTime('now'));
        }
    }

    function setGasInvoice($gasInvoice)
    {
        $this->gasInvoice = $gasInvoice;
    }

    function setGasInvoiceFile(File $gasInvoiceFile)
    {
        $this->gasInvoiceFile = $gasInvoiceFile;
        if ($dniFile)
        {
            $this->setUpdatedAt(new \DateTime('now'));
        }
    }

    function getUser()
    {
        return $this->user;
    }

    function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    function setUser($user)
    {
        $this->user = $user;
    }

    function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }
    
    function getUserType()
    {
        return $this->userType;
    }
    
    function setUserType($userType)
    {
        $this->userType = $userType;
    }

    function setBillingUserType($billingUserType)
    {
        $this->billingUserType = $billingUserType;
    }

    function getBillingUserType()
    {
        return $this->billingUserType;
    } 

    function setBillingOwnerName($billingOwnerName)
    {
        $this->billingOwnerName = $billingOwnerName;
    }

    function getBillingOwnerName()
    {
        return $this->billingOwnerName;
    }

    function setBillingDirection($billingDirection)
    {
        $this->billingDirection = $billingDirection;
    }

    function getBillingDirection()
    {
        return $this->billingDirection;
    }

    function setBillingExtension($billingExtension)
    {
        $this->billingExtension = $billingExtension;
    }

    function getBillingExtension()
    {
        return $this->billingExtension;
    }

    function setBillingCp($billingCp)
    {
        $this->billingCp = $billingCp;
    }

    function getBillingCp()
    {
        return $this->billingCp;
    }
   
}
