<?php

namespace App\Controller;

use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Exception\LogicException;
use Symfony\Component\Form\Exception\RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @throws RuntimeException
     * @throws LogicException
     */
    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, UserPasswordEncoderInterface $encoder ): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        $role= array('ROLE_USER');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user= $form->getData();

            $password = $encoder->encodePassword($user,$user->getPassword());

            $user->setPassword($password);
            $user->setRoles($role);

            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $this->render('inscription/index.html.twig',[
            'form'=> $form->createView()
        ]);
    }
}
