<?php

namespace App\EventSubscriber;

use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;
use App\Entity\Article;
use App\Entity\Realisation;

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

		if ($entity instanceof Realisation) {
			$now = new DateTime('now');
			$entity->setPublicationDate($now);
			$user = $this->security->getUser();
			$entity->setUserID($user);
			return;
		}
		if ($entity instanceof Article) {
			$now = new DateTime('now');
			$entity->setPublicationDate($now);
			$user = $this->security->getUser();
			$entity->setUser($user);
		}
        return;
	}
}
