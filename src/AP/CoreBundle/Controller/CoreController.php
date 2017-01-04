<?php

namespace AP\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
	public function indexAction()
  {

  	$userManager = $this->get('fos_user.user_manager');
  	$users = $userManager->findUsers();
    return $this->render('APCoreBundle:Core:index.html.twig', array('users' => $users));
  }
}