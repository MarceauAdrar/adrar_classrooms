<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

// TODO: n'hésitez pas à utiliser les super routes...
#[Route('/api/v1', name: 'app_api_')]
class ApiController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(HttpClientInterface $client): Response
    {
        // TODO: pour effectuer un appel sur l'API, il faut utiliser le client HTTP, pensez à changer l'URL et la méthode
        $response = $client->request('GET', 'https://api.github.com/repos/symfony/symfony-docs');
     
        return $this->render('api/index.html.twig', [
            'response' => $response->toArray(),
        ]);
    }

    #[Route('/email', name: 'email')]
    public function email(MailerInterface $mailer): Response
    {
        // TODO: pour envoyer un email, il faut utiliser le MailerInterface, pensez à changer les informations
        $email = (new Email())
            ->from('marceau@localhost')
            ->to('marceaurodrigues@adrar-formation.fr')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
        
        $mailer->send($email);

        return $this->render('api/email.html.twig', [
            'controller_name' => 'ApiController',
        ]);
    }
}
