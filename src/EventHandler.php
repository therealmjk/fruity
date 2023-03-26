<?php

namespace App;

use App\Event\AfterFruitsSavedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EventHandler implements EventSubscriberInterface
{

    public function __construct(public readonly MailerInterface $mailer)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterFruitsSavedEvent::class => 'onAfterFruitsSavedEvent',
        ];
    }

    public function onAfterFruitsSavedEvent(AfterFruitsSavedEvent $event)
    {
        $this->sendEmail();
    }

    private function sendEmail(): void
    {
        $email = (new Email())
            ->from('info@fruity.com')
            ->to('test@gmail.com')
            ->subject('Saved fruits success')
            ->html('<p>The fruits have saved successfully to the database</p>');

        $this->mailer->send($email);
    }
}