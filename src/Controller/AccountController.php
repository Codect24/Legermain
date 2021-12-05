<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccountController extends AbstractController
{
    #[Route('/account', name: 'account')]
    public function index(): Response
    {
        $user = $this->getDoctrine()
            ->getRepository('App:User')
            ->findOneBy(array('email' => $this->getUser()->getUserIdentifier()));

        if(isset($_POST['name']) && isset($_POST['firstName']) && isset($_POST['email']) && isset($_POST['phone'])) {
            $user->setNom(ucfirst(strtolower(htmlspecialchars($_POST['name']))));
            $user->setPrenom(ucfirst(strtolower(htmlspecialchars($_POST['firstName']))));
            $user->setEmail(ucfirst(strtolower(htmlspecialchars($_POST['email']))));
            $user->setTelephone(ucfirst(strtolower(htmlspecialchars($_POST['phone']))));
            $this->getDoctrine()->getManager()->flush();
        }

        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'user' => $user,
            'orders' => $this->getDoctrine()->getRepository('App:Order')->findBy(array('user' => $user->getId())),
        ]);
    }
}

