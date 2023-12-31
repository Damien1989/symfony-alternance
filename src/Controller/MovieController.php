<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/movie', name: 'app_movie')]
    public function index(): Response
    {

        $product = $this->entityManager->getRepository(Category::class)->findOneBy([
            'name' => 'Films'
        ]);

        $films = $this->entityManager->getRepository(Product::class)->findBy([
            'category' => $product
        ]);

        return $this->render('movie/index.html.twig', [
            'product' => $product,
            'films' => $films
        ]);
    }
}
