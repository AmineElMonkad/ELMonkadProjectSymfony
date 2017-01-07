<?php

namespace AP\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
	public function indexAction()
  {

  	$userManager = $this->get('fos_user.user_manager');
  	$users = $userManager->findUsers();	
  	$formFactory = $this->get('fos_user.registration.form.factory');
  	$userManager = $this->get('fos_user.user_manager');
  	$user = $userManager->createUser();
    $user->setEnabled(true);
    $form = $formFactory->createForm();
    $form->setData($user);
    return $this->render('APCoreBundle:Core:index.html.twig', array('users' => $users, 'form' => $form->createView(),));
  }
}