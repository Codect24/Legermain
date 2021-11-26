<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comments;
use App\Form\CommentsType;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/article2')]
class ArticleController2 extends AbstractController
{
	private $security;

	public function __construct(Security $security)
	{
		$this->security = $security;
	}

	#[Route('/', name: 'article_index2', methods: ['GET'])]
	public function index(ArticleRepository $articleRepository): Response
	{
		return $this->render('article/index2.html.twig', [
			'articles' => $articleRepository->findBy([], ['publicationDate' => 'ASC']),
	]);
	}

	#[Route('/{slug}', name: 'article_show2', methods: ['GET', 'POST'])]
	public function show(Article $article, Request $request, CommentsRepository $commentsRepository): Response
	{
		$comment = new Comments();
		$form = $this->createForm(CommentsType::class);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
		$comment
			->setArticle($article)
			->setPublicationDate(new \DateTime())
			->setUser($this->security->getUser())
			->setModerationState(0)
			->setDescription($form->get('description')->getData())
		;
		$entityManager = $this->getDoctrine()->getManager();
		$entityManager->persist($comment);
		$entityManager->flush();
	}

		return $this->render('article/show2.html.twig', [
			'article' => $article,
			'form' => $form->createView(),
			'comments' => $commentsRepository->findJoinUserByArticle($article)
		]);
	}
}