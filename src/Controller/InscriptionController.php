<?php

namespace App\Controller;

use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function index(): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        return $this->render('inscription/index.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
