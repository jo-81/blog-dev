<?php

namespace App\Controller\Front;

use App\Entity\Category;
use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    public function __construct(private PostRepository $postRepository)
    {
    }

    #[Route('/blog', name: 'post.list')]
    public function postsList(PaginatorInterface $paginator, Request $request): Response
    {
        if ($request->query->getInt('page') < 0) {
            $posts = [];
        } else {
            $posts = $paginator->paginate(
                $this->postRepository->findBy(['published' => true]),
                $request->query->getInt('page', 1),
                6
            );
        }

        return $this->render('front/post/posts.html.twig', [
            'posts' => $posts,
            'category' => null,
        ]);
    }

    #[Route('/blog/{slug}/categorie', name: 'post.list.category')]
    public function postsListByCategories(Category $category, PaginatorInterface $paginator, Request $request): Response
    {
        if ($request->query->getInt('page') < 0) {
            return $this->render('front/post/posts.html.twig', [
                'posts' => [],
            ]);
        }

        $posts = $paginator->paginate(
            $this->postRepository->findByCategory($category),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('front/post/posts.html.twig', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }
}
