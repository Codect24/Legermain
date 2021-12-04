<?php

namespace App\Controller;

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
//        if(isset($_GET['name']) && isset($_GET['firstName']) && isset($_GET['email'])) {
//            $entityManager = $this->getEntityManager();
//            $query = $entityManager->createQuery('SELECT j FROM App\Entity\JobOffer j WHERE j.jobStyle = :style AND j.jobType = :type AND j.title LIKE :title')->setParameters(array(
//                'style' => $style,
//                'type' => $type,
//                'title' => '%' . $title . '%'
//            ));
//            $query->getResult();
//        }
        return $this->render('account/index.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

}
