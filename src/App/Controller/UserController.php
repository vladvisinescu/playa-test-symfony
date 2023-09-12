<?php

namespace App\Controller;

use API\Application\Query\UserApiQuery;
use API\Domain\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    #[Route('/users', name: 'users.index')]
    public function index(UserApiQuery $users, Request $request)
    {
        return $this->jsonResponse($users->fetchAll());
    }

    protected function jsonResponse($data, int $status = 200): Response
    {
        $data = array_map(function ($item) {
            return $item->toArray();
        }, $data);

        return new Response(
            json_encode($data),
            $status,
            ['Content-Type' => 'application/json']
        );
    }
}
