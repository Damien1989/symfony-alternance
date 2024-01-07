<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Order;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderValidateController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/commande/merci/{stripeSessionUrl}", name="order_validate")
     */
    public function index(Cart $cart, $stripeSessionUrl): Response
    {
        $order = $this->entityManager->getRepository(Order::class)->findOneByStripeSessionUrl($stripeSessionUrl);

        if (!$order || $order->getUser() != $this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $cart->remove();

        if (!$order->isIsPaid()) {
            $order->setIsPaid(1);
            $this->entityManager->flush();
        }

        return $this->render('order_validate/index.html.twig', [
            'order' => $order
        ]);
    }
}