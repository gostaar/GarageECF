<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MailerController extends AbstractController
{
    #[Route('/mailer', name: 'app_mailer')]
    public function index(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('mailtrap@example.com')
            ->to('newuser@example.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<html>
                <body>
                <>Hey!<br>
                Hey! c\'est un test!</>
                <p><a href="https://blog.mailtrap.io/build-html-email/">Mailtrap Guide</a> est ici</p>
                </body>
            </html>
            ')
            // ->htmlTemplate('path/experiment.html.twig')
        ;

        $mailer->send($email);

        return new Response('Email sent!');
        
    }
}