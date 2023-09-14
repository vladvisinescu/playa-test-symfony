<?php

namespace API\Infrastructure;

use API\Domain\User;
use API\Domain\UserInterface;
use App\Entity\TestUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TestUser>
 *
 * @method TestUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TestUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TestUser[]    findAll()
 * @method TestUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements UserInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TestUser::class);
    }

    public function findWithFilters(array $options): array
    {
        $builder = $this->createQueryBuilder('tu');

        if (isset($options['is_active'])) {
            $builder
                ->andWhere('tu.is_active = :is_active')
                ->setParameter('is_active', $options['is_active']);
        }

        if (isset($options['is_member'])) {
            $builder
                ->andWhere('tu.is_member = :is_member')
                ->setParameter('is_member', $options['is_member']);
        }

        if (isset($options['last_login_at'])) {
            $builder
                ->andWhere('tu.last_login_at BETWEEN :start AND :end')
                ->setParameter('start', $options['last_login_at']['start'])
                ->setParameter('end', $options['last_login_at']['end']);
        }

        if (isset($options['user_type'])) {
            $builder
                ->andWhere('tu.user_type IN (:user_type)')
                ->setParameter('user_type', $options['user_type']);
        }

        $result = $builder->getQuery()->execute();

        return \array_map(function (TestUser $user) {
            return User::create(
                $user->getUsername(),
                $user->getEmail(),
                $user->getPassword(),
                $user->getIsActive(),
                $user->getIsMember(),
                $user->getLastLoginAt(),
                $user->getUserType()
            );
        }, $result);
    }
}
