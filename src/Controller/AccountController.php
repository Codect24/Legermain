<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AccountController extends AbstractController
{
    #[Route('/account', name: 'account')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getDoctrine()
            ->getRepository('App:User')
            ->findOneBy(array('email' => $this->getUser()->getUserIdentifier()));

        if(isset($_GET['name']) && isset($_GET['firstName']) && isset($_GET['email'])) {
            $queryBuilder = $this->getDoctrine()->getRepository('App:User')->createQueryBuilder();
            $query = $queryBuilder ->update('App:User', 'u')
                ->set('u.nom', ':name')
                ->set('u.prenom', ':firstName')
                ->set('u.email', ':email')
                ->where('u.id = :id')
                ->setParameter('name', $user->getNom())
                ->setParameter('firstName', $user->getPrenom())
                ->setParameter('email', $user->getEmail())
                ->setParameter('id', $user->getId())
                ->getQuery();
            $result = $query ->execute();
        }

        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
            'user' => $user
        ]);
    }




}
