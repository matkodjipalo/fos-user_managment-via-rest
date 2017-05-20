<?php

namespace Tests\AppBundle\Controller;

use Tests\ApiTestCaseBase;

class LoginControllerTest extends ApiTestCaseBase
{
    public function testPOSTLoginUser()
    {
        $userName = "mate.misho";
        $password = "ja_sam_Dalmatino_1950";

        $user = $this->createUser($userName, $password);

        $this->client->request(
            'POST',
            '/users/login',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'PHP_AUTH_USER' => $userName,
                'PHP_AUTH_PW'   => $password,
            ]
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseArr);
    }

    public function testPOSTLoginUserWitAddOnEmail()
    {
        $userName = "mate@misho.com";
        $password = "ja_sam_Dalmatino_1950";
        $addOnEmail = "majlo.hrnic@du.hr";

        $user = $this->createUser($userName, $password, $addOnEmail);

        $this->client->request(
            'POST',
            '/users/login',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'PHP_AUTH_USER' => $addOnEmail,
                'PHP_AUTH_PW'   => $password,
            ]
        );

        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());
        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('token', $responseArr);
    }

    public function testPOSTLoginUserWithWrongUsername()
    {
        $userName = "mate.misho";
        $password = "ja_sam_Dalmatino_1950";

        $user = $this->createUser($userName, $password);

        $this->client->request(
            'POST',
            '/users/login',
            [],
            [],
            [
                'CONTENT_TYPE' => 'application/json',
                'PHP_AUTH_USER' => $userName.'wrong_username',
                'PHP_AUTH_PW'   => $password,
            ]
        );

        $this->assertEquals(404, $this->client->getResponse()->getStatusCode());
        $responseArr = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertEquals('Not Found', $responseArr['error']['message']);
    }
}
