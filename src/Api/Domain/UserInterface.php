<?php

namespace API\Domain;

interface UserInterface
{
    public function findWithFilters(array $options): array;
}
