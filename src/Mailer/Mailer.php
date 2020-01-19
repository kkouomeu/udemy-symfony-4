<?php


namespace App\Mailer;


use App\Entity\User;
use Twig\Environment as Twig_Environment;

class Mailer
{
    private $mailer;
    private $twig;
    private $mailFrom;

    public function __construct(\Swift_Mailer $mailer, Twig_Environment $twig, string $mailFrom)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->mailFrom = $mailFrom;
    }

    public function sendConfirmationEmail(User $user)
    {
        $body = $this->twig->render('email/registration.html.twig', [
            'user' => $user,
            'token' => $user->getConfirmationToken()
        ]);

        $message = (new \Swift_Message())
            ->setSubject('Welcome to the micro-post app!')
            ->setFrom($this->mailFrom)
            ->setTo($user->getEmail())
            ->setBody($body,'text/html');

        $this->mailer->send($message);
    }



}