<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testPostRegsiterNewUser()
    {
    	$data = [
    		'username' => 'matko',
    		'email' => 'matko@gmail.com',
    		'password' => 'test123'
    	];
        $client = static::createClient();
        $crawler = $client->request(
		    'POST', '/users/register', array(), array(),
		    array(
		        'CONTENT_TYPE' => 'application/json',
		        'HTTP_X-Requested-With' => 'XMLHttpRequest'
		    ),
    		json_encode($data)
    	);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Welcome to Symfony', $crawler->filter('#container h1')->text());
    }
}
