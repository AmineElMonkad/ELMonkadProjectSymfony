<?php

namespace AP\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class APUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
