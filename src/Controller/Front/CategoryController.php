<?php

namespace App\Controller\Front;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    public function __construct(private CategoryRepository $categoryRepository)
    {
    }

    #[Route('/categories', name: 'category.list')]
    public function index(): Response
    {
        return $this->render('front/category/list.html.twig', [
            'categories' => $this->categoryRepository->findCategoriesAssociatePost(),
        ]);
    }
}
