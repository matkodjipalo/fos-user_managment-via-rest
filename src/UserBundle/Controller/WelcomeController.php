<?php

namespace UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Security("is_granted('ROLE_USER')")
 */
class WelcomeController extends Controller
{
    use \UserBundle\Helper\ControllerHelper;

    /**
     * @Route("/welcome", name="user_welcome")
     * @Method("GET")
     */
    public function welcomeAction(Request $request)
    {
        $response = new Response($this->serialize('Hello user.'), Response::HTTP_OK);

        return $this->setBaseHeaders($response);
    }
}
