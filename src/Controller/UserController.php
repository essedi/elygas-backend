<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\OptionsResolver\Exception\InvalidArgumentException;
use Doctrine\ORM\EntityManagerInterface;
use App\Helpers\ObjectUtils;

/**
 *
 */
class UserController extends Controller
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

    public function meAction(Request $request)
    {
        $params = \json_decode($request->getContent(), true);
        $user = $this->getUser();

        if ($params && count($params))
        {
            $user = $this->objectUtils->initialize($user, $params, ['parent', 'children']);

            if (isset($params['parent']))
            {
                $parent = $this->getDoctrine()->getRepository(User::class)->find($params['parent']['id']);
                $this->addChildren($parent, $user);
            }
        }

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function registerAction(Request $request)
    {
        $params = \json_decode($request->getContent(), true);
        if ($params && count($params) && isset($params["username"]) && isset($params["email"]) && isset($params["password"]))
        {
//check email and username
            $email = $this->getDoctrine()->getRepository(User::class)->findOneBy(["email" => $params["email"]]);
            if ($email)
            {
                throw new InvalidArgumentException("Email in use");
            }
//check passwords match
            if ($params["password"] !== $params["password_confirm"])
            {
                throw new InvalidArgumentException("Passwords not match");
            }

            $user = $this->objectUtils->initialize(new User(), $params, ['parent', 'childrens', 'password']);
            $user->setPlainPassword($params["password"]);

            $this->em->persist($user);
            $this->em->flush();
            $params = ["user" => $user->getid()];

            return new JsonResponse([
                "succes" => "User register",
                "data" => $params
            ]);
        }
        throw new NotFoundHttpException();
    }

    public function getUserTreeAction(Request $request)
    {
        $params = $request->query->all();
        $user = $this->getUser();

        $depth = 1;
        if (isset($params['depth']) && $params['depth'] > 1)
        {
            $depth = $params['depth'];
        }

        $childrens = $user->getChildrens();
        $response = [
            "user" => $user,
            "$user-childrens" => $childrens
        ];

        return new JsonResponse($this->normalizer->normalize($user->getChildrens()));
    }

    public function addChildren($parent, $children)
    {
        $maxChildren = getenv("MAX_CHILDREN");

        $childrenNumber = sizeof($parent->getChildrens());
        if ($childrenNumber < $maxChildren)
        {
            $parent->addChildren($children);
            $this->em->persist($parent);
            $this->em->flush();
        }
    }

}
