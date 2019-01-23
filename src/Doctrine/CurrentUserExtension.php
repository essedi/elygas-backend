<?php

namespace App\Doctrine;

use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use App\Entity\User;
use App\Entity\Movement;
use App\Entity\EmailMessage;
use App\Entity\Contract;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Form\Exception\InvalidConfigurationException;

final class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    private $tokenStorage;
    private $authorizationChecker;

    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $checker)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $checker;
    }

    /**
     * {@inheritdoc}
     */
    public function applyToCollection(
    QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null
    )
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * {@inheritdoc}
     */
    public function applyToItem(
    QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, string $operationName = null, array $context = []
    )
    {
        $this->addWhere($queryBuilder, $resourceClass);
    }

    /**
     * @param QueryBuilder $queryBuilder
     * @param string $resourceClass
     * @return null
     */
    private function addWhere(QueryBuilder $queryBuilder, string $resourceClass)
    {

        $token = $this->tokenStorage->getToken();
        if (!is_object($token))
        {
            throw new InvalidConfigurationException();
        }
        $user = $token->getUser();
        if ($user instanceof User)
        {
            $rootAlias = $queryBuilder->getRootAliases()[0];
            $params = $queryBuilder->getParameters();
            switch ($resourceClass)
            {
                case Movement::class:
                    $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
                    $params->add(new Parameter('current_user', $user->getId()));
                    $queryBuilder->setParameters($params);
                    break;
                case Contract::class:
                    if (!($user->hasRole(User::ROLE_SUPER_ADMIN)))
                    {
                        $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias));
                        $params->add(new Parameter('current_user', $user->getId()));
                        $queryBuilder->setParameters($params);
                    }
                    break;
                case EmailMessage::class:
                    $queryBuilder->andWhere(sprintf('%s.destination = :current_user', $rootAlias));
                    $params->add(new Parameter('current_user', $user->getId()));
                    $queryBuilder->setParameters($params);
                    break;
                default:
                    break;
            }
        }
    }

}
