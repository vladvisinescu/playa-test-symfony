<?php

namespace API\Application\Query;

use DateTime;
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

    public function isActive(): bool
    {
        return (bool) $this->is_active;
    }

    public function isMember(): bool
    {
        return (bool) $this->is_member;
    }

    public function getLastLoginAt(): DateTimeImmutable
    {
        return $this->last_login_at;
    }

    public function getUserType(): int
    {
        return $this->user_type;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'email' => $this->email,
            'is_active' => $this->is_active,
            'is_member' => $this->is_member,
            'last_login_at' => $this->last_login_at?->format('Y-m-d H:i:s'),
            'user_type' => $this->user_type
        ];
    }
}
