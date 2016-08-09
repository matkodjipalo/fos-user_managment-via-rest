<?php

namespace tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

class ApiTestCaseBase extends WebTestCase
{
    protected static $staticClient;

    public static function setUpBeforeClass()
    {
        self::$staticClient = static::createClient(['environment' => 'test']);

        // kernel boot, so we can get the container and use our services
        self::bootKernel();
    }

    protected function setUp()
    {
        $this->client = self::$staticClient;
        $this->purgeDatabase();
    }

    protected function tearDown()
    {
        // purposefully not calling parent class, which shuts down the kernel
    }

    protected function getService($id)
    {
        return self::$kernel->getContainer()
            ->get($id);
    }

    protected function createUser($userName, $password)
    {
        $userManager = $this->getService('fos_user.user_manager');
        $user = $userManager->createUser();
        $user->setEnabled(true);
        $user->setPlainPassword($password);
        $user->setUsername($userName);
        $user->setEmail('email@email.com');
        $userManager->updateUser($user);

        return $user;
    }

    private function purgeDatabase()
    {
        $purger = new ORMPurger($this->getService('doctrine')->getManager());
        $purger->purge();
    }
}
