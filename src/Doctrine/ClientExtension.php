<?php

namespace App\Doctrine;

use App\Entity\User;
use Doctrine\ORM\QueryBuilder;
use ApiPlatform\Metadata\Operation;
use Symfony\Bundle\SecurityBundle\Security;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;

final class ClientExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

	private Security $security;

	public function __construct(Security $security)
	{
		$this->security = $security;
	}

	public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operation = null, array $context = []): void
	{
		$this->addWhere($queryBuilder, $resourceClass);
	}

	public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, ?Operation $operation = null, array $context = []): void
	{
		$this->addWhere($queryBuilder, $resourceClass);
	}

	public function addWhere(QueryBuilder $queryBuilder, string $resourceClass): void
	{
		if (User::class !== $resourceClass || null === $client = $this->security->getUser())
			return;
		$rootAlias = $queryBuilder->getRootAliases()[0];
		$queryBuilder->andWhere(sprintf('%s.client = :current_client', $rootAlias));
		$queryBuilder->setParameter('current_client', $client);
	}
}