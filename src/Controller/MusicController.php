<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/music', name: 'app_music')]
    public function index(): Response
    {
        $product = $this->entityManager->getRepository(Category::class)->findOneBy([
            'name' => 'Musique'
        ]);

        $music = $this->entityManager->getRepository(Product::class)->findBy([
            'category' => $product
        ]);

        return $this->render('music/index.html.twig', [
            'product' => $product,
            'music' => $music
        ]);
    }
}
