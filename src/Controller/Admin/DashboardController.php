<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Entity\ProduitCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Entity\Comments;
use App\Entity\Galerie;
use App\Entity\JobOffer;
use App\Entity\Article;
use App\Entity\Realisation;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $accounts = $this->getDoctrine()->getRepository(User::class)->count([]);
        $articles = $this->getDoctrine()->getRepository(Article::class)->count([]);
        $realisations = $this->getDoctrine()->getRepository(Realisation::class)->count([]);
        $commentaires = $this->getDoctrine()->getRepository(Comments::class)->count([]);

        return $this->render('bundles/EasyAdminBundle/index_dashboard.twig', [
            'accounts' => $accounts,
            'articles' => $articles,
            'realisations' => $realisations,
            'commentaires' => $commentaires,
        ]);
    }
    public function configureAssets(): Assets
    {
        return Assets::new()->addWebpackEncoreEntry('styles/dashboard');
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Administration Legermain.')
            ->setTitle('Legermain')
            ->setFaviconPath('favicon.svg')
            ->renderContentMaximized()
            ->disableUrlSignatures()
            ->generateRelativeUrls()
            ;
    }
    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('Membres', 'fa fa-users', User::class),
            MenuItem::linkToCrud('Commentaires', 'fa fa-comments', Comments::class),
            MenuItem::section('Emploi'),
            MenuItem::linkToCrud('Offres', 'fa fa-briefcase', JobOffer::class),
            MenuItem::section('Échoppe'),
            MenuItem::linkToCrud('Produits', 'fa fa-cart-plus', Produit::class),
            MenuItem::linkToCrud('Catégories', 'fa fa-bookmark', ProduitCategorie::class),
            MenuItem::section('Contenu'),
            MenuItem::linkToCrud('Articles', 'fa fa-pencil', Article::class),
            MenuItem::linkToCrud('Réalisations', 'fa fa-wrench', Realisation::class),
            MenuItem::section('Autre'),
            MenuItem::linkToRoute('Legermain', 'fa fa-sign-out-alt','home')
        ];
    }


}
