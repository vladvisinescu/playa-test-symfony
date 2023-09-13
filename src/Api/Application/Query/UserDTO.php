<?php

namespace API\Application\Query;

use DateTimeImmutable;

class UserDTO
{
    public function __construct(
        private string $username,
        private string $email,
        private ?bool $is_active,
        private ?bool $is_member,
        private ?DateTimeImmutable $last_login_at,
        private ?int $user_type
    ) {}

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getIsActive(): bool
    {
        return (bool) $this->is_active;
    }

    public function getIsMember(): bool
    {
        return (bool) $this->is_member;
    }

    public function getLastLoginAt(): string|null
    {
        return $this->last_login_at?->format('Y-m-d H:i:s');
    }

    public function getUserType(): int
    {
        return $this->user_type;
    }

    /**
     * This method is used to convert the class to an array of attributes
     * Useful when creating a JSON response
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'username' => $this->getUsername(),
            'email' => $this->getEmail(),
            'is_active' => $this->getIsActive(),
            'is_member' => $this->getIsMember(),
            'last_login_at' => $this->getLastLoginAt(),
            'user_type' => $this->getUserType()
        ];
    }
}
