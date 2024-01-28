<?php

namespace App\Controller;

use App\Classe\Mail;
use App\Entity\ResetPassword;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResetPasswordController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

    }
    #[Route('/mot-de-passe-oublie', name: 'reset_password')]
    public function index(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        if ($request->get('email')) {
          $user = $this->entityManager->getRepository(User::class)->findOneByEmail($request->get('email'));

            if ($user) {

                $reset_password = new ResetPassword();
                $reset_password->setUser($user);
                $reset_password->setToken(uniqid());
                $reset_password->setCreatedAt(new \DateTime());
                $this->entityManager->persist($reset_password);
                $this->entityManager->flush();

                $url = $this->generateUrl('update_password', [
                    'token' => $reset_password->getToken()
                ]);

                $content = "Bonjour ".$user->getFirstName()."<br/>Vous avez demandé la réinitialisation de votre mot de passe.<br/><br/>";
                $content .= "Merci de bien vouloir cliquer sur le lien suivant pour <a href='".$url."'> mettre à jour votre mot de passe.";


                $mail = new Mail();
                $mail->send($user->getEmail(), $user->getFirstName(). ' '.$user->getLastName(), 'Réinititialiser votre mot de passe', $content);
            }
        }

        return $this->render('reset_password/index.html.twig');
    }

    /**
     * @Route("/modifier-mon-mot-de-passe{token}", name="update_password")
     */

    public function update($token)
    {
        $reset_password = $this->entityManager->getRepository(ResetPassword::class)->findOneByToken($token);
        if (!$reset_password) {
            return $this->redirectToRoute('reset_password');


        }
    }


}
