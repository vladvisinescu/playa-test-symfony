<?php

namespace API\Domain;

use DateTimeImmutable;

class User
{
    private function __construct(
        private string $username,
        private string $email,
        private string $password,
        private ?bool $is_active,
        private ?bool $is_member,
        private ?DateTimeImmutable $last_login_at,
        private ?int $user_type
    ) {}

    public static function create(
        $username,
        $email,
        $password,
        $is_active = 0,
        $is_member = 0,
        $last_login_at = null,
        $user_type = 0
    ) {
        if ('' === $username) {
            throw new \InvalidArgumentException('Username cannot be empty.');
        }

        if ('' === $email) {
            throw new \InvalidArgumentException('Email cannot be empty.');
        }

        if ('' === $password) {
            throw new \InvalidArgumentException('Password cannot be empty.');
        }

        return new self(
            $username,
            $email,
            $password,
            $is_active,
            $is_member,
            DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $last_login_at)
                ? DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $last_login_at)
                : null,
            $user_type
        );
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getIsActive(): bool|null
    {
        return $this->is_active;
    }

    public function getIsMember(): bool|null
    {
        return $this->is_member;
    }

    public function getLastLoginAt(): DateTimeImmutable|null
    {
        return $this->last_login_at;
    }

    public function getUserType(): int
    {
        return $this->user_type;
    }
}
