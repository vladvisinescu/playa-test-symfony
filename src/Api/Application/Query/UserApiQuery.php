<?php

namespace API\Application\Query;

use API\Domain\User;
use API\Domain\UserInterface;

class UserApiQuery
{
    public function __construct(
        private UserInterface $repository
    ) {}

    public function fetchAll(array $options): array
    {
        $results = $this->repository->findWithFilters($options);

        return array_map(function (User $item) {
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
