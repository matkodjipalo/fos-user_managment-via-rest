<?php

namespace UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use FOS\UserBundle\FOSUserBundle;

class UserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
