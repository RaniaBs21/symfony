<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    private $replyTo;
    public function __construct(private MailerInterface $mailer) {}
    public function sendEmail(
        $to = 'rahma.slimi@esprit.tn',
        $content = '<p>Vous étes inscrit à l"événement avec succés</p>',
        $subject = 'Participation à l\'évenement!'
    ): void
    {   
        $email = (new Email())
            ->from('rahmaaslimii83@gmail.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo($this->replyTo)
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
//            ->text('Sending emails is fun again!')
            ->html($content);
            
        // ...
        $this->mailer->send($email);
    }
}