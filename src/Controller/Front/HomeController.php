<?php

namespace App\Controller\Front;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('front/home/index.html.twig', [
            'posts' => $postRepository->findBy(['published' => true], ['createdAt' => 'ASC'], 3),
        ]);
    }
}
