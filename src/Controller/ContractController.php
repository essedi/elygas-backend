<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contract;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;
use Vich\UploaderBundle\Storage\StorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Helpers\ObjectUtils;

class ContractController extends Controller
{

    /**
     * @var NormalizerInterface
     */
    private $normalizer;

    /**
     * @var ObjectUtils
     */
    protected $objectUtils;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var StorageInterface
     */
    protected $storage;

    public function __construct(NormalizerInterface $normalizer, ObjectUtils $objectUtils, EntityManagerInterface $em, StorageInterface $storage)
    {
        $this->normalizer = $normalizer;
        $this->objectUtils = $objectUtils;
        $this->em = $em;
        $this->storage = $storage;
    }

    public function uploadImageAction(Request $request, $id = null)
    {
        $dni = $request->files->get('dni');
        $dniBack = $request->files->get('dniBack');
        $supplyContract = $request->files->get('supplyContract');
        $invoice = $request->files->get('invoice');
        $invoiceBack = $request->files->get('invoiceBack');
        $cif = $request->files->get('cif');
        $gasInvoice = $request->files->get('gasInvoice');

        if ($id)
        {
            $contract = $this->getDoctrine()->getRepository(Contract::class)->find($id);
        } else
        {
            throw new \Exception("Contract not found");
        }

        if ($dni)
        {
            $contract->setDniFile($dni);
        }

        if ($dniBack)
        {
            $contract->setDniBackFile($dniBack);
        }

        if ($supplyContract)
        {
            $contract->setSupplyContractFile($supplyContract);
        }

        if ($invoice)
        {
            $contract->setInvoiceFile($invoice);
        }

        if ($invoiceBack)
        {
            $contract->setInvoiceBackFile($invoiceBack);
        }

        if ($cif)
        {
            $contract->setCifFile($cif);
        }

        if ($gasInvoice)
        {
            $contract->setGasInvoiceFile($gasInvoice);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($contract);
        $em->flush();

        return new JsonResponse($this->normalizer->normalize($contract));
    }

}
