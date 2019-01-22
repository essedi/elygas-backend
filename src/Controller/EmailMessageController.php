<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\EmailMessage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;
use Doctrine\ORM\EntityManagerInterface;
use App\Helpers\ObjectUtils;

class EmailMessageController extends Controller
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

    public function __construct(NormalizerInterface $normalizer, ObjectUtils $objectUtils, EntityManagerInterface $em)
    {
        $this->normalizer = $normalizer;
        $this->objectUtils = $objectUtils;
        $this->em = $em;
    }

    public function getUserMessagesAction(Request $request)
    {
        $user = $this->getUser();

        $messages = $this->getDoctrine()->getRepository(EmailMessage::class)->findBy(["destination" => $user]);

        return new JsonResponse($this->normalizer->normalize($messages));
    }

}
