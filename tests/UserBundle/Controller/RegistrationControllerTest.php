<?php

namespace Tests\AppBundle\Controller;

use Tests\ApiTestCaseBase;

class RegistrationControllerTest extends ApiTestCaseBase
{
    public function testPostRegsiterNewUser()
    {
        $data = [
            'username' => 'matko',
            'email' => 'matko@gmail.com',
            'plainPassword' => [
                'first' => 'test123', 'second' => 'test123'
            ]
        ];
        
        $this->makePOSTRequest($data);

        $this->assertEquals(201, $this->client->getResponse()->getStatusCode());
    }

    public function testPostRegsiterNewUserWithInvalidEmail()
    {
        $data = [
            'username' => 'matko',
            'email' => 'matkasgasgashgamail.com',
            'plainPassword' => [
                'first' => 'test123', 'second' => 'test123'
            ]
        ];

        $this->makePOSTRequest($data);

        $this->assertEquals(400, $this->client->getResponse()->getStatusCode());
    }

    private function makePOSTRequest($data)
    {
        $this->client->request(
            'POST',
            '/users/register',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode($data)
        );
    }
}
