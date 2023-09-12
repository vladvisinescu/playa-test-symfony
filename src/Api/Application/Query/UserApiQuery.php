<?php

namespace API\Application\Query;

use API\Domain\User;
use API\Domain\UserRepository;

class UserApiQuery
{
    public function __construct(
        private UserRepository $repository
    ) {}

    public function fetchAll(): array
    {
        $results = $this->repository->fetchAll();

        return \array_map(function (User $item) {
            return new UserDTO(
                $item->getUsername(),
                $item->getEmail(),
                $item->getIsActive(),
                $item->getIsMember(),
                $item->getLastLoginAt(),
                $item->getUserType()
            );
        }, $results);
    }
}
