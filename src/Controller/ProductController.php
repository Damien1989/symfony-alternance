<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/nos-produits', name: 'app_product')]
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();


        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    #[Route('/{slug}', name: 'app_product_show')]
    public function show($slug): Response
    {
        $item = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        if (!$item) {
            return $this->redirectToRoute('app_product_index');
        }

        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
    }
}