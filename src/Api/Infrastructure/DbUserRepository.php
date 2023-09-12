<?php

namespace API\Infrastructure;

use API\Domain\User;
use API\Domain\UserRepository;
use Doctrine\DBAL\Connection;

class DbUserRepository implements UserRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function fetchFiltered(array $options): array
    {
        return [];
    }

    public function fetchAll(): array
    {
        $stmt = $this->connection->prepare('
            SELECT * FROM test_users WHERE last_login_at IS NOT NULL
        ');

        $result = $stmt->execute();
        $result = $result->fetchAllAssociative();

        return \array_map(function (array $row) {
            return User::create(
                $row['username'],
                $row['email'],
                $row['password'],
                $row['is_active'],
                $row['is_member'],
                $row['last_login_at'],
                $row['user_type']
            );
        }, $result);
    }
}
