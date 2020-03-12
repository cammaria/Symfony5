<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\CreateUserType;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(Request $request)
    {	
		$user= new User();
		$form = $this->createForm(CreateUserType::class, $user);
		$form->handleRequest($request);
		
		if ($form->isSubmitted() && $form->isValid()) {
			$user = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($user);
			$entityManager->flush();
				
			return $this->redirectToRoute('home');
		}

        return $this->render('layout/view/home.html.twig', [
            'form' => $form->createView(),
        ]);
    }
	
	
	/**
     * @Route("/home/ajax", name="home.ajax", methods="POST")
     */
    public function indexAjax(Request $request, SerializerInterface $serializer)
    {
		$user = new User();
		$form = $this->createForm(CreateUserType::class, $user);
		$form->submit($request->request->all());
		if ($form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
			$entityManager->flush();
			
			return new JsonResponse("L'utilisateur a bien été enregistré en base de donnée", Response::HTTP_OK, [], true);
		} else {
			$errors = array();
			foreach ($form->getErrors(true) as $error){
				$errors[] = $error->getMessage();
			}

			return new JsonResponse($serializer->serialize($errors, 'json'));
		}
    }
}
