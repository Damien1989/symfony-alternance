<?php

namespace App\Controller;

use App\Classe\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        $mail = new Mail();
        $mail->send('contact.shopdams@gmail.com', 'Damien Diaz', 'Hello', 'Bordel tu vas t\'envoyer connard de mail !!!' );

        return $this->render('homepage/index.html.twig', [
            'name' => 'Dams Magazine',

        ]);
    }
}
