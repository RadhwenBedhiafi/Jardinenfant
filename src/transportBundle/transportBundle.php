<?php

namespace transportBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class transportBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle' ;
    }
}
