<?php

namespace API\Domain;

interface UserRepository
{
    public function fetchAll(): array;
}
