<?php

namespace UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class RegistrationController
{
	/**
     * @Route("/register", name="user_register")
     * @Method("POST")
     */
	public function registerAction(Request $request)
	{
		d($request->getContent(), $request->getContentType());
		d(get_class_methods(get_class($request)));
		return new Response(Response::HTTP_OK);
	}
}