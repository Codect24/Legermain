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
use App\Entity\JobOffer;
use App\Entity\Article;
use App\Entity\Realisation;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/index_dashboard.twig');
    }
    public function configureAssets(): Assets
    {
        return Assets::new()->addWebpackEncoreEntry('styles/dashboard');
    }
    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            ->setTitle('Administration Legermain.')
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('Legermain')

            // the path defined in this method is passed to the Twig asset() function
            ->setFaviconPath('favicon.svg')

            // set this option if you prefer the page content to span the entire
            // browser width, instead of the default design which sets a max width
            ->renderContentMaximized()

            // by default, all backend URLs include a signature hash. If a user changes any
            // query parameter (to "hack" the backend) the signature won't match and EasyAdmin
            // triggers an error. If this causes any issue in your backend, call this method
            // to disable this feature and remove all URL signature checks
            ->disableUrlSignatures()

            // by default, all backend URLs are generated as absolute URLs. If you
            // need to generate relative URLs instead, call this method
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
            MenuItem::linkToCrud('Réalisations', 'fa fa-wrench', Realisation::class)
        ];
    }


}
