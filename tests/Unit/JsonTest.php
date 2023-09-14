<?php

namespace Tests\Unit;

use App\Entity\TestUser;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class JsonTest extends WebTestCase
{
    public function testEmptyJsonResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/api/users', [
            'is_active' => '1',
            'is_member' => '0',
            'last_login_at' => [
                'start' => '2004-01-01 00:00:00',
                'end' => '2006-01-01 00:00:00'
            ],
            'user_type' => [1, 2],
        ]);

        $array = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals(count($array['data']), 0);
        $this->assertArrayHasKey('data', $array);
    }

    public function testJsonResponse()
    {
        $client = static::createClient();
        $client->request('GET', '/api/users', [
            'is_active' => '0',
            'is_member' => '0',
            'last_login_at' => [
                'start' => '2017-01-01 00:00:00',
                'end' => '2019-12-31 00:00:00'
            ],
            'user_type' => [1, 2],
        ]);

        $array = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful();
        $this->assertJson($client->getResponse()->getContent());
        $this->assertEquals(count($array['data']), 36);
        $this->assertArrayHasKey('data', $array);

    }
}
