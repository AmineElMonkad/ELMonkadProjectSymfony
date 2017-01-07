<?php

#Le controlleur à son tour il prépare des réponses aux rêquetes http entrées en se servant des autres composants (modèles,services,vues)

namespace AP\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AP\UserBundle\Entity\User;

use AP\UserBundle\Form\RegistrationType;
use AP\UserBundle\Form\UserEditType;

class UserController extends Controller
{

	public function editAction($id, Request $request) {

		$user = $this->getUser();

		if ($user == null) 
		{
			$this->addFlash('notice','Veillez se connecter pour pouvoir accéder à ce contenu');
	        return $this->redirectToRoute('ap_core_homepage');
		}

		$em = $this->getDoctrine()->getManager();

		#préparer le repositorie qui utilise l'entité manager en coulisses pour la récupération des informations du contact
		$repository = $em->getRepository('APUserBundle:User');

		#utiliser la mèthode find de la classe Doctrine\ORM\EntityRepository pour récupérer le contact à edité
		$user = $repository->find($id);

		$form = $this->createForm(UserEditType::class, $user);

		return $this->render('APUserBundle:User:edit.html.twig', array('form' => $form->createView()));


	}

	public function addFriendAction($id, Request $request) {

		$em = $this->getDoctrine()->getManager();

		$repository = $em->getRepository('APUserBundle:User');

		$user = $this->getUser();

		$friend = $repository->find($id);

		$user->addFriend($friend);

		$em->flush();

		return $this->redirectToRoute('ap_core_homepage');

	}

	public function showFriendsAction(Request $request) {

		$em = $this->getDoctrine()->getManager();

		$repository = $em->getRepository('APUserBundle:User');

		$user = $this->getUser();

		$friends = $user->getFriends();

		return $this->render('APUserBundle:User:friends.html.twig', array('friends' => $friends));
	}

	public function removeFriendAction($id, Request $reuest) {

		$em = $this->getDoctrine()->getManager();

		$repository = $em->getRepository('APUserBundle:User');

		$user = $this->getUser();

		$friend = $repository->find($id);

		$user->removeFriend($friend);

		$em->flush();

		return $this->redirectToRoute('ap_user_friends');

	}
}