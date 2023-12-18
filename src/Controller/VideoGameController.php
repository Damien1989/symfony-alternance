<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoGameController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager )
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/game', name: 'app_video_game')]
    public function index(): Response
    {
        $product = $this->entityManager->getRepository(Category::class)->findOneBy([
            'name' => 'Jeux vidéos'
        ]);

        $game = $this->entityManager->getRepository(Product::class)->findBy([
            'category' => $product
        ]);

        return $this->render('video_game/index.html.twig', [
            'product' => $product,
            'game' => $game
        ]);

    }
}
