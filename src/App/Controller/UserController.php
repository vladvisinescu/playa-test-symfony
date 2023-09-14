<?php

namespace App\Controller;

use API\Application\Query\UserApiQuery;
use API\Domain\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    /**
     * This method is used to return all users using filters in JSON format
     *
     * @param UserApiQuery $users
     * @param Request $request
     * @return void
     */
    #[Route('/api/users', name: 'users.index')]
    public function index(UserApiQuery $users, Request $request)
    {
        return $this->jsonResponse($users->fetchAll(options: [
            'is_active' => (int) $request->query->get('is_active'),
            'is_member' => (int) $request->query->get('is_member'),
            'last_login_at' => $request->query->all()['last_login_at'],
            'user_type' => $request->query->all()['user_type'],
        ]));
    }

    /**
     * This method is used to convert the data to JSON
     *
     * @param array $data
     * @param integer $status
     * @return Response
     */
    protected function jsonResponse(array $data): Response
    {
        return new Response(
            json_encode([
                'data' => array_map(function ($item) {
                    return $item->toArray();
                }, $data)
            ]), 200, ['Content-Type' => 'application/json']
        );
    }
}
