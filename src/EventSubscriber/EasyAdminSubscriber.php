<?php

namespace App\EventSubscriber;

use App\Entity\Realisation;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Article;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => ['setDateAndUser'],
        ];
    }

    public function setDateAndUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (($entity instanceof Article) |($entity instanceof Realisation)) {
            $now = new DateTime('now');
            $entity->setPublicationDate($now);
            $user = $this->security->getUser();
            $entity->setUserID($user);
            return;
        }
        return;
    }
}
